<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Webhooks;

class ControllerWebhook extends Controller
{
    public function webhooks(Request $request){

        
        
            // DB::table('webhooks')->insert([
            //     'hooks' => json_encode($request->all())
            // ]);
            $dados = Webhooks::create([
                'hooks' => json_encode($request->all())
            ]);  
                
    }
}
