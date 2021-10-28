<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Promotores;
use App\User;
use DB;
use Illuminate\Contracts\Encryption\DecryptException;
use Illuminate\Support\Facades\Crypt;
use App\Services\PagarmeRequestService;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;


class ControllerPromotores extends Controller
{
    private $_promotor = null;
    private $_supervisor = null;

    public function link_promotor(){

        $promotores = User::where('promotor_code', "<>", "")
        ->select('id','promotor_code')->get();

        foreach ($promotores as $item) {

            $id     = $item->id;
            $code   = $item->promotor_code;

            $code = $this->generatePassword();

            $url = "https://casfpic.org.br/p/".$code;

            $usuario = User::where('id', $id)->first();
            $usuario->link = $code;
            $usuario->save();            

            echo $id . "</br>";
            
        }

    }

    public function lista_link_promotor(){

        $promotores = User::where('promotor_code', "<>", "")->select('id','name','promotor_code','link')->get();
        foreach ($promotores as $item) {

            $id     = $item->id;
            $link   = $item->link;
            $name   = $item->name;

            

            $url = "https://casfpic.org.br/p/".$link;
       

            echo $name .' - '.  $url . "</br>";
            
        }

    }

    public function lista_promotores(){

        $promotores = User::where('promotor',1)
        ->select('users.*', 'users.promotor_code as pmt')
        ->addSelect(['cadastros' => User::select(DB::raw('COUNT(vinculo)'))
        ->whereColumn('vinculo', 'pmt')
        ->limit(1)  
        ])       
           
        ->orderBy("name")
        ->get();
        return $promotores;
    }

    public function get_promotor(Request $request){
        $id = $request["id"];
        

        $dados =  User::select('users.*')
        ->where("users.id",$id)
     
        ->get();
        if(!empty($dados)){
            return $dados[0]; 
        }
        return [];     
    }      

    public function generatePassword($qtyCaraceters = 25)
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
        $password = \strtolower($password);
        //Retorna a senha
        return $password;
    }  


    public function getPromotor($code=null)
    {
        $this->promotores = new Promotores();
        $promotor = null;
        $supervisor = null;
        if($code == "" || $code== null)
        {
            $promotor   = $this->_promotor;
            $supervisor = $this->_supervisor;               
            $supervisor = $this->_supervisor;      

            $data = [
                'promotor'   => $promotor,
                'supervisor' => $supervisor
            ];            

        } else {

            $dados = $this->promotores->getPromotor($code);
            
            
            if(isset($dados[0])){
                $promotor   = $dados[0]->promotor;
                $supervisor = $dados[0]->supervisor;
                $rec_id     = $dados[0]->rec_id;
            } else {
                $promotor   = $this->_promotor;
                $supervisor = $this->_supervisor;    
                $rec_id     = $dados[0]->rec_id;      
            }
    
            $data = [
                'promotor'   => $promotor,
                'supervisor' => $supervisor,
                'rec_id'     => $rec_id
            ];
        }
        return $data;
    }


    public function CreateRecipients(){

        $pagarme = new PagarmeRequestService();

        $promotores = User::where('promotor',1)
        ->whereNull("rec_id")
       
        ->get();

        
        
        foreach($promotores as $item){

            $id         = $item->id;
            $name       = $item->name;
            $email      = $item->email;
            $cpf        = $item->cpf;
            $celular    = $item->celular;
            $banco      = $item->BANCO;
            $agencia    = $item->AGENCIA;
            $agencia_dig= $item->AGENCIA_DIG;
            $conta      = $item->CONTA;
            $conta_dig  = $item->CONTA_DIG;
            $conta_tipo = $item->conta_tipo;
            $bank_account_id = $item->bank_account_id;
            $pix = $item->rec_pix;
            $rec_id = $item->rec_id;

            $celular = str_replace("(","", $celular);
            $celular = str_replace(")","", $celular);
            $celular = str_replace("-","", $celular);


            $c = explode(" ", $celular);

            if(isset($c[0])){
                
                $ddd = $c[0];
                $celular = $c[1];

                echo $name ;

                if(empty($bank_account_id)){
                $bank = $pagarme->createBanck($agencia, $agencia_dig, $banco, $conta, $conta_dig, $cpf, $name, $pix);
                } else {
                    $bank["id"]=$bank_account_id;
                }


                if(isset($bank["id"])){


                    // $recebedor = $this->recipientGet($rec_id);
                    // if(!isset($recebedor["id"])){
                    
                        $usuario = User::where('id', $id)->first();
                        $usuario->bank_account_id = $bank["id"];
                        $usuario->save();       
                        
                        $recipient = $pagarme->createRecipients(85, $bank_account_id, $cpf, $name, $email, $ddd, $celular, $id);

                        if(isset( $recipient["id"])){
                            $rec_id                  = $recipient["id"];
                            $rec_transfer_enable = $recipient["transfer_enabled"];
                            $rec_status          = $recipient["status"];

                            $user = User::where('id', $id)->first();
                            $user->rec_id               = $rec_id;
                            $user->rec_transfer_enable  = $rec_transfer_enable;
                            $user->rec_status           = $rec_status;
                            $user->save();
                            
                        }
                    // }
                    // return $recipient;

                    
                }else {
                    
                    return $bank;
                }
            }
        }
    }


    public function recipientsGet(){
        
        $pagarme = new PagarmeRequestService();

        $recipient = $pagarme->getRecipients();
        return $recipient;
    }


    public function recipientGet($id){
        
        $pagarme = new PagarmeRequestService();

        $recipient = $pagarme->getRecipient($id);
        return $recipient;
    }

    public function recipientSaldo($id){
        
        $pagarme = new PagarmeRequestService();

        $recipient = $pagarme->getRecipientSaldo($id);
        // dd($recipient);
    }

    public function recipientTransacoes($id){
        
        $pagarme = new PagarmeRequestService();

        $recipient = $pagarme->getRecipientTransacoes($id);
        // dd($recipient);
    }

    public function cadastro_promotor(Request $request){


        $rules = [
            'name'          => 'required',
            'cpf'           => 'required',
            'rg'            => 'required',  
            'sexo'          => 'required',  
            'ecivil'        => 'required',  
            'nascimento'    => 'required',  
            'profissao'     => 'required',  
            'cep'           => 'required',              
            'endereco'      => 'required',    
            'numero'        => 'required',    
            'bairro'        => 'required',    
            'cidade'        => 'required',    
            'uf'            => 'required',    
            'banco'         => 'required',    
            'agencia'       => 'required',    
            'conta'         => 'required',    
            'conta_tipo'    => 'required',    
            'pix'           => 'required',    
            'celular'       => 'required',    
            'email'         => 'required|string|email|max:40|unique:users'
        ];
        $messages = [
            'name.required'         => 'Informe o nome completo',
            'cpf.required'          => 'Informe o CPF',
            'rg.required'           => 'Informe o RG',
            'sexo.required'         => 'Informe o Sexo',
            'ecivil.required'       => 'Informe o Estado Civil',
            'nascimento.required'   => 'Informe o Nascimento',
            'profissao.required'    => 'Informe a Profissão',
            'cep.required'          => 'Informe o CEP',
            'endereco.required'     => 'Informe o Endereço',
            'numero.required'       => 'Informe o Número',
            'bairro.required'       => 'Informe o Bairro',
            'cidade.required'       => 'Informe a Cidade',
            'uf.required'           => 'Informe a UF',
            'banco.required'        => 'Informe o Banco',
            'agencia.required'      => 'Informe a Agência',
            'conta.required'        => 'Informe a Conta',
            'conta_tipo.required'   => 'Informe o Tipo da Conta',
            'pix.required'          => 'Informe o PIX',
            'email.required'        => 'Informe o e-mail',
            'email.email'           => 'E-mail inválido',
            'email.unique'           => 'Esse e-mail já está cadastrado',

        ];        

        $validator = Validator::make($request->all(),$rules, $messages);
        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()]);
        } 
        else {
    
            $link = $this->generatePassword();
            // $link = "https://casfpic.org.br/p/".$code;

            $promotor_code = $this->generatePassword(6);
            $promotor_code = strtoupper($promotor_code);

            $ns = $request['nascimento'];
            $ns = explode("/",$ns);
            $dia = $ns[0];
            $mes = $ns[1];
            $ano = $ns[2];
            $nascimento = $ano."-".$mes."-".$dia;  

            $cpf = $this->clear($request['cpf']);
            
            $dados = User::create([
                'name'      => \strtoupper($request['name']),
                'email'     => $request['email'],
                'cpf'       => $cpf,
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
                'password' => Hash::make($cpf),
                'promotor' => 1,
                'promotor_code' => $promotor_code,
                'link'          => $link,
                'banco'         => $request['banco'],
                'agencia'       => $request['agencia'],
                'agencia_dig'   => $request['agencia_dig'],
                'conta'         => $request['conta'],
                'conta_dig'     => $request['conta_dig'],
                'conta_tipo'    => $request['conta_tipo'],
                'publico'    => $request['publico']

            ]);                  
                     
                return $dados;
    
            
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
   
}
