<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Plan;

class ControllerPlans extends Controller
{
    private $plan;
    private $table = "plans";

    public function __construct(Plan $plan){
        $this->plan = $plan;
    }

    public function get_plan(Request $request)
    {
        $plano = $request["plano"];
        $periodo = $request["periodo"];

        $plan = Plan::where('nick',$plano)
                     ->where('periodo',$periodo)
                     ->get();
        return $plan;
    }    

    public function CreatePlan(){



        $planos = new Plan();
        $dados = $planos->get_plan();
        try {

        foreach($dados as $plano){

            $codigo = $plano->codigo;
            $amount = $plano->amount;
            $name   = $plano->descricao;

            // $amount = \number_format( $amount, 2, ".","");
            
            $curl = curl_init();
            $token = config('services.mercadopago.access_token');
            $url = "https://api.mercadopago.com/preapproval_plan";
    
            curl_setopt($curl, CURLOPT_URL,$url);
            curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1 );
            curl_setopt($curl, CURLOPT_POST,           1 );
            curl_setopt($curl, CURLOPT_HTTPHEADER, array(
                'Authorization: Bearer ' . $token,
                'Content-type: application/json',
              ));        
            curl_setopt($curl, CURLOPT_POSTFIELDS,     
                '{
                    "back_url":"https://casfpic.org.br/api/assinatura",
                    "reason":"'.$name.'",
                    "auto_recurring":{
                        "frequency":"1",
                        "frequency_type":"months",
                        "transaction_amount":"'.$amount.'",
                        "currency_id":"BRL",
                        "repetitions":""
                    }
                }'
            ); 
                  
                      
              $response = curl_exec($curl);
              echo $response;
              curl_close($curl);
              $response = json_decode($response, true);
              
            if(isset($response["id"])){
                $plan = new Plan;
                $plan = $plan::where('codigo', $codigo)->first(); 

                if(!empty($plan)){            
                    $plan->codigo_integracao = $response["id"];
                    $plan->save();
                }               
            }
            
        }
                
            //code...
        } catch (\Throwable $th) {
           return $th;
        }
        
        
          
    }


    public function CriarAssinatura(){

        
        $curl = curl_init();
        $token = config('services.mercadopago.access_token');
        $url = "https://api.mercadopago.com/preapproval";

        curl_setopt($curl, CURLOPT_URL,$url);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1 );
        curl_setopt($curl, CURLOPT_POST,           1 );
        curl_setopt($curl, CURLOPT_HTTPHEADER, array(
            'Authorization: Bearer ' . $token,
            'Content-type: application/json',
          ));        
        curl_setopt($curl, CURLOPT_POSTFIELDS,     '{
            "auto_recurring": {
              "currency_id": "BRL",
              "transaction_amount": 1100,
              "frequency": 1,
              "frequency_type": "months",
              "end_date": "2022-07-20T11:59:52.581-04:00"
            },
            "back_url": "https://casfpic.org.br",
            "collector_id": 100200300,
            "external_reference": "1245AT234562",
            "payer_email": "test_user_XXXX@testuser.com",
            "reason": "Suscripción Pase Mensual Gold - Particular",
            "status": "pending"
          }'
        ); 
              
                  
          $response = curl_exec($curl);
          curl_close($curl);
          echo $response;   
    }    
}
