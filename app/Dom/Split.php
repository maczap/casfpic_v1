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

    public function __construct($data, float $amount, $method = "creditCard")
    {

        $this->amount      = \number_format($amount,2,".","");
        $this->receiver    = $data;
        $this->method = $method;
    }


    public function getDOMElement():DOMElement
    {
        $pag = new Pagseguro();
        $dom = new \DOMDocument();

        $primaryReceiver = $dom->createElement("primaryReceiver");
        $primaryReceiver = $dom->appendChild($primaryReceiver);

        $publicKey = $dom->createElement("publicKey", "PUB2DDF1F0179F8449BADF6BD57F186B34F");
        $publicKey = $primaryReceiver->appendChild($publicKey);

        return $primaryReceiver;
        
    }        

    public function recebedores():DOMElement
    {
        $dom = new \DOMDocument();

        $receivers = $dom->createElement("receivers");
        $receivers = $dom->appendChild($receivers);   
        
        
        foreach ($this->receiver as $key => $value) {
        
            if($key == "promotor"){
                $chave = $value; 
                $valor_descontado = (36 / 100) * $this->amount ; 
            }
            if($key == "supervisor"){
                $chave = $value;
                $valor_descontado = (6 / 100) * $this->amount ; 
            }       
            
            $receiver = $dom->createElement("receiver");
            $receiver = $receivers->appendChild($receiver);   
            
                $publicKey = $dom->createElement("publicKey", $chave);
                $publicKey = $receiver->appendChild($publicKey); 

                $split = $dom->createElement("split");
                $split = $receiver->appendChild($split);  
            
                    $amount = $dom->createElement("amount", number_format($valor_descontado, 2 ,".", "" ));
                    $amount = $split->appendChild($amount);   
                    
                    if($this->method =="boleto"){
                        $ratePercent = $dom->createElement("ratePercent", 0.00);
                        $ratePercent = $split->appendChild($ratePercent);     
                        
                        $feePercent = $dom->createElement("feePercent", 0.00);
                        $feePercent = $split->appendChild($feePercent);                        
                    }
              
            
        }        

        return $receivers;
    }    
}
