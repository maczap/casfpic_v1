<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Dom\Installment;
use App\Dom\Holder;
use App\Dom\Address;
use App\Dom\billingAddress;
use DOMDocument;
use Exception;
use DOMElement;


class CreditCard extends Model
{
    private $token;
    private $installment;
    private $holder;
    private $billingAddress;

    public function __construct(
        string $token,
        Installment $installment,
        Holder $holder,
        billingAddress $billingAddress
    )
    {

        if(!$token)
        {
            throw new Exception("Verifique as informações do cartão de crédito");
        }

        $this->token            = $token;
        $this->installment      = $installment;
        $this->holder           = $holder;
        $this->billingAddress   = $billingAddress;

    }

    public function getDOMElement():DOMElement
    {
        $dom = new \DOMDocument();

        $creditCard = $dom->createElement("creditCard");
        $creditCard = $dom->appendChild($creditCard);

        $token = $dom->createElement("token", $this->token);
        $token = $creditCard->appendChild($token);

        $installment = $this->installment->getDOMElement();
        $installment = $dom->importNode($installment, true);
        $installment = $creditCard->appendChild($installment);

        $holder = $this->holder->getDOMElement();
        $holder = $dom->importNode($holder, true);
        $holder = $creditCard->appendChild($holder);  


        // $billingAddress = $dom->createElement("billingAddress");
        // $billingAddress = $creditCard->appendChild($billingAddress);           
        
        $billingAddress = $this->billingAddress->getDOMElement("billingAddress");
        $billingAddress = $dom->importNode($billingAddress, true);
        $billingAddress = $creditCard->appendChild($billingAddress);        

        return $creditCard;
    }    
}
