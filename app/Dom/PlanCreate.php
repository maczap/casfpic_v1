<?php

namespace App\Dom;

use Illuminate\Database\Eloquent\Model;
use DOMDocument;
use Exception;
use DOMElement;
class PlanCreate extends Model
{
    
    private $name;
    private $reference;
    private $charge = "AUTO";
    private $period = "MONTHLY";
    private $amountPerPayment;
    private $cancelURL = "https://casfpic.org.br/assinatura/cancelamento";
    private $membershipFee;
    private $trialPeriodDuration = null;
    private $maxUses = 50000;
    
    

    public function __construct(
        string $name, 
        float  $amount, 
        string $reference

        )
    {

        if( (!$name))
        {
            throw new Exception("Informe o Nome do Plano");
        }

        if( (!$amount))
        {
            throw new Exception("Informe o valor do Plano");
        }
        
        if( (!$reference))
        {
            throw new Exception("Informe a Referencia");
        }
           
        $this->name             = $name;
        $this->amountPerPayment = $amount;
        $this->reference        = $reference;

    }

    public function getDOMElement($node = "preApprovalRequest"):DOMDocument
    {
        $dom = new \DOMDocument();
        $dom->xmlStandalone = true;

        $preApprovalRequest = $dom->createElement("preApprovalRequest");
        $preApprovalRequest = $dom->appendChild($preApprovalRequest);

            $preApproval = $dom->createElement("preApproval");
            $preApproval = $preApprovalRequest->appendChild($preApproval);        

                $name = $dom->createElement("name", $this->name);
                $name = $preApproval->appendChild($name);         
                
                $reference = $dom->createElement("reference", $this->reference);
                $reference = $preApproval->appendChild($reference);        
                
                $charge = $dom->createElement("charge", $this->charge);
                $charge = $preApproval->appendChild($charge);     
                
                $period = $dom->createElement("period", $this->period);
                $period = $preApproval->appendChild($period);   
                
                $amountPerPayment = $dom->createElement("amountPerPayment",  \number_format( $this->amountPerPayment, 2, ".",""));
                $amountPerPayment = $preApproval->appendChild($amountPerPayment);  
                
                $trialPeriodDuration = $dom->createElement("trialPeriodDuration", $this->trialPeriodDuration);
                $trialPeriodDuration = $preApproval->appendChild($trialPeriodDuration);                   

            $maxUses = $dom->createElement("maxUses", $this->maxUses);
            $maxUses = $preApprovalRequest->appendChild($maxUses);                 
        
        return $dom;
    }       
}
