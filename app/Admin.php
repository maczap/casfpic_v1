<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Admin extends Model
{
    public function baixa($id, $payment){

        $status2 = "";
        if($payment == "paid"){
            $status2 = "Transação Paga";
        }

        if($payment == "unpaid"){
            $status2 = "Aguardando Pagamento";
        }        

        DB::table('subscriptions')
        ->where('id', $id)
        ->update(['status' => $payment, 'status_detail' => $status2]);

    }
}
