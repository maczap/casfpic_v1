<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Str;

class ControllerPromotores extends Controller
{





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
