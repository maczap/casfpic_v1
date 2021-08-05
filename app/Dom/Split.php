<?php

namespace App\Dom;

use Illuminate\Database\Eloquent\Model;
use App\Services\Pagseguro;
use DOMDocument;
use Exception;
use DOMElement;

class Split extends Model
{
    private $receiver;
    private $amount;

    public function __construct(float $amount, $receiver)
    {

        $this->amount      = \number_format($amount,2,".","");
        $this->receiver    = $receiver;
    }


    public function getDOMElement():DOMElement
    {
        $pag = new Pagseguro();
        $dom = new \DOMDocument();

        $primaryReceiver = $dom->createElement("primaryReceiver");
        $primaryReceiver = $dom->appendChild($primaryReceiver);

        $publicKey = $dom->createElement("publicKey", "PUBBD3CE3ECC27B43F6B2D2B8C64BCE27D8");
        $publicKey = $primaryReceiver->appendChild($publicKey);

        return $primaryReceiver;
        
    }        

    public function recebedores():DOMElement
    {
        $dom = new \DOMDocument();

        $receivers = $dom->createElement("receivers");
        $receivers = $dom->appendChild($receivers);     
        
            $receiver = $dom->createElement("receiver");
            $receiver = $receivers->appendChild($receiver);   
            
                $publicKey = $dom->createElement("publicKey", $this->receiver);
                $publicKey = $receiver->appendChild($publicKey); 

                $split = $dom->createElement("split");
                $split = $receiver->appendChild($split);  
            
                    $amount = $dom->createElement("amount", $this->amount);
                    $amount = $split->appendChild($amount);       

        return $receivers;
    }    
}
