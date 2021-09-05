<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\User;
use Illuminate\Contracts\Encryption\DecryptException;
use Illuminate\Support\Facades\Crypt;

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

            

            $cookie_promotor = \Request::cookie('pmtcsfpc');

            if(isset($request["token"])){
                $id = Crypt::decryptString($request["token"]);
                
                $cookie_promotor = $id;
            }            

            $promotor_code = "FD1809";
            $promotor_name = "Marcos Granziera";
            $time = 87660;

            $promotor = User::where('promotor_code', $cookie_promotor)->select('name','promotor_code')->first();
            
            if(isset($promotor->promotor_code)){
                $promotor_code = $promotor->promotor_code;
                $promotor_name = $promotor->name;
            } else {
                $promotor_code = "FD1809";
                $promotor_name = "Marcos Granziera";
            }

            $cookie = $request->cookie('lgpd');
            if(isset($cookie)){

                return response(view("welcome",['cookie' => 0, "promotor_name" => $promotor_name]))->cookie(
                    'pmtcsfpc', $promotor_code, $time
                );           

            } else {

                return response(view("welcome",['cookie' => 1, "promotor_name" => $promotor_name]))->cookie(
                    'lgpd', "lgpd", 30
                ) 
                ->cookie(
                    'pmtcsfpc', $promotor_code, $time
                );                       
                
            }
        
    }


}
