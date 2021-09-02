<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Subscription;
use App\User;
use App\Plan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Mail\Pagamento;
use App\Services\Pagseguro;
use Illuminate\Support\Facades\Mail;
use MercadoPago;
use App\Services\MercadoPago as Mp;
use Zend\Filter\File\UpperCase;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Redirect;
use QrCode;
use Illuminate\Support\Facades\Storage;

class PostbackController extends Controller
{
    private $transaction;
    private $subscription;
    private $pagseguro;

    public function __construct(Subscription $subscription, Pagseguro $pagseguro){

        $this->subscription = $subscription;
        $this->pagseguro    = $pagseguro;

    }

    public function postback(Request $request)
    {
        $this->notification($request);
    }

    public function notification(Request $request){
        $mp = new MP ("ENV_ACCESS_TOKEN");

        $payment = $mp->get(
            "/v1/payments/". $paymentId
        );
    }


    public function transaction(Request $request){
    
        
        DB::table('postbacks')->insert([
            'postback' => json_encode($request->all())
        ]);
        
        if(isset($request["data"])){
            
            DB::table('postbacks')->insert([
                'postback' => $request["data"]["id"]
            ]);
            $id = $request["data"]["id"];
            $this->consultar_notificacao($id);
        }
    }

    public function transaction_code($code)
    {

        $data['token'] = $this->pagseguro->_token;
        $data['email'] = $this->pagseguro->_email;
        $url_padrao = $this->pagseguro->_url;

        $data = \http_build_query($data);
                
        $url = $url_padrao.'transactions/'.$code.'?'.$data;

        $curl = curl_init();
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_URL, $url);

        $xml = curl_exec($curl);
        curl_close($curl);

        $xml = simplexml_load_string($xml);

        $json =json_decode(json_encode($xml), true);
                
        $retorno = $this->managerTransactionData($json);
        

        DB::table('transactions')->insert([
            'transaction_code' => $retorno['code'],
            'status' => $retorno['status'],
            
            'reference' => $retorno['reference'],
            'amount' => $retorno['amount'],
            'netAmount' => $retorno['netAmount'],
            'installments' => $retorno['installmentCount'],
            'updated_at' => $retorno['date'],

        ]);

        $subscription = Subscription::where('id', $retorno['reference'])->first();
                
        if(!empty($subscription)){            
            // $plan_id = $subscription->plan_id;
            
                $subscription->status           =  $retorno['status'];
                $subscription->transaction_code = $retorno['code'];
                $subscription->amount           = $retorno['amount'];
                $subscription->updated_at       = $retorno['date'];
                $subscription->save();
            
        }                

        

        // $code       = $xml->code;
        // $reference  = $xml->reference;
        // $status     = $xml->status;
        // $amount     = $xml->grossAmount;        
        // $subscription = Subscription::where('id', $reference)->first();
            
        
        // if(!empty($subscription)){
        //     $plan_id = $subscription->plan_id;
        //     $status = $this->tabela_status($status);

        //     if (!is_null($subscription)) {
        //         $subscription->status = $status;
        //         $subscription->save();
        //     }

            // $status = "Paga";

            // if($status == "Paga"){

            //     $plan = new Plan;
            //     $plan = $plan::find($plan_id); 
            //     $plano_nick = $plan->nick;

            //     $user = new User;
            //     $user = $user::find($subscription->user_id);  
                
            //     $nome  = $user->name;
            //     $email = $user->email;

            //     $this->sendEmail($email, $nome, $plano_nick, $url=null, $status ='Pago');
            // }
        // }        
        
        
    }

    public function PesquisarPreferencia()
    {
 
    }

    public function consultar_notificacao($code){
        
        $curl = curl_init();
        $token = config('services.mercadopago.access_token');
        $url = "https://api.mercadopago.com/v1/payments/$code?access_token=$token";
        
        curl_setopt_array($curl, array(
            CURLOPT_URL => $url,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'GET',
          ));
          
          $response = curl_exec($curl);
          curl_close($curl);

        //   print_r($response);
          
          
          $response = json_decode($response, true);
          
          if(isset($response["status"]))
          {
            $status             =  $response["status"];
            $status_detail = null;
            if(isset($response["status_detail"])){
                $status_detail      =  $response["status_detail"];
            }
            $external_reference = null;
            if(isset($response["external_reference"])){
                $external_reference      =  $response["external_reference"];
            }      

            $payment_type_id = null;
            $payment_id = null;
            if(isset($response["payment_type_id"])){
                $payment_type_id      =  $response["payment_type_id"];
            } 

            if(isset($response["payment_id"])){
                $payment_id      =  $response["payment_id"];
            }
            
                $mensagem = null;
            if(isset($status) && isset($status_detail)) {
                $mensagem = $this->tabela_status($status, $status_detail);
            }

            
            $subscription = Subscription::where('id', $external_reference)->first();
            if(!empty($subscription)){            
                    $subscription->payment_id       = $external_reference;
                    $subscription->status           = $status;
                    $subscription->status_detail    = $status_detail;
                    $subscription->status_msg       = $mensagem;
                    $subscription->payment_method   = $payment_type_id;
                    $subscription->payment_id       = $code;
                    $subscription->save();
            }               
            
          }

    }

    public function consultar_pagamento(Request $request){

        $id = $request["id"];

        $curl = curl_init();
        $token = config('services.mercadopago.access_token');
        // $token = "TEST-ac6115de-e7b8-4b7e-8171-64183a0fd87e";

        $url = "https://api.mercadopago.com/v1/payments/search?sort=date_created&criteria=desc&external_reference=$id";

        curl_setopt($curl, CURLOPT_URL,$url);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1 );
        curl_setopt($curl, CURLOPT_HTTPHEADER, array(
            'Authorization: Bearer ' . $token,
            'Content-type: application/json',
          ));        
        
        // "payer_email": "test_user_91922613@testuser.com",
        $response = curl_exec($curl);
        curl_close($curl);
        print_r($response);
        $response = json_decode($response, true);
          if(isset($response["results"])){
              if(isset($response["results"][0])){
                 
                $id = $response["results"][0]["id"];
                
                $this->consultar_notificacao($id);
              }
          }
        
    }

    public function sendEmail($email, $nome, $plano_plano, $url, $status){
        // Mail::to($email)->send(new SendMailSignature($email, $nome, $plano_plano));
        $n = explode(" ",$nome);
        $nome = $n[0];
        $dados = [
            'email' => $email,
            'nome'  => $nome,
            'plano' => $plano_plano,
            'url'   => $url,
            'status'=> $status
        ];
        Mail::to($email)->send(new Pagamento($dados));
        
    }        


    public function tabela_status($status, $status_details){

        $mensagem = "";
        if($status == "approved" && $status_details == "accredited" ){
            $mensagem = "Pagamento aprovado";
        }
        else if($status == "in_process" && $status_details == "pending_contingency" ){
            $mensagem = "Estamos processando o pagamento. Não se preocupe, em menos de 2 dias úteis informaremos por e-mail se foi creditado.";
        }        
        else if($status == "approved" && $status_details == "pending_review_manual" ){
            $mensagem = "Não se preocupe, em menos de 2 dias úteis informaremos por e-mail se foi creditado ou se necessitamos de mais informação.";
        }       
        else if($status == "rejected" && $status_details == "cc_rejected_bad_filled_card_number" ){
            $mensagem = "Revise o número do cartão.";
        }    
        else if($status == "rejected" && $status_details == "cc_rejected_bad_filled_date" ){
            $mensagem = "Revise a data de vencimento.";
        }           
        else if($status == "rejected" && $status_details == "cc_rejected_bad_filled_other" ){
            $mensagem = "Revise os dados.";
        }      
        else if($status == "rejected" && $status_details == "cc_rejected_bad_filled_security_code" ){
            $mensagem = "Revise o código de segurança do cartão.";
        }          
        else if($status == "rejected" && $status_details == "cc_rejected_blacklist" ){
            $mensagem = "Não pudemos processar seu pagamento.";
        }          
        else if($status == "rejected" && $status_details == "cc_rejected_call_for_authorize" ){
            $mensagem = "Você deve autorizar ao payment_method_id o pagamento do valor ao Mercado Pago.";
        }        
        else if($status == "rejected" && $status_details == "cc_rejected_card_disabled" ){
            $mensagem = "Ligue para o payment_method_id para ativar seu cartão. O telefone está no verso do seu cartão.";
        }    
        else if($status == "rejected" && $status_details == "cc_rejected_card_error" ){
            $mensagem = "Não conseguimos processar seu pagamento.";
        }           
        else if($status == "rejected" && $status_details == "cc_rejected_duplicated_payment" ){
            $mensagem = "Você já efetuou um pagamento com esse valor. Caso precise pagar novamente, utilize outro cartão ou outra forma de pagamento.";
        }              
        else if($status == "rejected" && $status_details == "cc_rejected_high_risk" ){
            $mensagem = "Escolha outra forma de pagamento. Recomendamos meios de pagamento em dinheiro.";
        }       
        else if($status == "rejected" && $status_details == "cc_rejected_insufficient_amount" ){
            $mensagem = "O payment_method_id possui saldo insuficiente.";
        }         
        else if($status == "rejected" && $status_details == "cc_rejected_invalid_installments" ){
            $mensagem = "O payment_method_id não processa pagamentos em installments parcelas.";
        }       
        else if($status == "rejected" && $status_details == "cc_rejected_max_attempts" ){
            $mensagem = "Escolha outro cartão ou outra forma de pagamento.";
        }       
        else if($status == "rejected" && $status_details == "cc_rejected_other_reason" ){
            $mensagem = "payment_method_id não processa o pagamento.";
        }                                                                                  
        return $mensagem;                     
    }

    public function tabela_status_recorrencia($id){

        $status = null;
        if($id == 'INITIATED'){
            $status = "Iniciada";
        }
        else if ($id == 'PENDING'){
            $status = "Em análise";
        }
        else if ($id == 'ACTIVE'){
            $status = "Ativa";
        }  
        else if ($id == 'PAYMENT_METHOD_CHANGE'){
            $status = "Problema no Cartão";
        }  
        else if ($id == 'SUSPENDED'){
            $status = "	Recorrência Suspensa";
        }     
        else if ($id =='CANCELLED'){
            $status = "Cancelada PagSeguro";
        }      
        else if ($id == 'CANCELLED_BY_RECEIVER'){
            $status = "Cancelada Vendedor";
        }    
        else if ($id == 'CANCELLED_BY_SENDER'){
            $status = "Cancelada Comprador";
        }                   
        else if ($id == 'EXPIRED'){
            $status = "Expirada";
        }     
                 
        return $status;                     
    }    

    public function autorizacao()
    {
        $appID = $this->pagseguro->_appID;
        $appKey = $this->pagseguro->_appKey;

        // $appID  = "app8844053095copiar";
        // $appKey = "220D5468999990511487AF8B40C9986B";        

        $url = "https://ws.sandbox.pagseguro.uol.com.br/v2/authorizations/request/?appId=$appID&appKey=$appKey";

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
          CURLOPT_POSTFIELDS =>'<?xml version="1.0" encoding="UTF-8" standalone="yes"?>
        <authorizationRequest>
            <reference>REF1234</reference>
            <permissions>
                <code>CREATE_CHECKOUTS</code>
                <code>RECEIVE_TRANSACTION_NOTIFICATIONS</code>
                <code>SEARCH_TRANSACTIONS</code>
                <code>MANAGE_PAYMENT_PRE_APPROVALS</code>
                <code>DIRECT_PAYMENT</code>
            </permissions>
            <redirectURL>https://casfpic.org.br"</redirectURL>
            <notificationURL>https://casfpic.org.br/api/postback"</notificationURL>
        </authorizationRequest>',
          CURLOPT_HTTPHEADER => array(
            'Content-Type: application/xml'
          ),
        ));
        
        $response = curl_exec($curl);
        
        curl_close($curl);
        echo $response;

    }

    public function consultar_autorizacao()
    {
        $curl = curl_init();

        curl_setopt_array($curl, array(
          CURLOPT_URL => 'https://sandbox.pagseguro.uol.com.br/v2/authorization/request.jhtml?code=65674F57D54B4D5D9B5C7A03A6E4504C',
          CURLOPT_RETURNTRANSFER => true,
          CURLOPT_ENCODING => '',
          CURLOPT_MAXREDIRS => 10,
          CURLOPT_TIMEOUT => 0,
          CURLOPT_FOLLOWLOCATION => true,
          CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
          CURLOPT_CUSTOMREQUEST => 'GET',
          CURLOPT_HTTPHEADER => array(
            'Content-Type: application/xml'
          ),
        ));
        
        $response = curl_exec($curl);
        
        curl_close($curl);
        echo $response;        
    }

    public function createTransaction($retorno)
    {
        DB::table('transactions')->insert([
            'user_id'           => 1,
            'date'              => date('Y-m-d H:i:s', strtotime($retorno['date'])),
            'code'              => $retorno['code'],
            'reference'         => $retorno['reference'],
            'type'              => $retorno['type'],
            'status'            => $retorno['status'],
            'lastEventDate'     => date('Y-m-d H:i:s', strtotime($retorno['lastEventDate'])),            
            'paymentMethodType'     => $retorno['paymentMethod']['type'],                        
            'paymentMethodCode'     => $retorno['paymentMethod']['code'],                        
            
            'grossAmount'            => $retorno['grossAmount'],
            'discountAmount'         => $retorno['grossAmount'],
            'creditorFeesInstallmentFeeAmount'     => $retorno['creditorFees']['installmentFeeAmount'],
            'creditorFeesIntermediationRateAmount' => $retorno['creditorFees']['intermediationRateAmount'],
            'creditorFeesIntermediationFeeAmount'  => $retorno['creditorFees']['intermediationFeeAmount'],

            'netAmount'            => $retorno['netAmount'],
            'extraAmount'          => $retorno['extraAmount'],
            'installmentCount'     => $retorno['installmentCount'],
            'itemCount'            => $retorno['itemCount'],

            'itemId'            => $retorno['items']['item']['id'],
            'itemDescription'   => $retorno['items']['item']['description'],
            'itemQuantity'      => $retorno['items']['item']['quantity'],
            'itemAmount'        => $retorno['items']['item']['amount']


        ]);        
    }

    public function success(Request $request){

        $id = $request["collection_id"];
        $id = Crypt::decryptString($id);
        
        $user = new user();
        $dados = $user->user_view($id);
        foreach ($dados as $item) {
            $nome           = $item->name;
            $boleto_url     = $item->boleto_url;
            $boleto_barcode = $item->boleto_barcode;
            $plano          = $item->plano;
            $periodo        = $item->periodo;
            $status        = $item->status;
            $status_detail        = $item->status_detail;
            print_r($status);
            $n = \explode(" ", $nome);
            $nome = $n[0];
            $nome = \strtolower($nome);
            $nome = ucfirst($nome);

            
            return view('layouts.success', ['nome' => $nome, 'plano' => $plano, 
            'periodo' => $periodo, 'boleto_url' => $boleto_url, 'boleto_barcode', $boleto_barcode, 
            'status' => $status, 'status_detail' => $status_detail ]);            
            
        }
      
    }
    public function billet(Request $request){
        $id = $request["collection_id"];
        $id = Crypt::decryptString($id);
        
        $user = new user();
        $dados = $user->user_view($id);
        foreach ($dados as $item) {
            $nome           = $item->name;
            $boleto_url     = $item->boleto_url;
            $boleto_barcode = $item->boleto_barcode;
            $plano          = $item->plano;
            $periodo        = $item->periodo;
            $boleto_url     = $item->boleto_url;
            $boleto_barcode = $item->boleto_barcode;
            
            $n = \explode(" ", $nome);
            $nome = $n[0];
            $nome = \strtolower($nome);
            $nome = ucfirst($nome);

            
            return view('layouts.billet', [
                                            'nome'          => $nome, 
                                            'plano'         => $plano, 
                                            'periodo'       => $periodo,
                                            'boleto_url'    => $boleto_url,
                                            'boleto_barcode'=> $boleto_barcode
                                        ]);
        }
    }
    public function generateQrcode($url, $id){

        // \QrCode::size(300)
        
        // ->generate("$url", public_path("images/qrcode/$id.png"));        
        // return view('qrCode');
        $img =  base64_encode(QrCode::format('png')->size(200)->generate('https://www.servclube.com.br/convenio/odontoprev_promo/p/akdz857l8ckzmcnykn996wxx6bvqqxpwsraq3zigqijz8ak6vte8irgd7ehwmy02'));
        return '<img src="data:image/png;base64,'. $img .'">';
    }
    
    public function pix(Request $request){


               
        $id = $request["collection_id"];
        $id = Crypt::decryptString($id);
        
        $user = new user();
        $dados = $user->user_view($id);
        foreach ($dados as $item) {
            
            $subscription_id= $item->subscription_id;
            $nome           = $item->name;
            $boleto_url     = $item->boleto_url;
            $boleto_barcode = $item->boleto_barcode;
            $plano          = $item->plano;
            $periodo        = $item->periodo;
            $pix_qr_code     = $item->pix_qr_code;
            $pix_expiration_date = $item->pix_expiration_date;

            $n = \explode(" ", $nome);
            $nome = $n[0];
            $nome = \strtolower($nome);
            $nome = ucfirst($nome);

            $img = $this->generateQrcode($pix_qr_code, $subscription_id);
            
            
            return view('layouts.pix', [
                                            'nome'          => $nome, 
                                            'plano'         => $plano, 
                                            'periodo'       => $periodo,
                                            'pix_qr_code'    => $pix_qr_code,
                                            'pix_expiration_date'=> $pix_expiration_date,
                                            'image'          => $img,
                                            'url'            => $pix_qr_code
                                        ]);
        }
    }
    public function transactionStatus($status){
        $mensagem = null;
        if($status == "processing"){
            $mensagem = "Transação está em processo de autorização.";
        }
        else if($status == "authorized"){
            $mensagem = "Transação foi autorizada.";
        }      
        else if($status == "paid"){
            $mensagem = "Transação paga.";
        }         
        else if($status == "refunded"){
            $mensagem = "Transação estornada completamente.";
        }       
        else if($status == "waiting_payment"){
            $mensagem = "Transação aguardando pagamento (status válido para Boleto bancário).";
        }          
        else if($status == "pending_refund"){
            $mensagem = "Transação do tipo Boleto e que está aguardando confirmação do estorno solicitado.";
        }     
        else if($status == "pending_refund"){
            $mensagem = "Transação do tipo Boleto e que está aguardando confirmação do estorno solicitado.";
        }            
        else if($status == "refused"){
            $mensagem = "Transação recusada, não autorizada.";
        }      
        else if($status == "chargedback"){
            $mensagem = "Transação sofreu chargeback. Veja mais sobre isso em nossa ";
        }       
        else if($status == "analyzing"){
            $mensagem = "Transação encaminhada para a análise manual feita por um especialista em prevenção a fraude.";
        }       
        else if($status == "pending_review"){
            $mensagem = "Transação pendente de revisão manual por parte do lojista. Uma transação ficará com esse status por até 48 horas corridas.";
        }        
        else if($status == "waiting_payment"){
            $mensagem = "Aguardando pagamento";
        }               
        
        return $mensagem;

    }

}
