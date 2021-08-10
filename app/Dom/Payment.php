<?php

namespace App\Dom;

use Illuminate\Database\Eloquent\Model;
use DOMDocument;
use Exception;
use DOMElement;
use App\CreditCard;
use App\Dom\Split;


class Payment extends Model
{
    private $mode = "default";
    private $currency = "BRL";
    private $extraAmount = 0;
    private $reference = "";
    private $item;
    private $sender;
    private $shipping;
    private $method;
    private $creditCard;
    private $split;
    private $bank;
    private $notificationUrl ='https://casfpic.org.br/api/postback';
    private $receiverEmail = 'financeiro@servclube.com.br';

    public function __construct(
        string $reference,
        Sender $sender,
        Shipping $shipping,
        Item $item,
        Split $split
        
    ){

        $this->sender       = $sender;
        $this->shipping     = $shipping;
        $this->item         = $item;
        $this->reference    = $reference;
        // $this->extraAmount  = \number_format( $extraAmount, 2, ".","");
        $this->split        = $split;

    }

    // public function setBank(Bank $bank)
    // {
    //     $this->bank = $bank;
    //     $this->method = "eft";
    // }

    public function setCreditCard(CreditCard $creditCard)
    {
        $this->creditCard = $creditCard;
        $this->method = "creditCard";
    }    
    public function setBoleto()
    {
        $this->method = "boleto";
    }   
    public function getDOMDocument():DOMDocument
    {
        $dom = new DOMDocument("1.0", "ISO-8859-1");
        $dom->xmlStandalone = true;
        
        $payment = $dom->createElement("payment");
        $payment = $dom->appendChild($payment);

        $mode = $dom->createElement("mode", $this->mode);
        $mode = $payment->appendChild($mode);    

        $method = $dom->createElement("method", $this->method);
        $method = $payment->appendChild($method);   
        
        $sender = $this->sender->getDOMElement();
        $sender = $dom->importNode($sender, true);
        $sender = $payment->appendChild($sender);        

        $currency = $dom->createElement("currency", $this->currency);
        $currency = $payment->appendChild($currency);  

        $notificationUrl = $dom->createElement("notificationURL", $this->notificationUrl);
        $notificationUrl = $payment->appendChild($notificationUrl);    

        // $receiverEmail = $dom->createElement("receiverEmail", $this->receiverEmail);
        // $receiverEmail = $payment->appendChild($receiverEmail);        
        

        
        $items = $dom->createElement("items");
        $items = $payment->appendChild($items);        

        $item = $this->item->getDOMElement();
        $item = $dom->importNode($item, true);
        $item = $items->appendChild($item);    

        $reference = $dom->createElement("reference", $this->reference);
        $reference = $payment->appendChild($reference);        
        
        $shipping = $this->shipping->getDOMElement();
        $shipping = $dom->importNode($shipping, true);
        $shipping = $payment->appendChild($shipping);  
        


        $extraAmount = $dom->createElement("extraAmount", \number_format( $this->extraAmount, 2, ".",""));
        $extraAmount = $payment->appendChild($extraAmount);     
        
        
        switch ($this->method)
        {
            case "creditCard";

            $creditCard = $this->creditCard->getDOMElement();
            $creditCard = $dom->importNode($creditCard, true);
            $creditCard = $payment->appendChild($creditCard);      
            
            break;


        }

        $split = $this->split->getDOMElement();
        $split = $dom->importNode($split, true);
        $split = $payment->appendChild($split);        

        $recebedoes = $this->split->recebedores();
        $recebedoes = $dom->importNode($recebedoes, true);
        $recebedoes = $payment->appendChild($recebedoes);   


        return $dom;
    }



}
