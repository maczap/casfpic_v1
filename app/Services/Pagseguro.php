<?php

namespace App\Services;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Http;
use App\Dom\Payment;

header('Content-Type: application/xml');

class Pagseguro extends Model
{

    // public $_email = "financeiro@servclube.com.br";
    // public $_token = "3b440fb1-4f31-4d2c-aad5-95f0e6bd57a8def82e11487899227e1c83d0c4ecdc1058b4-0e88-43fc-8080-0e0895783427";
    // public $_ambiente = "production";
    // public $_url = "https://ws.pagseguro.uol.com.br/v2/";

    public $_email = "financeiro@servclube.com.br";
    public $_token = "8C11CC23817C4E948EFAB84093070134";
    
    public $_appID = "app8844053095";
    public $_appKey = "220D5468999990511487AF8B40C9986B";

    
    public $_ambiente = "sandbox";    
    
    public $_url = "https://ws.sandbox.pagseguro.uol.com.br/";

    public $sandbox_notification_url    = "https://ws.sandbox.pagseguro.uol.com.br/v3/transactions/notifications/";
    public $production_notification_url = "https://ws.sandbox.pagseguro.uol.com.br/";

    public $_urlTransaction = "https://ws.sandbox.pagseguro.uol.com.br/transactions";

    public function __construct(){

        
    }

    public function getAuthentication(): array
    {

        return [
            "appId"=>$this->_appID,
            "appKey"=>$this->_appKey
        ];
    }

    public function getSession(){

        $data = \http_build_query($this->getAuthentication());

        $response = Http::POST($this->_url."/sessions?". $data, [
            'verify' => false
        ]);

        return $response;
    }

    public function sendTransaction(Payment $payment)
    {
        // return $payment->getDOMDocument()->saveXml();

        $data = \http_build_query($this->getAuthentication());
     
        $curl = curl_init();

        curl_setopt_array($curl, array(
          CURLOPT_URL => $this->_urlTransaction."?". $data,
          CURLOPT_RETURNTRANSFER => true,
          CURLOPT_ENCODING => '',
          CURLOPT_MAXREDIRS => 10,
          CURLOPT_TIMEOUT => 0,
          CURLOPT_FOLLOWLOCATION => true,
          CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
          CURLOPT_CUSTOMREQUEST => 'POST',
          CURLOPT_POSTFIELDS => $payment->getDOMDocument()->saveXml(),
          CURLOPT_HTTPHEADER => array(
            'Content-Type: application/xml',
            'Accept: application/vnd.pagseguro.com.br.v3+xml'
          ),
        ));
        
        $response = curl_exec($curl);
        curl_close($curl);

        $xml = simplexml_load_string($response);     
        $json =json_decode(json_encode($xml), true);          
        return $json;
    }
    
}
