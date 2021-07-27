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
}
