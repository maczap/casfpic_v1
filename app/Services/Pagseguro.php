<?php

namespace App\Services;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Http;
use App\Dom\Payment;
use Illuminate\Support\Facades\App;

// use PagSeguro\Services\Session as PagseguroSession;
// use PagSeguro\Configuration\Configure;
// use PagSeguro\Domains\Requests\Payment as PagseguroPayment;


header('Content-Type: application/xml');

class Pagseguro extends Model
{

    // public $_email = "financeiro@servclube.com.br";
    // public $_token = "3b440fb1-4f31-4d2c-aad5-95f0e6bd57a8def82e11487899227e1c83d0c4ecdc1058b4-0e88-43fc-8080-0e0895783427";
    // public $_ambiente = "production";
    // public $_url = "https://ws.pagseguro.uol.com.br/v2/";
        

        public $_email = "financeiro@servclube.com.br";
        public $_token = "8C11CC23817C4E948EFAB84093070134";

        public $_emailProduction = "financeiro@servclube.com.br";
        public $_tokenProduction = "8C11CC23817C4E948EFAB84093070134";        
        
        public $_appID = "app8844053095";
        public $_appKey = "220D5468999990511487AF8B40C9986B";

        public $_appIDProduction  = "app8844053095";
        public $_appKeyProduction = "220D5468999990511487AF8B40C9986B";        

        
        public $_ambiente = "sandbox";    
        
        public $_url           = "https://ws.sandbox.pagseguro.uol.com.br/";
        public $_urlProduction = "https://sandbox.pagseguro.uol.com.br/";


        public $_urlRecorrencia          = "https://ws.sandbox.pagseguro.uol.com.br/pre-approvals/";
        public $_urlRecorrenciaProducao  = "https://ws.pagseguro.uol.com.br/pre-approvals/";        

        public $notification_url           = "https://ws.sandbox.pagseguro.uol.com.br/v3/transactions/notifications/";
        public $notification_urlProduction = "https://ws.sandbox.pagseguro.uol.com.br/v3/transactions/notifications/";

        public $_urlTransaction = "https://ws.sandbox.pagseguro.uol.com.br/transactions";
        public $_urlTransactionProduction = "https://sandbox.pagseguro.uol.com.br/transactions";
    
        private $_configs;


    public function __construct(){

    
        // $this->_configs = new Configure();
        // $this->_configs->setCharset("UTF-8");
        // $this->_configs->setAccountCredentials($this->_email, $this->_token);
        // $this->_configs->setEnvironment( $this->_ambiente);
        // $this->_configs->setLog(true, storage_path('logs/pagseguro_' . date('Ymd') . '.log'));
    }

    public function getAuthentication(): array
    {

        if (App::environment('local')) {
            $appID = $this->_appID;
            $appKey= $this->_appKey;
        } else {
            $appID = $this->_appIDProduction;
            $appKey= $this->_appKeyProduction;
        }
            return [
                "appId"=>$appID,
                "appKey"=>$appKey
            ];

    }

    public function getAuthenticationPlan(): array
    {

        if (App::environment('local')) {
            $email = $this->_email;
            $token= $this->_token;
        } else {
            $email = $this->_emailProduction;
            $token = $this->_tokenProduction;
        }
        return [
            "email"=>$email,
            "token"=>$token
        ];

    }    

    public function getSession(){

        $data = \http_build_query($this->getAuthentication());
        
        if (App::environment('local')) {
            $url = $this->_url;
        } else {
            $url = $this->_urlProduction;
        }
            $response = Http::POST($url."/sessions?". $data, [
                'verify' => false
            ]);
        

        return $response;
    }

    public function sendTransaction(Payment $payment)
    {
        if (App::environment('local')) {
            $url = $this->_urlTransaction;
        } else {
            $url = $this->_urlTransactionProduction;
        }        

        $data = \http_build_query($this->getAuthentication());
        $url = $url."?". $data;

        
        $curl = curl_init();

        curl_setopt_array($curl, array(
          CURLOPT_URL => $url,
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

    public function setAssinatura($params)
    {

        if (App::environment('local')) {
            $url = $this->_urlRecorrencia;
        } else {
            $url = $this->_urlRecorrenciaProducao;
        }        
        
        $data = \http_build_query($this->getAuthenticationPlan());
        $url = $url."?". $data;
        //   CURLOPT_SSL_VERIFYPEER => 0,
        $curl = curl_init();

        curl_setopt_array($curl, array(
          CURLOPT_URL => $url,
          CURLOPT_RETURNTRANSFER => true,
          CURLOPT_POST => true,
          CURLOPT_ENCODING => '',
          CURLOPT_MAXREDIRS => 10,
          CURLOPT_TIMEOUT => 0,
          CURLOPT_FOLLOWLOCATION => true,
          CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
          CURLOPT_CUSTOMREQUEST => 'POST',
          CURLOPT_POSTFIELDS =>\json_encode($params),
        
          CURLOPT_HTTPHEADER => array(
            'Content-Type: application/json',
            'Accept: application/vnd.pagseguro.com.br.v1+json;charset=ISO-8859-1'
          ),
        ));
        
        $response = curl_exec($curl);
        // $response = \json_decode(curl_exec($curl));
        curl_close($curl);
        return $response;
    }

    public function PlanCreate($plan)
    {
        if (App::environment('local')) {
            $url = $this->_urlRecorrencia;
        } else {
            $url = $this->__urlRecorrenciaProduction;
        }   
        
        $data = \http_build_query($this->getAuthenticationPlan());     

        $url = $url."request/?". $data;
     
        $curl = curl_init();

        curl_setopt_array($curl, array(
          CURLOPT_URL => $url,
          CURLOPT_RETURNTRANSFER => true,
          CURLOPT_ENCODING => '',
          CURLOPT_MAXREDIRS => 10,
          CURLOPT_TIMEOUT => 0,
          CURLOPT_FOLLOWLOCATION => true,
          CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
          CURLOPT_CUSTOMREQUEST => 'POST',
          CURLOPT_POSTFIELDS => $plan,
          CURLOPT_HTTPHEADER => array(
            'Accept: application/vnd.pagseguro.com.br.v3+xml;charset=ISO-8859-1',
            'Content-Type: application/xml;charset=ISO-8859-1'
          ),
        ));
        
        $response = curl_exec($curl);
        curl_close($curl);
        $xml = simplexml_load_string($response);     
        $json =json_decode(json_encode($xml), true);          
        return $json;
    }



    
    
}
