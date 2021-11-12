<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Webhook;

class ControllerWebhook extends Controller
{
    public function webhooks(Request $request){

        
        
            // DB::table('webhooks')->insert([
            //     'hooks' => json_encode($request->all())
            // ]);
            $dados = Webhook::create([
                // 'hooks' => json_encode($request->all()),
                'hooks' => $request
                
            ]);  
                
    }
}
