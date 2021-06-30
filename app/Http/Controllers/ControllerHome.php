<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

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
}
