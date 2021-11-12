<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Webhook;

class ControllerWebhook extends Controller
{
    public function webhooks(Request $request){

            

            $retorno = $request->all();

            $retorno = $this->entrega($retorno);

            
            // DB::table('webhooks')->insert([
            //     'hooks' => json_encode($request->all())
            // ]);
            $dados = Webhook::create([
                // 'hooks' => json_encode($request->all()),
                'hooks' => $retorno
                
            ]);  

                
    }

    public function entrega(array $data){
        return $data['signature'];
    }
}
