<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
class ControllerDash extends Controller
{
    public function dash_cadastros(){

        $dados =  User::join('subscriptions', 'users.id', '=', 'subscriptions.user_id')
        ->select('users.name',  
        'users.cpf', 
        'subscriptions.plano', 
        'subscriptions.status',
        'subscriptions.manage_url',
        'subscriptions.boleto_url',
        'subscriptions.boleto_barcode',
        'subscriptions.boleto_expiration_date',
        'subscriptions.pix_qr_code',
        'subscriptions.pix_expiration_date')
        ->orderBy('subscriptions.id', 'desc')
        ->limit(10)
        ->get();   
        return $dados;     
    }
}
