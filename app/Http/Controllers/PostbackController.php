<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Subscription;
use App\User;
use App\Plan;
use App\Transaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Mail\Pagamento;
use Illuminate\Support\Facades\Mail;
use Zend\Filter\File\UpperCase;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Redirect;
use QrCode;
use Illuminate\Support\Facades\Storage;

class PostbackController extends Controller
{
    private $transaction;
    private $subscription;
    

    public function __construct(Subscription $subscription){

        $this->subscription = $subscription;
        

    }

    public function transaction(Request $request)
    {
        DB::table('postbacks')->insert([
            'postback' => json_encode($request->all())
        ]);
        if(isset($request->all()['transaction']['id'])){
            $transaction_code = $request->all()['transaction']['id'];

            $transaction = Transaction::where('transaction_code', $transaction_code)->first();

            if (!is_null($transaction)) {
                $transaction->status = $request->all()['transaction']['status'];
                $transaction->save();
            }
        }

        if(isset($request->all()['subscription']['id'])){

            $subscription_code = $request->all()['subscription']['id'];

            $subscription = Subscription::where('subscription_code', $subscription_code)->first();
    
            if (!is_null($subscription)) {
                $subscription->status = $request->all()['subscription']['status'];
                $subscription->save();
    
                $current_transaction = $request->all()['subscription']['current_transaction'];
    
                $neWtransaction = Transaction::where('transaction_code', $current_transaction['id'])->first();
    
                if (is_null($neWtransaction)) {
                    $subscription->user->transactions()->create($this->managerTransactionData($current_transaction));
                }
            }            
            
        }
        return;
    }


    private function managerTransactionData($transaction)
    {
        return [
            'transaction_code' => $transaction['id'],
            'status' => $transaction['status'],
            'authorization_code' => $transaction['authorization_code'],
            'amount' => $transaction['amount'],
            'authorized_amount' => $transaction['authorized_amount'],
            'paid_amount' => $transaction['paid_amount'],
            'refunded_amount' => $transaction['refunded_amount'],
            'installments' => $transaction['installments'],
            'cost' => $transaction['cost'],
            'subscription_code' => $transaction['subscription_id'],
            'postback_url' => $transaction['postback_url'],
            'card_holder_name' => $transaction['card_holder_name'],
            'card_last_digits' => $transaction['card_last_digits'],
            'card_first_digits' => $transaction['card_first_digits'],
            'card_brand' => $transaction['card_brand'],
            'payment_method' => $transaction['payment_method'],
            'boleto_url' => $transaction['boleto_url'],
            'boleto_barcode' => $transaction['boleto_barcode'],
            'boleto_expiration_date' => date('Y-m-d H:i:s', strtotime($transaction['boleto_expiration_date']))
        ];
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
