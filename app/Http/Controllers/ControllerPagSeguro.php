<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ControllerPagSeguro extends Controller
{
    private $pagseguro;
    private $post;

    public function __construct(Pagseguro $pagseguro, PostbackController $post){
        $this->pagseguro = $pagseguro;
        $this->post = $post;
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
            return response()->json(['error' => $validator->errors()]);
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
                    10.00,
                    "PUB2DDF1F0179F8449BADF6BD57F186B34F"
                    
                );                

            $payment = new Payment(102, $sender, $shipping, $item, $split);
            $payment->setCreditCard($creditCard);

            $response = $this->pagseguro->sendTransaction($payment);

            

            if(isset($response["code"])){

                
               $this->post->createTransaction($response);
                return $response["code"];
            }
              
            


            return [];
            
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
                        'subscription_code' => null,
                        'plan_id'           => $plano_id ,
                        'user_id'           => $user->id,
                        'status'            => "Analisando",
                        'periodo'            => $periodo,
                        'manage_url'        => null,
                        'payment_method'    => "credit_card"
                    ]);    

                    if(isset($dados_sb['id'])){

                        $ddd        = $this->clear(substr($request['celular'], 1, 2));
                        $celular    = $this->clear(substr($request['celular'], 4, 11));    
                        
                        $cpf = new Document(Document::CPF, $this->clear($request['cpf']));

                        
                        
                        // $DadosArray["email"]            = $this->pagseguro->_email;
                        // $DadosArray["token"]            = $this->pagseguro->_token;
                        
                        // $DadosArray['reference']        = $dados_sb['id'];
                        // $DadosArray['currency']         = "BRL";
                        // $DadosArray['notificationURL']  = "https://casfpic.org.br/api/postback";
                        // //item
                        // $DadosArray['itemId1']          = $plano_codigo;
                        // $DadosArray['itemDescription1'] = $plano_name;
                        // $DadosArray['itemAmount1']      = number_format($plano_amount, 2 ,".", "" );
                        // $DadosArray['itemQuantity1']    = 1;     
                        // //comprador
                        // $DadosArray['senderName']       = \strtoupper($request['name']);
                        // $DadosArray['senderCPF']        = $this->clear($request['cpf']);
                        // $DadosArray['senderAreaCode']   = $ddd;
                        // $DadosArray['senderPhone']      = $celular;
                        // //'c46290945644411234770@sandbox.pagseguro.com.br'
                        // // $DadosArray['senderEmail']      = $request['email'];
                        // $DadosArray['senderEmail']      = "c46290945644411234770@sandbox.pagseguro.com.br";
                        // // $DadosArray['senderEmail']      = "c46290945644411234770@sandbox.pagseguro.com.br";
                        // $DadosArray['senderHash']       = $request['hashseller'];
                        
                        // $DadosArray['shippingAddressRequired'] = false;
                        // //endereco
                        // $DadosArray['billingAddressStreet']         = \strtoupper($request['endereco']);
                        // $DadosArray['billingAddressNumber']         = $request['numero'];
                        // $DadosArray['billingAddressComplement']     = \strtoupper($request['complemento']);
                        // $DadosArray['billingAddressDistrict']       = \strtoupper($request['bairro']);
                        // $DadosArray['billingAddressPostalCode']     = $this->clear(\strtoupper($request['cep']));
                        // $DadosArray['billingAddressCity']           = $this->remover_acentos(\strtoupper($request['cidade']));
                        // $DadosArray['billingAddressState']          = \strtoupper($request['uf']);
                        // $DadosArray['billingAddressCountry']        = "BRASIL";   
                        
                        // $DadosArray['creditCardToken']               = $request["cardToken"];
                        // $DadosArray['installmentQuantity']           = $request["nparcela"];
                        // $DadosArray['installmentValue']              = number_format($request["totalparcela"], 2 ,".", "" );
                        
                        // //cartao
                        //     $ddd_cartao = $this->clear(substr($request['cartao_celular'], 1, 2));
                        //     $celular_cartao = $this->clear(substr($request['cartao_celular'], 4, 11));                            
                        // $DadosArray['creditCardHolderName']          = \strtoupper($request['cartao_nome']);
                        // $DadosArray['creditCardHolderCPF']           = $this->clear($request['cartao_cpf']);
                        // $DadosArray['creditCardHolderBirthDate']     = $request["cartao_nasc"];
                        // $DadosArray['creditCardHolderAreaCode']      = $ddd_cartao;
                        // $DadosArray['creditCardHolderPhone']         = $celular_cartao;   

                        // $buildQuery = http_build_query($DadosArray);

                        // $url = $this->pagseguro->_url."/transactions";

                        // $curl = curl_init($url);
                        // curl_setopt($curl, CURLOPT_HTTPHEADER, Array("Content-Type: application/x-www-form-urlencoded; charset=UTF-8"));
                        // curl_setopt($curl, CURLOPT_POST, true);
                        // curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, true);
                        // curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
                        // curl_setopt($curl, CURLOPT_POSTFIELDS, $buildQuery);
                        // $retorno = curl_exec($curl);
                        // curl_close($curl);
                         
                        // $xml = simplexml_load_string($retorno);     
                        // $json =json_decode(json_encode($xml), true);     
                        
                        // if(isset($json['code'])){
    
                        //     $this->post->transaction_code($json['code']);
    
                        // }                                       
                    }                    
                }
                
                

                DB::commit();
                return $cpf;
            } catch (Exception $e){
                \DB::rollback();
                return $e;
            }   
        }        
        return $request;
    }


    public function boleto(Request $request, PostbackController $post){
        $payment_methods = $request["payment_method"];

       
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
                return response()->json(['error' => $validator->errors()]);
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
                            'subscription_code' => null,
                            'plan_id'           => $plano_id ,
                            'user_id'           => $user->id,
                            'status'            => "Analisando",
                            'periodo'            => $periodo,
                            'manage_url'        => null,
                            'payment_method'    => "credit_card"
                        ]);    



                        $ddd        = $this->clear(substr($request['celular'], 1, 2));
                        $celular    = $this->clear(substr($request['celular'], 4, 11));    

                        $data["appId"]          = $this->pagseguro->_appID;
                        $data["appKey"]         = $this->pagseguro->_appKey;

                        $data['notificationURL']  = "https://casfpic.org.br/api/postback";
                        $data["paymentMode"]    = 'default';
                        $data['hash']           = $request['hashseller'];
                        $data['paymentMethod']  = 'boleto';
                        $data['receiverEmail']  = 'financeiro@servclube.com.br';
                        $data['senderName']     = \strtoupper($request['name']);
                        $data['senderCPF']      = $this->clear($request['cpf']);
                        $data['senderAreaCode']   = $ddd;
                        $data['senderPhone']      = $celular;
                        // $data['senderEmail']    = $request['email'];
                        $data['senderEmail']      = 'c46290945644411234770@sandbox.pagseguro.com.br';
                        $data['senderCPF']        = $this->clear($request['cpf']);
                        $data['currency']         = 'BRL';
                        $data['itemId1']          = $plano_codigo;
                        $data['itemDescription1'] = $plano_name;
                        $data['itemAmount1']      = number_format($plano_amount, 2 ,".", "" );
                        $data['itemQuantity1']    = 1;     
                        $data['reference']        = $dados_sb['id'];

                        $data['primaryReceiverPublicKey'] = 'PUB2DDF1F0179F8449BADF6BD57F186B34F';    
                        $data['receiverPublicKey1'] = '220D5468999990511487AF8B40C9986B';
                        $data['receiverSplit1'] = 10.00;

                        $data['shippingAddressRequired'] = 'false';  

                        $xml ="<payment>";

                        $xml .="<payment>";

                        
                        
                        $buildQuery = http_build_query($data);

                        $url = $this->pagseguro->_url."/transactions";

                        $curl = curl_init($url);
                        curl_setopt($curl, CURLOPT_HTTPHEADER, Array(
                            "Content-Type: application/x-www-form-urlencoded; charset=UTF-8"
                        ));
                        curl_setopt($curl, CURLOPT_POST, true);
                        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, true);
                        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
                        curl_setopt($curl, CURLOPT_POSTFIELDS, $buildQuery);
                        $retorno = curl_exec($curl);
                        curl_close($curl);
                         
                        return $retorno;
                        $xml = simplexml_load_string($retorno);     
                        $retorno =json_decode(json_encode($xml), true); 

                        
                        $subscription = Subscription::where('id', $retorno['reference'])->first();
                
                        if(!empty($subscription)){            
                            // $plan_id = $subscription->plan_id;
                            
                                $subscription->status           = $this->post->tabela_status($retorno['status']);
                                $subscription->transaction_code = $retorno['code'];
                                $subscription->amount           = $retorno['grossAmount'];
                                $subscription->updated_at       = $retorno['date'];
                                $subscription->manage_url       = $retorno['paymentLink'];
                                $subscription->payment_method   = "boleto";
                                $subscription->save();
                            
                        }                               


                    }
                        DB::commit();
                        return $retorno;
                } catch (Exception $e){
                        \DB::rollback();
                        return [];
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
}
