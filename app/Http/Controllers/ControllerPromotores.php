<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Promotores;


class ControllerPromotores extends Controller
{
    private $_promotor = null;
    private $_supervisor = null;

    public function link_promotor(Request $request){
        $code = $request["code"];

        
        $user = new Promotores();

        $teste = $user->testaPromotor($code);

        if(count($teste) > 0){
            
            if(isset($code))
            {
                // $response = new \Illuminate\Http\Response('Hello World');
                // $response->withCookie(cookie('promotor_servclube', $code, 87660));
                return response(view("welcome"))->cookie(
                    'promotor_casfpic', $code, 87660
                );

            } else {
                $code = "ATYEAU";
                
                // return view($plano);
                return response(view("welcome"))->cookie(
                    'promotor_casfpic', $code, 87660
                );
            }
        } else {
            abort(404);
        }
        
        
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



    function generatePassword($qtyCaraceters = 6)
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
