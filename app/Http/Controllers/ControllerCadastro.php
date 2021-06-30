<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use App\User;

class ControllerCadastro extends Controller
{
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
                    'password' => Hash::make($senha)
                ]);

            } catch (Throwable $e){
                return false;
            }   
        }        
        return $request;
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
