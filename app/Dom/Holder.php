<?php

namespace App\Dom;

use Illuminate\Database\Eloquent\Model;
use DOMDocument;
use Exception;
use DOMElement;
use DateTime;


class Holder extends Model
{
    private $name;
    private $cpf;
    private $birthDate;
    private $phone;

    public function __construct(string $name,Document $cpf, string $birthDate, Phone $phone)
    {

        if( (!$name))
        {
            throw new Exception("Informe o nome no cartão");
        }        
        

        $this->name         = $name;
        $this->cpf          = $cpf;
        $this->birthDate    = $birthDate;
        $this->phone        = $phone;
    }


    public function getDOMElement():DOMElement
    {
        $dom = new \DOMDocument();

        $holder = $dom->createElement("holder");
        $holder = $dom->appendChild($holder);

        $name = $dom->createElement("name", $this->name);
        $name = $holder->appendChild($name);
      
        $birthDate = $dom->createElement("birthDate", $this->birthDate);
        $birthDate = $holder->appendChild($birthDate);          

        $documents = $dom->createElement("documents");
        $documents = $holder->appendChild($documents);    
        
        $cpf = $this->cpf->getDOMElement();
        $cpf = $dom->importNode($cpf, true);
        $cpf = $documents->appendChild($cpf);

        $phone = $this->phone->getDOMElement();
        $phone = $dom->importNode($phone, true);
        $phone = $holder->appendChild($phone);   
        

        return $holder;

        
    }          
}
