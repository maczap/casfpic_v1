<?php

namespace App\Dom;

use Illuminate\Database\Eloquent\Model;
use DOMDocument;
use Exception;
use DOMElement;


class shippingAddress extends Model
{

    private $street;
    private $number;
    private $complement;
    private $district;
    private $postalCode;
    private $city;
    private $state;
    private $country;
    

    public function __construct(
        string $street, 
        string $number, 
        string $complement,
        string $district,
        string $postalCode,
        string $city,
        string $state,
        string $country

        )
    {

        if( (!$street))
        {
            throw new Exception("Informe o Logradouro do Endereço");
        }

        if( (!$number))
        {
            throw new Exception("Informe o número do Endereço");
        }
        
        if( (!$district))
        {
            throw new Exception("Informe o bairro do Endereço");
        }
        
        if( (!$postalCode))
        {
            throw new Exception("Informe o CEP do Endereço");
        }

        if( (!$city))
        {
            throw new Exception("Informe a cidade do Endereço");
        }        

        if( (!$state))
        {
            throw new Exception("Informe o estado do Endereço");
        }             

        if( (!$country))
        {
            throw new Exception("Informe o país do Endereço");
        }              

        $this->street       = $street;
        $this->number       = $number;
        $this->complement   = $complement;
        $this->district     = $district;
        $this->postalCode   = $postalCode;
        $this->city         = $city;
        $this->state        = $state;
        $this->country      = $country;
    }

    public function getDOMElement($node = "shipping"):DOMElement
    {
        $dom = new \DOMDocument();

        $shipping = $dom->createElement("shipping");
        $shipping = $dom->appendChild($shipping);        

        $address = $dom->createElement("address");
        $address = $shipping->appendChild($address);

            $street = $dom->createElement("street", $this->street);
            $street = $address->appendChild($street);               

            $number = $dom->createElement("number", $this->number);
            $number = $address->appendChild($number);

            $complement = $dom->createElement("complement", $this->complement);
            $complement = $address->appendChild($complement);

            $district = $dom->createElement("district", $this->district);
            $district = $address->appendChild($district);

            $city = $dom->createElement("city", $this->city);
            $city = $address->appendChild($city);
            
            $state = $dom->createElement("state", $this->state);
            $state = $address->appendChild($state);
            
            $country = $dom->createElement("country", $this->country);
            $country = $address->appendChild($country);
            
            $postalCode = $dom->createElement("postalCode", $this->postalCode);
            $postalCode = $address->appendChild($postalCode);    
            
            $type = $dom->createElement("type",3);
            $type = $shipping->appendChild($type);    
            
            $cost = $dom->createElement("cost", 0.00);
            $cost = $shipping->appendChild($cost);              

        return $shipping;
    }     
}
