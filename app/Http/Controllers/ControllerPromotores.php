<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Promotores;
use App\User;
use DB;
use Illuminate\Contracts\Encryption\DecryptException;
use Illuminate\Support\Facades\Crypt;


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
        ->where("cpf","<>", "26460284822")
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

            $data = [
                'promotor'   => $promotor,
                'supervisor' => $supervisor
            ];            

        } else {

            $dados = $this->promotores->getPromotor($code);
            
            
            if(isset($dados[0])){
                $promotor   = $dados[0]->promotor;
                $supervisor = $dados[0]->supervisor;
            } else {
                $promotor   = $this->_promotor;
                $supervisor = $this->_supervisor;          
            }
    
            $data = [
                'promotor'   => $promotor,
                'supervisor' => $supervisor
            ];
        }
        return $data;
    }

   
}
