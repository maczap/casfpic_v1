<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Subscription;
use App\User;
use Illuminate\Http\Request;
use DB;
use App\Services\Pagseguro;

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

    public function postbackSubscription(Request $request)
    {
        DB::table('postbacks')->insert([
            'postback' => json_encode($request->all())
        ]);

        $subscription_code = $request->all()['subscription']['id'];
        
        if(isset($request->all()['subscription']['charges'])){
            $subscription_charge = $request->all()['subscription']['charges'];
        } else {
            $subscription_charge = null;
        }

        $subscription = Subscription::where('subscription_code', $subscription_code)->first();

        if (!is_null($subscription)) {
            $subscription->status = $request->all()['subscription']['status'];
            $subscription->charge = $request->all()['subscription']['charges'];
            $subscription->save();

            $current_transaction = $request->all()['subscription']['current_transaction'];

            $neWtransaction = Transaction::where('transaction_code', $current_transaction['id'])->first();
            $subscription_charge = $request->all()['subscription']['charges'];

            if (is_null($neWtransaction)) {
                $subscription->user->transactions()->create($this->managerTransactionData($current_transaction, $subscription_charge));

                $charge = intval($subscription_charge - 1);
                Transaction::where('subscription_code', $subscription_code )
                           ->where('charge',$charge)
                           ->update([
                               'status' => $request->all()['subscription']['status']
                               
                           ]);                
            } 
          

            
            
        }

        return;
    }

    private function managerTransactionData($transaction, $charge=null)
    {
        return [
            // 'transaction_code' => $transaction['id'],
            'status' => $this->tabela_status($transaction['status']),
            'code' => $transaction['code'],
            'amount' => $transaction['grossAmount'],
            'netAmount' => $transaction['netAmount'],
            'installmentCount' => $transaction['installmentCount'],
            'reference' => $transaction['reference'],
            'date' => date('Y-m-d H:i:s', strtotime($transaction['date'])),

            // 'paid_amount' => $transaction['paid_amount'],
            // 'refunded_amount' => $transaction['refunded_amount'],
            // 'installments' => $transaction['installmentCount'],
            // 'cost' => $transaction['cost'],
            // 'subscription_code' => $transaction['subscription_id'],
            // 'postback_url' => $transaction['postback_url'],
            // 'card_holder_name' => $transaction['card_holder_name'],
            // 'card_last_digits' => $transaction['card_last_digits'],
            // 'card_first_digits' => $transaction['card_first_digits'],
            // 'card_brand' => $transaction['card_brand'],
            // 'payment_method' => $transaction['payment_method'],
            // 'boleto_url' => $transaction['boleto_url'],
            // 'boleto_barcode' => $transaction['boleto_barcode'],
            // 'charge' => $charge,
            // 'boleto_expiration_date' => date('Y-m-d H:i:s', strtotime($transaction['boleto_expiration_date']))
        ];
    }

    public function notification(Request $request){

        $notificationCode = $request["notificationCode"];
        $notificationType = $request["notificationType"];

        DB::table('postbacks')->insert([
            'postback' => json_encode($request->all())
        ]);
        $this->transaction->cadastra_retorno($notificationCode,$notificationType, $request);

        if($notificationType == "transaction"){
            $this->consultar_notificacao($notificationCode);
        } else {
            $this->search_preaproval_notification($notificationCode);
        }

        

    }

    public function transaction(Request $request){
    
        $dados = json_encode($request->all());

        DB::table('postbacks')->insert([
            'postback' => $dados->notificationCode
        ]);

        // $notificationCode = $dados->notificationCode;

        // if(isset($notificationCode)){
        //     $this->transaction_code($notificationCode);
        // }

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

        

        $code       = $xml->code;
        $reference  = $xml->reference;
        $status     = $xml->status;
        $amount     = $xml->grossAmount;        
        $subscription = Subscription::where('id', $reference)->first();
            
        
        if(!empty($subscription)){
            $plan_id = $subscription->plan_id;
            $status = $this->tabela_status($status);

            if (!is_null($subscription)) {
                $subscription->status = $status;
                $subscription->save();
            }

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
        }        
        
        
    }

    public function consultar_notificacao($code){

        $data['token'] = $this->pagseguro->_token;
        $data['email'] = $this->pagseguro->_email;

        $data = \http_build_query($data);
                
        $url = 'https://ws.pagseguro.uol.com.br/v3/transactions/notifications/'.$code.'?'.$data;

        $curl = curl_init();
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_URL, $url);

        $xml = curl_exec($curl);
        curl_close($curl);

        $xml = simplexml_load_string($xml);
        // dd($xml);
            $code  = $xml->code;
            $reference  = $xml->reference;
            $status     = $xml->status;
            $amount     = $xml->grossAmount;
        

        $subscription = Subscription::where('id', $reference)->first();
            
        
        if(!empty($subscription)){
            $plan_id = $subscription->plan_id;
            $status = $this->tabela_status($status);

            if (!is_null($subscription)) {
                $subscription->status           = $status;
                $subscription->transaction_code = $code;
                $subscription->amount           = $amount;
                $subscription->save();
            }

            $status = "Paga";

            if($status == "Paga"){

                $plan = new Plan;
                $plan = $plan::find($plan_id); 
                $plano_nick = $plan->nick;

                $user = new User;
                $user = $user::find($subscription->user_id);  
                
                $nome  = $user->name;
                $email = $user->email;

                $this->sendEmail($email, $nome, $plano_nick, $url=null, $status ='Pago');
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
        Mail::to($email)->send(new SendMailSignature($dados));
        
    }        


    public function search_preaproval_notification($code){


        $data['token'] = $this->pagseguro->_token;
        $data['email'] = $this->pagseguro->_email;

        $data = \http_build_query($data);
                
        $url = $this->pagseguro->_url.'v2/pre-approvals/notifications/'.$code.'?'.$data;

        $curl = curl_init();
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_URL, $url);

        $xml = curl_exec($curl);
        curl_close($curl);

        $xml = simplexml_load_string($xml);
        
            $code  = $xml->code;
            $reference  = $xml->reference;
            $status     = $xml->status;
            $amount     = null;
            $status = $this->tabela_status_recorrencia($status);

            $subscription = Subscription::where('id', $reference)->first();
        
            if(!empty($subscription)){            
                $plan_id = $subscription->plan_id;
                if (!is_null($xml)) {
                    $subscription->status           = $status;
                    $subscription->transaction_code = $code;
                    $subscription->amount           = $amount;
                    $subscription->save();

                    if($status == "Ativa"){

                        $plan = new Plan;
                        $plan = $plan::find($plan_id); 
                        $plano_nick = $plan->nick;
        
                        $user = new User;
                        $user = $user::find($subscription->user_id);  
                        
                        $nome  = $user->name;
                        $email = $user->email;
        
                        $this->sendEmail($email, $nome, $plano_nick, $url=null, $status ='Pago');
                    }                    
                }            
                
            }

    }


    public function search_preaproval_transaction($code){


        $data['token'] = $this->pagseguro->_token;
        $data['email'] = $this->pagseguro->_email;

        $data = \http_build_query($data);
                
        $url = $this->pagseguro->_url.'/pre-approvals/'.$code.'?'.$data;

        $curl = curl_init();
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_URL, $url);

        $xml = curl_exec($curl);
        curl_close($curl);

       

        $xml = simplexml_load_string($xml);
        
            $code  = $xml->code;
            $reference  = $xml->reference;
            $status     = $xml->status;
            $amount     = null;

            
            $status = $this->tabela_status_recorrencia($status);
            

            $subscription = Subscription::where('id', $reference)->first();
        
            if(!empty($subscription)){            
                $plan_id = $subscription->plan_id;
                if (!is_null($xml)) {
                    $subscription->status           = $status;
                    $subscription->transaction_code = $code;
                    $subscription->amount           = $amount;
                    $subscription->save();

                    if($status == "Ativa"){

                        $plan = new Plan;
                        $plan = $plan::find($plan_id); 
                        $plano_nick = $plan->nick;
        
                        $user = new User;
                        $user = $user::find($subscription->user_id);  
                        
                        $nome  = $user->name;
                        $email = $user->email;
        
                        $this->sendEmail($email, $nome, $plano_nick, $url=null, $status ='Pago');
                    }                    
                }            
                
            }

    }

    public function search_transaction_code($code){

        $data['token'] = $this->pagseguro->_token;
        $data['email'] = $this->pagseguro->_email;

        $data = \http_build_query($data);
                
        $url = $this->pagseguro->_url.'/transactions/'.$code.'?'.$data;

        $curl = curl_init();
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_URL, $url);

        $xml = curl_exec($curl);
        curl_close($curl);

       

        $xml = simplexml_load_string($xml);
        
            $code  = $xml->code;
            $reference  = $xml->reference;
            $status     = $xml->status;
            $amount     = null;
            
            $status = $this->tabela_status_recorrencia($status);
            

            $subscription = Subscription::where('id', $reference)->first();
        
            if(!empty($subscription)){            
                $plan_id = $subscription->plan_id;
                if (!is_null($xml)) {
                    $subscription->status           = $status;
                    $subscription->transaction_code = $code;
                    $subscription->amount           = $amount;
                    $subscription->save();

                    if($status == "Ativa"){

                        $plan = new Plan;
                        $plan = $plan::find($plan_id); 
                        $plano_nick = $plan->nick;
        
                        $user = new User;
                        $user = $user::find($subscription->user_id);  
                        
                        $nome  = $user->name;
                        $email = $user->email;
        
                        $this->sendEmail($email, $nome, $plano_nick, $url=null, $status ='Pago');
                    }                    
                }            
                
            }


    }

    public function consulta_pagto_card_reference($reference){


        $data['token'] = $this->pagseguro->_token;
        $data['email'] = $this->pagseguro->_email;

        $data = \http_build_query($data);
                
        $url = $this->pagseguro->_url.'v2/transactions?reference='.$reference.'&'.$data;
        
        $Curl=curl_init($url);
        curl_setopt($Curl,CURLOPT_SSL_VERIFYPEER,false);
        curl_setopt($Curl,CURLOPT_RETURNTRANSFER,true);
        $Retorno=curl_exec($Curl);
        curl_close($Curl);
            $xml = simplexml_load_string($Retorno);
            if(!empty($xml)){  
                // dd($xml);
                $code   = $xml->transactions->transaction->code;
                $status = $xml->transactions->transaction->status;
                $amount = $xml->transactions->transaction->grossAmount;
                
                $status = $this->tabela_status($status);

                $subscription = Subscription::where('id', $reference)->first();
        
                if(!empty($subscription)){            
                    $plan_id = $subscription->plan_id;
                    if (!is_null($xml)) {
                        echo $status;
                        $subscription->status           = $status;
                        $subscription->transaction_code = $code;
                        $subscription->amount           = $amount;
                        $subscription->save();
                    }
                }
            }

    }


    public function testa_consulta_pagto_card_reference($reference){


        $data['token'] = $this->pagseguro->_token;
        $data['email'] = $this->pagseguro->_email;

        $data = \http_build_query($data);
                
        $url = $this->pagseguro->_url.'v2/transactions?reference='.$reference.'&'.$data;


        $Curl=curl_init($url);
        curl_setopt($Curl,CURLOPT_SSL_VERIFYPEER,false);
        curl_setopt($Curl,CURLOPT_RETURNTRANSFER,true);
        $Retorno=curl_exec($Curl);
        curl_close($Curl);
            
           


    }

    public function tabela_status($id){

        $status = $id;
        if($id == 1){
            $status = "Aguardando pagamento";
        }
        else if ($id == 2){
            $status = "Em análise";
        }
        else if ($id == 3){
            $status = "Paga";
        }  
        else if ($id == 4){
            $status = "Disponível";
        }  
        else if ($id == 5){
            $status = "Em disputa";
        }     
        else if ($id == 6){
            $status = "Devolvida";
        }      
        else if ($id == 7){
            $status = "Cancelada";
        }            
        else if ($id == 8){
            $status = "Debitado";
        }     
        else if ($id == 9){
            $status = "Retenção temporária";
        }                    
        else if($id == 'INITIATED'){
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
}
