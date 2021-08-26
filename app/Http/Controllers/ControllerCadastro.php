<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use App\User;
use App\Plan;
use App\Services\MercadoPago as Mp;
use App\Mail\Obrigado;
use App\Subscription;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\DB;
Use \Carbon\Carbon;
use MercadoPago;
use Exception;

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
        $payment_methods = $request["payment_method"];

        $promotor_id = null;
        $cookie = \Request::cookie('prmntcfpc');
        if(isset($cookie)){
            
            $promotor = $this->promotores->getPromotor($cookie);
            // if(isset($promotor->promotor_id)){
            //     $promotor_id = $promotor->promotor_id;
            // } 
        }  else {
            $promotor = $this->promotores->getPromotor(78979);
        }      
       
 
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

                // 'cartao_validade' => 'required', 
                // 'cartao_cvv'      => 'required', 
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
                'periodo.required'          => 'Informe o Período'
                
            ];              
        

        $validator = Validator::make($request->all(),$rules, $messages);
        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()]);
        } 
        else {

            
            $vencimento = $this->vencimento($request['periodo']);

            
                
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

            $ddd        = $this->clear(substr($request['celular'], 1, 2));
            $celular    = $this->clear(substr($request['celular'], 4, 11));    

            $dados_plano = $this->get_plan($plano, $periodo);

            $plano_codigo   = $dados_plano->codigo;
            $plano_id       = $dados_plano->id;
            $plano_name     = $dados_plano->descricao;
            $plano_nick     = $dados_plano->nick; 
            $plano_amount   = $dados_plano->amount;   
        
            $ddd        = $this->clear(substr($request['celular'], 1, 2));
            $celular    = $this->clear(substr($request['celular'], 4, 11));   
            DB::beginTransaction();
            try{
                

                    $dados = User::create([
                        'name'      => \strtoupper($request['name']),
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
                        'password' => Hash::make($senha)
                    ]);
                    

                    if(isset($dados["id"])){

                        $user = new User;
                        $user = $user::find($dados["id"]);  
                        
                        $dados_sb = $user->subscriptions()->create([
                            'transaction_code'  => null,
                            'plan_id'           => $plano_id ,
                            'user_id'           => $user->id,
                            'status'            => "Analisando",
                            'vencimento'        => $vencimento,
                            'periodo'           => $periodo,
                            'manage_url'        => null,
                            'payment_method'    => "credit_card"
                        ]);   
                    }        
//1240004735
                    if($dados_sb["id"]){

                        $date_from =  (new \DateTime())->format('Y-m-d\TH:i:s');
                        $date_to = date("Y-m-d\TH:i:s", strtotime($date_from.'+ 27 days'));   

                        $external_reference = $dados_sb["id"]; 
                        if($periodo == "anual"){                        

                            MercadoPago\SDK::setAccessToken(config('services.mercadopago.access_token')); 
                            
                            $nm = \explode(" ", $request['name']);
                            $nome = $nm[0];
                            $surname = $nm[1];
                            $cep = \str_replace("-","", $request['cep']);

                            $preference = new MercadoPago\Preference();  
                            
                                $payer = new MercadoPago\Payer();
                                $payer->name = $nome;
                                $payer->surname = $surname;
                                $payer->email = $request['email'];
                                $payer->phone = array(
                                "area_code" => $ddd,
                                "number" => $celular
                                );
                                
                                $payer->identification = array(
                                "type"   => "CPF",
                                "number" => $cpf
                                );
                                
                                $payer->address = array(
                                "street_name" => $request['endereco'],
                                "street_number" => $request['numero'],
                                "zip_code" => $cep
                                );                            

                                $item = new MercadoPago\Item();  
                                $item->id          = $plano_codigo;
                                $item->title       = $plano_name;  
                                $item->description = $plano_name;  
                                $item->category_id = $plano_codigo;
                                $item->quantity = 1;  
                                $item->currency_id = "BRL";
                                $item->unit_price = (double) $plano_amount; 

                            $preference->items = array($item);  
                            $preference->payer = $payer;
        
                            $preference->back_urls = array(  
                                "success" => "https://casfpic.org.br/api/checkout/success",  
                                "failure" => "https://casfpic.org.br/api/checkout/failure",  
                                "pending" => "https://casfpic.org.br/api/checkout/pending"  
                            );  
                            $preference->external_reference= $dados_sb["id"];  
                            $preference->notification_url = "https://casfpic.org.br/api/postback";
                            $preference->auto_return = "approved";
                            $preference->payment_methods = array(
                                "installments" => 12
                            );                         
                            $preference->statement_descriptor = "Caixa Assistencial - CASFPIC"; 
                            
                            $preference->expires = true;  
                            $preference->expiration_date_from = $date_from;  
                            $preference->expiration_date_to = $date_to;  

                            $preference->save();  
       
                            if(isset($preference->init_point))
                            {
                                $url = $preference->init_point;
                                
                                $subscription = Subscription::where('id', $dados_sb["id"])->first();
                                if(!empty($subscription)){            
                                        $subscription->transaction_code = $preference->id;
                                        $subscription->status           = "Aguardando";
                                        $subscription->amount           = $plano_amount;
                                        $subscription->manage_url       = $preference->init_point;
                                        $subscription->save();
                                    
                                }                             
                            }
                        }  else {
        
                            $email = $request['email'];

                            $curl = curl_init();
                            $token = config('services.mercadopago.access_token');
                            // $token = "TEST-ac6115de-e7b8-4b7e-8171-64183a0fd87e";

                            $url = "https://api.mercadopago.com/preapproval";
                    
                            curl_setopt($curl, CURLOPT_URL,$url);
                            curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1 );
                            curl_setopt($curl, CURLOPT_POST,           1 );
                            curl_setopt($curl, CURLOPT_HTTPHEADER, array(
                                'Authorization: Bearer ' . $token,
                                'Content-type: application/json',
                              ));        
                            curl_setopt($curl, CURLOPT_POSTFIELDS,     '{
                                "auto_recurring": {
                                  "currency_id": "BRL",
                                  "transaction_amount": "'.(double) $plano_amount.'",
                                  "frequency": 1,
                                  "frequency_type": "months"
                                },
                                "back_url": "https://casfpic.org.br/api/postback",
                                "collector_id": 655553401,
                                "external_reference": "'.$external_reference.'",
                                "payer_email": "'.$email.'",
                                "reason": "'.$plano_name.'"
                                
                              }'
                            );   
                            //"collector_id": 655553401, producao
                            //"collector_id": 812506480, teste
                            // "payer_email": "test_user_91922613@testuser.com",
                            $response = curl_exec($curl);
                            curl_close($curl);
                            $response = json_decode($response, true);
                           
                            
                            if(isset($response["init_point"]))
                            {
                                $url = $response["init_point"];
                                $subscription = Subscription::where('id', $dados_sb["id"])->first();
                                if(!empty($subscription)){            
                                        $subscription->transaction_code = $response['id'];
                                        $subscription->status           = $response['status'];
                                        $subscription->amount           = $plano_amount;
                                        $subscription->manage_url       = $response['init_point'];
                                        $subscription->save();
                                    
                                }                             
                            }                            

                            
                        }
                        
                    }
                    DB::commit();            
                    
                    if(isset($url)){
                        return $url;
                    }
                    return [];
                
            } catch (Exception $e){
                \DB::rollback();
                return $e;
            }  

               
            


        }        
        
    }


    public function get_plan($plano, $periodo)
    {
        $dados = Plan::where('nick',$plano)
                     ->where('periodo',$periodo)
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
}
