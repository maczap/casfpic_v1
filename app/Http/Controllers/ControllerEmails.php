<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Mail\Pagamento;
use App\Mail\ComissaoEntrada;
use Illuminate\Support\Facades\Mail;

class ControllerEmails extends Controller
{

    public function SendEmail(){

        $dados = [
            'nome'   => "MARCOS",
        ];
        $email = "kinho2000@gmail.com";
        Mail::to($email)->send(new ComissaoEntrada($dados));    
    }      
}
