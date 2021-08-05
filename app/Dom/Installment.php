<?php

namespace App\Dom;

use Illuminate\Database\Eloquent\Model;
use DOMDocument;
use Exception;
use DOMElement;

class Installment extends Model
{
    private $quantity;
    private $value;
    private $noInterestInstallmentQuantity = 10;


    public function __construct(int $quantity, float $value){
        if($quantity <=0 || $quantity == null || $quantity == "")
        {
            throw new Exception("Quantidade inválida");
        }


        if($value <=0 )
        {
            throw new Exception("Valor inválido");
        }

        $this->quantity = $quantity;
        $this->value  = $value;
    }

    public function getDOMElement():DOMElement
    {
        $dom = new \DOMDocument();

        $installment = $dom->createElement("installment");
        $installment = $dom->appendChild($installment);

        $value = $dom->createElement("value", \number_format( $this->value, 2, ".",""));
        $value = $installment->appendChild($value);

        $quantity = $dom->createElement("quantity", $this->quantity);
        $quantity = $installment->appendChild($quantity);        

        // $noInterestInstallmentQuantity = $dom->createElement("noInterestInstallmentQuantity", $this->noInterestInstallmentQuantity);
        // $noInterestInstallmentQuantity = $installment->appendChild($noInterestInstallmentQuantity);                   

        return $installment;
    }    
}
