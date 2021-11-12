<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Webhook;

class ControllerWebhook extends Controller
{
    public function webhooks(Request $request){

            

            $retorno1 = json_encode($request->all());

            // $retorno1 = '{
            //     "signature":{
            //        "token":"779747d9a7ca25d6d04e8793bad9db3f186671927436f56c5f",
            //        "timestamp":"1636725616",
            //        "signature":"4532f8d692d52f6ae27b7adee594211a38a632edfc81c43225b35e94fc7fa555"
            //     },
            //     "event-data":{
            //        "id":"Ase7i2zsRYeDXztHGENqRA",
            //        "timestamp":1521243339.873676,
            //        "log-level":"info",
            //        "event":"unsubscribed",
            //        "message":{
            //           "headers":{
            //              "message-id":"20130503182626.18666.16540@comunicacao.casfpic.org.br"
            //           }
            //        },
            //        "recipient":"alice@example.com",
            //        "recipient-domain":"example.com",
            //        "ip":"50.56.129.169",
            //        "geolocation":{
            //           "country":"US",
            //           "region":"CA",
            //           "city":"San Francisco"
            //        },
            //        "client-info":{
            //           "client-os":"Linux",
            //           "device-type":"desktop",
            //           "client-name":"Chrome",
            //           "client-type":"browser",
            //           "user-agent":"Mozilla\/5.0 (X11; Linux x86_64) AppleWebKit\/537.31 (KHTML, like Gecko) Chrome\/26.0.1410.43 Safari\/537.31"
            //        },
            //        "campaigns":[
                      
            //        ],
            //        "tags":[
            //           "my_tag_1",
            //           "my_tag_2"
            //        ],
            //        "user-variables":{
            //           "my_var_1":"Mailgun Variable #1",
            //           "my-var-2":"awesome"
            //        }
            //     }
            //  }';

             $retorno = json_decode($retorno1, true);

             

             $recipient = $retorno["event-data"]["recipient"];
             $data = $retorno["event-data"]["timestamp"];
             $event = $retorno["event-data"]["event"];
             $domain = $retorno["event-data"]["recipient-domain"];
             $tag = $retorno["event-data"]["tags"][0];
             $id = $retorno["event-data"]["id"];


             $data = date('Y-m-d H:i:s', $data);
             

            $dados = Webhook::create([
                'hooks' => $retorno1,
                'email' => $recipient,
                'id_webhook' => $id,
                'event' => $event,
                'domain' => $domain,
                'tag' => $tag,
                'date_event' => $data
                
            ]);  

                
    }

    public function entrega(array $data){
        return $data['signature'];
    }
}
