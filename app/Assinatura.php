<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Dom\Holder;
use App\Dom\Address;
use App\Dom\billingAddress;
use DOMDocument;
use Exception;
use DOMElement;

class Assinatura extends Model
{

    private $plano;
    private $reference;
    private $holder;
    private $billingAddress;
    private $token;

    public function __construct(
        string $plano,
        string $reference,
        string $token,
        Holder $holder,
        billingAddress $billingAddress
    )
    {

        if(!$plano)
        {
            throw new Exception("Verifique as informações do cartão de crédito");
        }
        if(!$reference)
        {
            throw new Exception("Verifique a referencia do cadastro");
        }
        if(!$token)
        {
            throw new Exception("Verifique as informações do cartão de crédito");
        }        
        $this->plano            = $plano;
        $this->reference        = $reference;
        $this->holder           = $holder;
        $this->billingAddress   = $billingAddress;
        $this->token            = $token;

    }

    public function getDOMElement():DOMElement
    {
        $dom = new \DOMDocument();

        $preApprovalRequest = $dom->createElement("preApprovalRequest");
        $preApprovalRequest = $dom->appendChild($preApprovalRequest);

        $plan = $dom->createElement("plan", $this->plan);
        $plan = $preApprovalRequest->appendChild($plan);

        // $holder = $this->holder->getDOMElement();
        // $holder = $dom->importNode($holder, true);
        // $holder = $creditCard->appendChild($holder);  
     
        
        // $billingAddress = $this->billingAddress->getDOMElement("billingAddress");
        // $billingAddress = $dom->importNode($billingAddress, true);
        // $billingAddress = $creditCard->appendChild($billingAddress);        

        return $preApprovalRequest;
    }       
}
