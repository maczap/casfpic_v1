<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Subscription;
use App\Plan;

class ControllerSubscription extends Controller
{
    
    public function get_subscription(Request $request){

        $id = $request["id"];

        $sub = Subscription::where("user_id", $id)
        ->addSelect(['valor' => Plan::select('amount')
        ->whereColumn('id', 'plan_id')
        ->limit(1)  
    ])   
        ->get();

        return $sub;
        
    }
}
