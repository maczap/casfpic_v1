<?php

namespace App\Dom;

use Illuminate\Database\Eloquent\Model;
use DOMDocument;
use Exception;
use DOMElement;

class Document extends Model
{
    private $type;
    private $value;

    const CPF = "cpf";

    public function __construct(string $type, string $value){


        if(!$value)
        {
            throw new Exception("informe o valor do documento");
        }

        switch ($type)
        {
            case Document::CPF;
            if(!$this->isValidCPF($value)){
                throw new Exception("CPF Inválido ");
            }

            break;

        }

        $this->type  = $type;
        $this->value = $value;


    }


    public static function isValidCPF($number):bool
    {

        $number = preg_replace('/[^0-9]/', '', (string) $number);

        if (strlen($number) != 11)
            return false;
    
        for ($i = 0, $j = 10, $sum = 0; $i < 9; $i++, $j--)
            $sum += $number{$i} * $j;
        $rest = $sum % 11;
        if ($number{9} != ($rest < 2 ? 0 : 11 - $rest))
            return false;
    
        for ($i = 0, $j = 11, $sum = 0; $i < 10; $i++, $j--)
            $sum += $number{$i} * $j;
        $rest = $sum % 11;
    
        return ($number{10} == ($rest < 2 ? 0 : 11 - $rest));
    
    }

    public function getDOMElement():DOMElement
    {
        $dom = new \DOMDocument();

        $document = $dom->createElement("document");
        $document = $dom->appendChild($document);

        $type = $dom->createElement("type", $this->type);
        $type = $document->appendChild($type);

        $value = $dom->createElement("value", $this->value);
        $value = $document->appendChild($value);        

        return $document;
    }
}
