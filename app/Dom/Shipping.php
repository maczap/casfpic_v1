<?php

namespace App\Dom;

use Illuminate\Database\Eloquent\Model;
use DOMDocument;
use Exception;
use DOMElement;

class Shipping extends Model
{

    private $addressRequired;

    public function __construct(){

        $this->addressRequired = "false";
    }

    public function getDOMElement($node = "address"):DOMElement
    {
        $dom = new \DOMDocument();

        $shipping = $dom->createElement("shipping");
        $shipping = $dom->appendChild($shipping);

        $addressRequired = $dom->createElement("addressRequired", $this->addressRequired);
        $addressRequired = $shipping->appendChild($addressRequired);       

        return $shipping;
    }        
}
