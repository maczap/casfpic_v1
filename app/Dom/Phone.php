<?php

namespace App\Dom;

use Illuminate\Database\Eloquent\Model;
use DOMDocument;
use Exception;
use DOMElement;

class Phone extends Model
{

    private $areaCode;
    private $number;

    public function __construct(int $areaCode, int $number)
    {

        if (!$areaCode || $areaCode < 11 || $areaCode > 99 || $areaCode == "")
        {

            throw new Exception("Informe o DDD do Telefone");
        }

        if (!$number || strlen($number) < 8 || strlen($number) > 9)
        {

            throw new Exception("Informe o Número do Telefone");
        }

        $this->areaCode = $areaCode;
        $this->number = $number;

    }

    public function getDOMElement():DOMElement
    {
        $dom = new \DOMDocument();

        $phone = $dom->createElement("phone");
        $phone = $dom->appendChild($phone);

        $areaCode = $dom->createElement("areaCode", $this->areaCode);
        $areaCode = $phone->appendChild($areaCode);

        $number = $dom->createElement("number", $this->number);
        $number = $phone->appendChild($number);        

        return $phone;
    }    
}
