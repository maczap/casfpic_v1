<?php

namespace App\Services;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Http;

class Pagseguro extends Model
{

    // public $_email = "financeiro@servclube.com.br";
    // public $_token = "3b440fb1-4f31-4d2c-aad5-95f0e6bd57a8def82e11487899227e1c83d0c4ecdc1058b4-0e88-43fc-8080-0e0895783427";
    // public $_ambiente = "production";
    // public $_url = "https://ws.pagseguro.uol.com.br/v2/";

    public $_email = "financeiro@servclube.com.br";
    public $_token = "8C11CC23817C4E948EFAB84093070134";

    public $_ambiente = "sandbox";    
    public $_url = "https://ws.sandbox.pagseguro.uol.com.br/v2/";    


    public function __construct(){

        
    }

    public function getAuthentication(): array
    {

        return [
            "email"=>$this->_email,
            "token"=>$this->_token
        ];
    }

    public function getSession(){

        $data = \http_build_query($this->getAuthentication());
        $response = Http::POST($this->_url."/sessions?". $data, [
            'verify' => false
        ]);

        return $response;
    }

    public function sendTransaction($payment)
    {
        $data = \http_build_query($this->getAuthentication());
        $response = Http::POST($this->_url."/transaction?". $data, [
            'verify' => false,
            'headers' => [
                'Content-Type' => 'application/xml'
            ],
            'body' => $payment
        ]);

        $xml = simplexml_load_string($response->getBody()->getContents()); 

        return $xml;
    }
    
}
