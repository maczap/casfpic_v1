<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Subscription;

class ControllerSubscription extends Controller
{
    
    public function get_subscription(Request $request){

        $id = $request["id"];

        $sub = Subscription::where("user_id", $id)
        ->get();

        return $sub;
        
    }
}
