<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Str;

class ControllerHome extends Controller
{
    public function home(Request $request){
        $plano      = $request["plano"];
        $periodo    = $request["periodo"];

        return view('cadastro',[
            'plano'     => $plano,
            'periodo'   => $periodo
            ]
        );
    }

    public function index(Request $request){

        $cookie = $request->cookie('lgpd');
        if(isset($cookie)){
            return view("welcome",['cookie' => 0]) ;          
        } else {

            return response(view("welcome",['cookie' => 1]))->cookie(
                'lgpd', "lgpd", 30
            );            
            
        }
        
    }
}
