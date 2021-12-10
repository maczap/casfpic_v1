<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use App\User;
use App\Plan;
use App\Dependent;
use App\Services\MercadoPago as Mp;
use App\Mail\Obrigado;
use App\Subscription;
use App\Mail\Pagamento;
use App\Mail\NotificacaoCadastro;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\DB;
Use \Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use App\Services\PagarmeRequestService;
use Illuminate\Contracts\Encryption\DecryptException;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Http\RedirectResponse;
use MercadoPago;
use Exception;
use QrCode;
use Illuminate\Support\Facades\Storage;

class ControllerCadastro extends Controller
{

    private $mercadoPago;
    private $post;
    private $promotores;

    public function __construct(PostbackController $post, ControllerPromotores $promotores){

        $this->post        = $post;
        $this->promotores  = $promotores;

     // MercadoPago\SDK::setClientId(config('services.mercadopago.client_id'));  
     // MercadoPago\SDK::setClientSecret(config('services.mercadopago.client_secret'));   
        // MercadoPago\SDK::setAccessToken(config('services.mercadopago.access_token'));          


    }

    public function success(){
        return view('layouts.success');
    }

    public function cadastro(Request $request)
    {

            

        $cookie_promotor = \Request::cookie('pmtcsfpc');
        
        
        $promotor_id = "FD1809";   

        if(isset($cookie_promotor)){
            $promotor_id = $cookie_promotor;
        }
             
        $payment_methods = $request["paymentMethod"];
        
        
        if(isset($cookie_promotor)){
            
            $promotor = $this->promotores->getPromotor($cookie_promotor);
            // if(isset($promotor->promotor_id)){
            //     $promotor_id = $promotor->promotor_id;
            // } 
        }  else {
            $promotor = $this->promotores->getPromotor('FD1809');
        }      

        $rec_id = $promotor["rec_id"];
        
       
        if($payment_methods == "cartao"){
 
            $rules = [
                'cpf'           => 'required',
                'name'          => 'required',
                'senha'         => 'required',  
                'rg'            => 'required',  
                'sexo'          => 'required',  
                'cep'           => 'required',  
                'endereco'      => 'required',  
                'numero'        => 'required',              
                'cidade'        => 'required',    
                'email'         => 'required|string|email|max:40|unique:users',
                'ecivil'        => 'required', 
                'celular'       => 'required', 
                'nascimento'    => 'required', 
                'profissao'     => 'required', 
    
                'plano'         => 'required', 
                'periodo'       => 'required', 

                'card_number'    => 'required', 
                'card_nome'      => 'required', 
                'card_vencimento'=> 'required', 
                'card_cvv'       => 'required'
 
            ];
            $messages = [
                'cpf.required'              => 'CPF Inválido',
                'name.required'             => 'Nome é obrigatório',
                'senha.required'            => 'Informe a Senha',
                'rg.required'               => 'RG Inválido',
                'sexo.required'             => 'É obrigatório informar o sexo',
                'cep.required'              => 'É obrigatório informar o CEP',
                'endereco.required'         => 'É obrigatório informar o Endereço',
                'numero.required'           => 'É obrigatório informar o Número',
                'cidade.required'           => 'É obrigatório informar a Cidade',

                'email.required'    => 'O E-mail é obrigatório',
                'email.string'      => 'O E-mail deve ser uma string',
                'email.max'         => 'O E-mail deve ter no máximo 40 caracteres',
                'email.unique'      => 'Este email ja está cadastrado',

                'ecivil.required'           => 'É obrigatório informar o estado civil',
                'celular.required'          => 'É obrigatório informar o Celular',
                'nascimento.required'       => 'É obrigatório informar a data de nascimento',
                'profissao.required'        => 'É obrigatório informar a profissão',
    
                'plano.required'            => 'Informe o Plano',
                'periodo.required'          => 'Informe o Período',

                'card_number.required'     => 'Informe o Número do Cartão',
                'card_nome.required'       => 'Informe o Nome no Cartão',
                'card_vencimento.required' => 'Informe o Vencimento do Cartão',
                'card_cvv.required'        => 'Informe o CVV do Cartão'
                
            ];        

            $vc = \explode("/",$request['card_vencimento']);
            $card_mes = $vc[0];
            $card_ano = $vc[1];
            
        } else {
            $rules = [
                'cpf'           => 'required',
                'name'          => 'required',
                'senha'         => 'required',  
                'rg'            => 'required',  
                'sexo'          => 'required',  
                'cep'           => 'required',  
                'endereco'      => 'required',  
                'numero'        => 'required',              
                'cidade'        => 'required',    
                'email'         => 'required|string|email|max:40|unique:users',
                'ecivil'        => 'required', 
                'celular'       => 'required', 
                'nascimento'    => 'required', 
                'profissao'     => 'required', 
    
                'plano'         => 'required', 
                'periodo'       => 'required', 
                'operadora'     => 'required', 
 
            ];
            $messages = [
                'cpf.required'              => 'CPF Inválido',
                'name.required'             => 'Nome é obrigatório',
                'senha.required'            => 'Informe a Senha',
                'rg.required'               => 'RG Inválido',
                'sexo.required'             => 'É obrigatório informar o sexo',
                'cep.required'              => 'É obrigatório informar o CEP',
                'endereco.required'         => 'É obrigatório informar o Endereço',
                'numero.required'           => 'É obrigatório informar o Número',
                'cidade.required'           => 'É obrigatório informar a Cidade',

                'email.required'    => 'O E-mail é obrigatório',
                'email.string'      => 'O E-mail deve ser uma string',
                'email.max'         => 'O E-mail deve ter no máximo 40 caracteres',
                'email.unique'      => 'Este email ja está cadastrado',

                'ecivil.required'           => 'É obrigatório informar o estado civil',
                'celular.required'          => 'É obrigatório informar o Celular',
                'nascimento.required'       => 'É obrigatório informar a data de nascimento',
                'profissao.required'        => 'É obrigatório informar a profissão',
    
                'plano.required'            => 'Informe o Plano',
                'periodo.required'          => 'Informe o Período',
                'operadora.required'        => 'Informe a Operadora',
                
            ];                
        }     
        

        $validator = Validator::make($request->all(),$rules, $messages);
        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()]);
        } 
        else {
                
            $ns = $request['nascimento'];
            $ns = explode("/",$ns);
            $dia = $ns[0];
            $mes = $ns[1];
            $ano = $ns[2];
            $nascimento = $ano."-".$mes."-".$dia; 

            $cpf = $this->clear($request['cpf']);
            $zipcode = $this->clear($request['cep']);
           
            $senha = trim($request->password);

            $plano      = $request['plano'];
            $periodo    = $request['periodo'];
            $operadora  = $request['operadora'];

            $total_dep =  count($request['dependentes']);

            $dados_plano = $this->get_plan($plano, $periodo, $total_dep);
            
            $plano_codigo   = $dados_plano->codigo;
            $plano_codigo_integracao   = $dados_plano->codigo_integracao;
            $plano_id       = $dados_plano->id;
            $plano_name     = $dados_plano->descricao;
            $plano_nick     = $dados_plano->nick; 
            $plano_amount   = $dados_plano->amount;   

            $percent_promotor   = $dados_plano->percent_promotor;   
            $percent_titular = 100-$percent_promotor;

        
            $ddd        = $this->clear(substr($request['celular'], 1, 2));
            $celular    = $this->clear(substr($request['celular'], 4, 11));  

            $cell = $ddd;
            $cell .= $celular;

            $userAuth = Auth::user();

            $pagarme = new PagarmeRequestService();

            
            try{
                DB::beginTransaction();

                    // if (Auth::check() && !is_null($userAuth->pagarme_id)) {

                    // $customer = $pagarme->getCustomer($userAuth->pagarme_id);
                    
                    // } else {

                        $dados = User::create([
                            'name'      => \strtoupper($request['name']),
                            'nomemae'      => \strtoupper($request['nomemae']),
                            'email'     => $request['email'],
                            'cpf'       => $request['cpf'],
                            'rg'        => $request['rg'],
                            'sexo'      => $request['sexo'],
                            'cep'       => $request['cep'],
                            'endereco'  => \strtoupper($request['endereco']),
                            'numero'    => $request['numero'],
                            'complemento'   => \strtoupper($request['complemento']),
                            'bairro'    => \strtoupper($request['bairro']),
                            'cidade'    => \strtoupper($request['cidade']),
                            'uf'        => \strtoupper($request['uf']),
                            'celular'   => $request['celular'],
                            'nascimento'=> $nascimento,
                            'ecivil'    => $request['ecivil'],
                            'profissao' => \strtoupper($request['profissao']),
                            'area_atuacao' => $request['area'],
                            'password' => Hash::make($senha),
                            'vinculo' => $promotor_id
                        ]);      
                        
                        if(isset($dados["id"])){

                            $id_user = $dados["id"];
                            $dependentes = $request['dependentes'];                
                        
                            if(count($dependentes) > 0){
                                foreach($dependentes as $item){
                                    $nome = $item['nome'];
                                    $nome = strtoupper($nome);
                                    $nomemae = $item['nomemae'];
                                    $cpf  = $this->clear($item['cpf']);
                                    $parentesco = $item['parentesco'];
                                    $sexo = $item['sexo'];
                                    $nascimento = $item['nasc'];

                                    $ns = $nascimento;
                                    $ns = explode("/",$ns);
                                    $dia = $ns[0];
                                    $mes = $ns[1];
                                    $ano = $ns[2];
                                    $nascimento = $ano."-".$mes."-".$dia;  

                                    
                                        $dep = Dependent::create([
                                            'user_id'       => $dados->id, 
                                            'nome'          => strtoupper($nome), 
                                            'nomemae'       => strtoupper($nomemae), 
                                            'cpf'           => $cpf, 
                                            'parentesco'    => $parentesco, 
                                            'sexo'          => $sexo, 
                                            'nascimento'    => $nascimento
                                                                
                                        ]);
                                    
                                }
                            }      


                        }

                        $phone_numbers = [sprintf('%s%s', '+55', $cell)];
                        $phone = [
                            'ddd'       => $ddd,
                            'number'    => $this->clear($celular)
                        ];

                        $documents = [
                            [
                                'type' => 'cpf',
                                'number' => $this->clear($request['cpf'])
                            ]
                        ];

                        $address = [
                            'street'        => \strtoupper($request['endereco']),
                            'street_number' => $request['numero'],
                            'zipcode'       => $this->clear($request['cep']),
                            'country'       => 'br',
                            'state'         => $request['uf'],
                            'city'          => \strtoupper($request['cidade']),
                            'complementary' => \strtoupper($request['complemento']),
                            'neighborhood'  => \strtoupper($request['bairro'])
                            
                        ];                    

                        $cpf = $this->clear($request['cpf']);
                        $customer = $pagarme->createCustomer($request['name'], $request['email'],$dados["id"], $phone_numbers, $documents);         

                        if (isset($customer['errors'])) {
                            
                            return response()->json(["errors" => ["Dados" => ["Dados incompletos"]]]);
                        }
                        if(isset($customer["id"])){
                            $usuario = User::where('id', $dados["id"])->first();
                            $usuario->pagarme_id = $customer["id"];
                            $usuario->save();
                        }
        // 
                    // }



                        $card_id = null;
                        $boleto_url = null;
                        $boleto_barcode = null;
                        


                        if($payment_methods == "cartao"){
                        
                            if (!empty($usuario->usercards()->card_id)) {
                                $card_id = $usuario->usercards()->card_id;
                                
                            }else{

                                $card_expiration_date = sprintf('%s%s', $card_mes, $card_ano);
                                $card = $pagarme->createCreditCard($customer['id'], $this->clearCard($request["card_number"]), $card_expiration_date, $request['card_nome'], $request['card_cvv']);
                                
                                if (isset($card['errors'])) {
                                    return response()->json(["errors" => ["Cartão" => ["Erro nas informações do cartão"]]]);
                                }
                                
                                $usuario->usercards()->create([
                                    'card_id' => $card['id'],
                                    'brand' => $card['brand'],
                                    'last_digits' => $card['last_digits'],
                                    'holder_name' => $card['holder_name']
                                ]);
                                $card_id = $card['id'];
                                
                            }

                        } 

                        if($periodo == "anual"){
                            $amount = $this->clear($plano_amount);
                            $items = [
                                'id'            => "$plano_id",
                                'title'         => $plano_name,
                                'unit_price'    => $amount,
                                "quantity"      => 1,
                                "tangible"      => false                            
                            ];    
                            
                            $transaction = $pagarme->createTransaction($customer, $documents, $payment_methods, $card_id, $address, $phone, $amount, $items, $plano_name, $rec_id, $percent_promotor, $percent_titular);
                            
                            if (isset($transaction['errors'])) {
                            
                                return response()->json(["errors" => ["Transação" => ["Erro na transação.. Entre em contato conosco"]]]);
                            }

                            
                            $amount = null;
                            $manage_url = null;
                            $boleto_url = null;
                            $boleto_barcode = null;  
                            $pix_qr_code = null;
                            $pix_expiration_date	= null;
                            $boleto_expiration_date = null;

                            
                            if(isset($transaction["boleto_url"])){
                                $boleto_url = $transaction["boleto_url"];
                                $boleto_barcode = $transaction["boleto_barcode"];
                                $boleto_expiration_date = $transaction["boleto_expiration_date"];
                                $boleto_expiration_date = date("Y-m-d", strtotime($boleto_expiration_date));  
                            }

                            if(isset($transaction["pix_qr_code"])){
                                $pix_qr_code = $transaction["pix_qr_code"];
                                $pix_expiration_date = $transaction["pix_expiration_date"];
                                $pix_expiration_date = date("Y-m-d", strtotime($pix_expiration_date));  
                            }                            
        
                            if(isset($transaction["amount"])){
                                $amount = $transaction["amount"]/100;
                                $amount = number_format($amount, 2);
                            }    

                            $status_details = $this->post->transactionStatus($transaction["status"]);
                            $usuario->subscriptions()->create([
                                'subscription_code' => $transaction['id'],
                                'plan_id'          => $plano_id,
                                'status'           => $transaction["status"],
                                'periodo'          => $request["periodo"],
                                'amount'           => $amount,
                                'plano'            => $plano_name,
                                'payment_method'   => $payment_methods,
                                'boleto_url'       => $boleto_url,
                                'boleto_barcode'   => $boleto_barcode,
                                'status_detail'    => $status_details,
                                'pix_qr_code'      => $pix_qr_code,
                                'pix_expiration_date' => $pix_expiration_date,
                                'boleto_expiration_date' => $boleto_expiration_date,
                                'operadora'         => $operadora
                                
                            ]);   

                        }  
                        else if($periodo == "mensal") {
                            $amount = $this->clear($plano_amount);

                            if($payment_methods == "boleto"){

                                $subscription["id"] = $dados["id"];

                            }else{
                                $subscription = $pagarme->createSubscription($customer,$plano_codigo_integracao, $payment_methods, $card_id, $address, $phone, $amount, $plano_name, $rec_id, $percent_promotor, $percent_titular);
                            }
                       
                                                                                                                       
                            
                            if (isset($subscription['errors'])) {
                                return $subscription['errors'];
                                // return response()->json(["errors" => ["Transação" => ["Erro na transação.. Entre em contato conosco"]]]);
                            }

                            // $this->postobrigado($email, $nome, $plano_plano, $boleto_url= null, $boleto_barcode = null, $periodo, $status);
                            
                            $amount = null;
                            $manage_url = null;
                            $manage_token = null;
                            $boleto_url = null;
                            $boleto_barcode = null;  
                            $pix_qr_code = null;
                            $pix_expiration_date	= null;
                            $boleto_expiration_date = null;
                            
                            if(isset($subscription["manage_url"])){
                                $manage_url     = $subscription["manage_url"];
                                $manage_token   = $subscription["manage_token"];
                            }

                            if(isset($subscription["current_transaction"]["boleto_url"])){
                                $boleto_url             = $subscription["current_transaction"]['boleto_url'];
                                $boleto_barcode         = $subscription["current_transaction"]['boleto_barcode'];
                                $boleto_expiration_date = $subscription["current_transaction"]['boleto_expiration_date'];
                                $boleto_expiration_date = date("Y-m-d", strtotime($boleto_expiration_date));  
                            }
        
                            if(isset($subscription["amount"])){
                                $amount = $subscription["amount"]/100;
                                $amount = number_format($amount, 2);
                            }    


                            if($payment_methods == "boleto"){
                                $status = "unpaid";
                                $subscription_id = $dados["id"];
                                $status_details = "Aguardando Pagamento";


                            } else {
                                $status_details = $this->post->transactionStatus($subscription["status"]);
                                $subscription["status"];
                                $status = $subscription["status"];
                                $subscription_id = $subscription['id'];
                            }
                           
                            $usuario->subscriptions()->create([
                                'subscription_code' => $subscription_id,
                                'plan_id'          => $plano_id,
                                'status'           => $status,
                                'periodo'          => $request["periodo"],
                                'amount'           => $amount,
                                'plano'            => $plano_name,
                                'payment_method'   => $payment_methods,
                                'boleto_url'       => $boleto_url,
                                'boleto_barcode'   => $boleto_barcode,
                                'status_detail'    => $status_details,
                                'pix_qr_code'      => $pix_qr_code,
                                'pix_expiration_date' => $pix_expiration_date,
                                'boleto_expiration_date' => $boleto_expiration_date,
                                'manage_url'       => $manage_url,
                                'manage_token'     => $manage_token,
                                'operadora'         => $operadora
                                
                            ]);   
                        }
                
                DB::commit();        

                $nome = \strtoupper($request['name']);
                $email = $request['email'];
                $manage_url = null;
                $manage_token = null;
                $boleto_url = null;
                $boleto_barcode = null;  
                $pix_qr_code = null;
                $pix_expiration_date	= null;
                $boleto_expiration_date = null;

                if(isset($subscription["current_transaction"]["boleto_url"])){
                    $boleto_url             = null;
                    $boleto_barcode         = null;
                    $boleto_expiration_date = null;
                    $boleto_expiration_date = null;  
                }

                if($periodo == "mensal"){

                    if(!$payment_methods == "boleto"){
                        $this->obrigado($payment_methods, $email, $nome, $plano_name, 
                        $boleto_url, $boleto_barcode, 
                        $periodo, $subscription["status"]);
                    }

                    if($payment_methods == "boleto"){

                        $id = Crypt::encryptString($dados["id"]);

                        $url = "https://casfpic.org.br/api/checkout/billet?collection_id=".$id;

                        //$this->post->sendEmail($email, $nome, $plano_name, $url, $subscription['status']);                        
                        return $url;
                    }

                    if($payment_methods == "cartao" && $subscription['status'] == "paid"){
                        $id = Crypt::encryptString($dados["id"]);
                        $url = "https://casfpic.org.br/api/checkout/success?collection_id=".$id;
                        $this->post->sendEmail($email, $nome, $plano_name, $url, $subscription['status']);
                        return $url;
                    }     
                }elseif($periodo == "anual"){   
                    
                    if(isset($transaction["boleto_url"])){
                        $boleto_url             = null;
                        $boleto_barcode         = null;
                        $boleto_expiration_date = null;
                        $boleto_expiration_date = null;  
                    }                    
                    
                    // $this->obrigado($payment_methods, $email, $nome, $plano_name, 
                    // $boleto_url, $boleto_barcode, 
                    // $periodo, "unpaid");


                    if($payment_methods == "boleto"){
                        $id = Crypt::encryptString($dados["id"]);
                        $url = "https://casfpic.org.br/api/checkout/billet?collection_id=".$id;
                        return $url;
                    }

                    if($payment_methods == "cartao" && $transaction['status'] == "paid"){
                       
                        $id = Crypt::encryptString($dados["id"]);
                        $url = "https://casfpic.org.br/api/checkout/success?collection_id=".$id;
                        
                        return $url;
                    }  

                    if($payment_methods == "pix" && $transaction['status'] == "waiting_payment"){



                        $id = Crypt::encryptString($dados["id"]);
                        $url = "https://casfpic.org.br/api/checkout/pix?collection_id=".$id;
                        $this->post->sendEmail($email, $nome, $plano_name, $url, $transaction['status']);
                        return $url;
                    }                     
                }

                $name = \strtoupper($request['name']);
       
                $dados = [
                    'nome'   => $name
                ];
                Mail::to("financeiro@servclube.com.br")->send(new NotificacaoCadastro($dados));                        

                return [];
                
            } catch (Exception $e){
                DB::rollback();
                return $e;
            }  

               
            


        }        
        
    }


    public function get_plan($plano, $periodo, $total_dep)
    {
        $ambiente = null;
        if(config('services.pagarme.ambiente') == "local"){
            $ambiente = "teste";
        } else {
            $ambiente = "producao";
        }

        $dados = Plan::where('nick',$plano)
                     ->where('periodo',$periodo)
                     ->where('tipo',$ambiente)
                     ->where('qtd_dep',$total_dep)
                     ->get();
        

        if(isset($dados[0])){
            return $dados[0];
        } else {
            return 0;
        }                     
        
    }        

    public function clear($string){
        $string = \str_replace("(","",$string);
        $string = \str_replace(")","",$string);
        $string = \str_replace(" ","",$string);
        $string = \str_replace("-","",$string);
        $string = \str_replace(".","",$string);
        $string = \str_replace(",","",$string);
        $string = \str_replace("/","",$string);
        $string = trim($string);
        return $string;
    }    
    public function clearCard($string){
        $string = \str_replace(" ","",$string);
        $string = trim($string);
        return $string;
    }       
    public function remover_acentos($str){


        $from = "áàãâéêíóôõúüçÁÀÃÂÉÊÍÓÔÕÚÜÇ";
        $to = "aaaaeeiooouucAAAAEEIOOOUUC";

        $keys = array();
        $values = array();
        preg_match_all('/./u', $from, $keys);
        preg_match_all('/./u', $to, $values);
        $mapping = array_combine($keys[0], $values[0]);
        return strtr($str, $mapping);  
    
    }    

    public function vencimento($periodo){

        $atual = Carbon::now();
        $atual = $atual->toDateTimeString();
        if($periodo == "anual"){
            $vencimento = date('Y-m-d', strtotime('+365 days'));
        } else {
            $vencimento = date('Y-m-d', strtotime('+30 days'));
        }
        
        return $vencimento;        
    }    

    public function preaproval(){

        return view('welcome');
    }

    public function SendEmail($email, $nome, $method, $link = null){

        $name = explode(" ", strtolower($nome));
       
        $dados = [
            'nome'   => ucfirst($name[0]),
            'method' => $method,
            'url'    => $link
        ];
        Mail::to($email)->send(new Obrigado($dados));        
    }    

    public function generatePassword($qtyCaraceters = 6)
    {
        //Letras minúsculas embaralhadas
        $smallLetters = str_shuffle('abcdefghijklmnopqrstuvwxyz');
     
        //Letras maiúsculas embaralhadas
        $capitalLetters = str_shuffle('ABCDEFGHIJKLMNOPQRSTUVWXYZ');
     
        //Números aleatórios
        $numbers = (((date('Ymd') / 12) * 24) + mt_rand(800, 9999));
        $numbers .= 1234567890;
     
        //Caracteres Especiais
        $specialCharacters = str_shuffle('!@#$%*-');
     
        //Junta tudo
        $characters = $capitalLetters.$smallLetters.$numbers;
     
        //Embaralha e pega apenas a quantidade de caracteres informada no parâmetro
        $password = substr(str_shuffle($characters), 0, $qtyCaraceters);
        $password = \strtoupper($password);
        //Retorna a senha
        return $password;
    }          

    public function obrigado($payment_method, $email, $nome, $plano_plano, $boleto_url= null, $boleto_barcode = null, $periodo, $status
    ){

        $dados = [
            'email'          => $email,
            'nome'           => $nome,
            'plano'          => $plano_plano,
            'boleto_url'     => $boleto_url,
            'boleto_barcode' => $boleto_barcode,
            'payment_method' => $payment_method,
            'status'         => $status,
            'periodo'         => $periodo
        ];
        Mail::to($email)->send(new Obrigado($dados));        
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
}
