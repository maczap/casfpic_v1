<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Plan;
use App\Services\PagarmeRequestService;
use Illuminate\Support\Facades\DB;

class ControllerPlans extends Controller
{
    private $plan;
    private $table = "plans";

    public function __construct(Plan $plan){
        $this->plan = $plan;
    }

    public function get_plan(Request $request)
    {
        $plano      = $request["plano"];
        $periodo    = $request["periodo"];
        $qtddep     = $request["qtddep"];
        

        $ambiente = null;
        if(config('services.pagarme.ambiente') == "local"){
            $ambiente = "teste";
        } else {
            $ambiente = "producao";
        }

        $plan = Plan::where('nick',$plano)
                     ->where('periodo',$periodo)
                     ->where('tipo',$ambiente)
                     ->where('qtd_dep',$qtddep)
                     ->get();
        return $plan;
    }    

    public function store($amount, $name, $codigo)
    {
       

        $amount = preg_replace('/[^0-9]/', '', $amount);
        $days=30;
        $payment_methods = 3;
        $trial_days = 0;

       

        try {
            DB::beginTransaction();

            $pagarme = new PagarmeRequestService();
            $createPagarmePlan = $pagarme->createPlan($amount, $days, $name, $payment_methods, $trial_days);
            
            if (isset($createPagarmePlan['errors'])) {

                DB::rollBack();
                return ["erro"];
            }

            if(isset($createPagarmePlan['id'])){
                $plan = new Plan;
                $plan = $plan::where('codigo', $codigo)->first(); 

                if(!empty($plan)){            
                    $plan->codigo_integracao = $createPagarmePlan['id'];
                    $plan->save();
                    echo $name . " - ".$amount." - ".$codigo." - ".$days." - ".$payment_methods." - .".$trial_days."</br>";
                }               
            }            

            DB::commit();


        } catch (Exception $e) {
            DB::rollback();
            return ["erro"];
        }
    }

    public function CreatePlan(){



        $planos = new Plan();
        $dados = $planos->get_plan();
        
        
        foreach($dados as $plano){

            $codigo = $plano->codigo;
            $amount = $plano->amount;
            $name   = $plano->descricao;

                  

            $this->store($amount, $name, $codigo);
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

    public function gerar_planos_dep(){

        $plan = Plan::where('tipo','producao')
                     ->get();

        $amount = 0;
        
        $i = 1;                     
        foreach($plan as $item){
            
            $amount = $item->amount;
            $codigo             = $item->codigo;
            $descricao          = $item->descricao;
            $periodo          = $item->periodo;
            $nick               = $item->nick;
            $percent_promotor   = $item->percent_promotor;
            $periodo            = $item->periodo;
            $tipo = "producao";

            

            for($y=2; $y <= 11; $y++){

                $dep = $y - 1;

                $codigo2 = $codigo + $dep;

                $valor = $amount * $y;

                $valor = number_format($valor,2,",",".");

                $valor = str_replace(".","", $valor);
                $valor = str_replace(",",".", $valor);
                // 123.245.678.900,00                

                echo $y. " - ".$codigo2. " - ". $descricao ." + ". $dep. " - ". $periodo. " - ". $valor ."</br>";

                Plan::create([
                    'codigo'            => $codigo2,
                    'amount'            => $valor,
                    'qtd_dep'           => $dep,
                    'descricao'         => $descricao ." + ". $dep,
                    'nick'              => $nick,
                    'percent_promotor'  => $percent_promotor,
                    'periodo'           => $periodo,
                    'tipo'              => $tipo
                   
                ]);                    
            }

            $i++;
        }

    }
}
