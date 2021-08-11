<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use App\User;
use App\Plan;
use App\Dom\Document;
use App\Dom\Phone;
use App\Dom\billingAddress;
use App\Dom\shippingAddress;

use App\Dom\Address;
use App\Dom\Sender;
use App\Dom\Holder;
use App\Dom\Shipping;
use App\Dom\Installment;
use App\Dom\Item;
use App\Dom\Payment;
use App\Dom\Split;
use App\CreditCard;
use App\Subscription;
use App\Services\Pagseguro;
use DB;
Use \Carbon\Carbon;

use DOMDocument;
use Exception;
use DOMElement;

class ControllerCadastro extends Controller
{

    private $pagseguro;
    private $post;
    private $promotores;

    public function __construct(Pagseguro $pagseguro, PostbackController $post, ControllerPromotores $promotores){

        $this->pagseguro  = $pagseguro;
        $this->post       = $post;
        $this->promotores = $promotores;
    }

    public function success(){
        return view('layouts.success');
    }

    public function getSession(){

        $xml = $this->pagseguro->getSession();

        $xml = simplexml_load_string($xml); 

        if(!empty($xml)){
            $json =json_decode(json_encode($xml), true);
            // $json = json_decode($json);  
            $id = $json["id"];

            return $id;
            
        } else {
            return null;
        }        
        
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
        


        
       
        if($payment_methods == "credit_card")
        {
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
        }      

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
            
            //xml
                $cpf   = new Document("CPF", $this->clear($request['cpf']));

                $phone = new Phone($ddd, $celular);

                $address = new Address(
                    \strtoupper($request['endereco']),
                    $request['numero'],
                    \strtoupper($request['complemento']),
                    \strtoupper($request['bairro']),
                    $this->clear(\strtoupper($request['cep'])),
                    $this->remover_acentos(\strtoupper($request['cidade'])),
                    \strtoupper($request['uf']),
                    'BRASIL'

                );
                
                $email = "financeiro@servclube.com.br";

                $sender = new Sender(
                    \strtoupper($request['name']),
                    $cpf,
                    $nascimento,
                    $phone,
                    $email,
                    $request['hashseller']
                );

                $ddd_cartao = $this->clear(substr($request['cartao_celular'], 1, 2));
                $celular_cartao = $this->clear(substr($request['cartao_celular'], 4, 11));   

                $phone = new Phone($ddd_cartao, $celular_cartao);
                $cpf   = new Document("CPF", $this->clear($request['cpf']));

                $holder = new Holder(
                    \strtoupper($request['cartao_nome']),
                    $cpf,
                    $request["cartao_nasc"],
                    $phone
                );

                $shipping = new Shipping();

                $installment = new Installment( $request["nparcela"], number_format($request["totalparcela"], 2 ,".", "" ));

                $billingAddress = new billingAddress(
                    \strtoupper($request['endereco']),
                    $request['numero'],
                    \strtoupper($request['complemento']),
                    \strtoupper($request['bairro']),
                    $this->clear(\strtoupper($request['cep'])),
                    $this->remover_acentos(\strtoupper($request['cidade'])),
                    \strtoupper($request['uf']),
                    'BRASIL'

                );
                
                $creditCard = new CreditCard(
                    (string) $request["cardToken"],
                    $installment,
                    $holder,
                    $billingAddress
                );

                $item = new Item(
                    $plano_codigo,
                    $plano_name,
                    number_format($plano_amount, 2 ,".", "" ),
                    1
                );

                $split = new Split(
                    $promotor,
                    number_format($plano_amount, 2 ,".", "" ),
                    "creditCard"

                    
                );      
                
                


                // return $response["code"];
            
            
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


                        $payment = new Payment($dados["id"], $sender, $shipping, $item, $split);
                        $payment->setCreditCard($creditCard);
            
                        $response = $this->pagseguro->sendTransaction($payment);
                        
                            
                        if(isset($response["code"])){
            
                            $this->post->createTransaction($response);

                            $user = new User;
                            $user = $user::find($dados["id"]);  
                            
                            $dados_sb = $user->subscriptions()->create([
                                'transaction_code' => $response["code"],
                                'plan_id'           => $plano_id ,
                                'user_id'           => $user->id,
                                'status'            => $response["status"],
                                'vencimento'        => $vencimento,
                                'periodo'           => $periodo,
                                'manage_url'        => null,
                                'payment_method'    => "credit_card"
                            ]);    

                            $ddd        = $this->clear(substr($request['celular'], 1, 2));
                            $celular    = $this->clear(substr($request['celular'], 4, 11));    
                            
                            $cpf = new Document(Document::CPF, $this->clear($request['cpf']));

                                                            
                        }                    
                    }
                    
                    

                    DB::commit();
                    if(isset($response["code"])){
                        return $response["code"];
                    } else {
                        return [];
                    }
                } catch (Exception $e){
                    \DB::rollback();
                    return $e;
                }  

               
            


        }        
        
    }


    public function boleto(Request $request, PostbackController $post){
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

       
        if($payment_methods == "boleto")
        {
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
               
                    $dados_plano = $this->get_plan($plano, $periodo);
                        
                    $plano_codigo   = $dados_plano->codigo;
                    $plano_id       = $dados_plano->id;
                    $plano_name     = $dados_plano->descricao;
                    $plano_nick     = $dados_plano->nick; 
                    $plano_amount   = $dados_plano->amount; 

                    
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

                        $ddd        = $this->clear(substr($request['celular'], 1, 2));
                        $celular    = $this->clear(substr($request['celular'], 4, 11));    

                        $cpf   = new Document("CPF", $this->clear($request['cpf']));

                        $phone = new Phone($ddd, $celular);
        
                        $address = new Address(
                            \strtoupper($request['endereco']),
                            $request['numero'],
                            \strtoupper($request['complemento']),
                            \strtoupper($request['bairro']),
                            $this->clear(\strtoupper($request['cep'])),
                            $this->remover_acentos(\strtoupper($request['cidade'])),
                            \strtoupper($request['uf']),
                            'BRASIL'
        
                        );

                        $email = "financeiro@servclube.com.br";
        
                        $sender = new Sender(
                            \strtoupper($request['name']),
                            $cpf,
                            $nascimento,
                            $phone,
                            $email,
                            $request['hashseller']
                        );
                                
                        $shipping = new Shipping();
      
                        $item = new Item(
                            $plano_codigo,
                            $plano_name,
                            number_format($plano_amount, 2 ,".", "" ),
                            1
                        );

                        $split = new Split(
                            $promotor,
                            number_format($plano_amount, 2 ,".", "" ),
                            $method="boleto"
                            
                        );    
                          
                        $payment = new Payment($dados_sb["id"], $sender, $shipping, $item, $split);
                        $payment->setBoleto();

                        $retorno = $this->pagseguro->sendTransaction($payment);
                        
                        if(isset($retorno["code"])){
                            $subscription = Subscription::where('id', $retorno['reference'])->first();
                            if(!empty($subscription)){            
                                    $subscription->status           = $this->post->tabela_status($retorno['status']);
                                    $subscription->transaction_code = $retorno['code'];
                                    $subscription->amount           = $retorno['grossAmount'];
                                    $subscription->updated_at       = $retorno['date'];
                                    $subscription->manage_url       = $retorno['paymentLink'];
                                    $subscription->payment_method   = "boleto";
                                    $subscription->save();
                                
                            }    
                        }                           


                    }
                        DB::commit();
                        return $retorno;
                } catch (Exception $e){
                        \DB::rollback();
                        return $e;
                }
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
}
