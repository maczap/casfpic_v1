<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Promotores;

class ControllerPromotores extends Controller
{

    private $_promotor = "PUBBD3CE3ECC27B43F6B2D2B8C64BCE27D8";
    private $_supervisor = "PUBBE2CA50F60D249DEA62CB547437BD408";

    public function getPromotor($code=null)
    {
        $this->promotores = new Promotores();

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
