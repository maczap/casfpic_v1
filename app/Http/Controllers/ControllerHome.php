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
            
            $time = 43800;

            $promotor_code = \Request::cookie('pmtcsfpc');

            
            
            $promotor_name = "";

            if(!isset($request["token"])){ //se nao existir

                if(empty($promotor_code)){

                        $promotor_code = "FD1809";
                        $promotor_name = "Marcos Granziera";
                } else {

                    $promotor = User::where('promotor_code', $promotor_code)->select('name','promotor_code')->first();
                    $promotor_code = $promotor->promotor_code;
                    $promotor_name = $promotor->name;                            

                }

            } else {

                $token = $request["token"];

                $promotor = User::where('link', $token)->select('name','promotor_code')->first();
                $promotor_code = $promotor->promotor_code;
                $promotor_name = $promotor->name;                      

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
