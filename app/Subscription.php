<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Subscription extends Model
{

    protected $fillable = [
        'amount','plan_id','status_detail','status_msg', 'vencimento','payment_id', 'user_id','status','manage_url','payment_method','periodo','transaction_code'
    ];    

    public function user()
    {
        return $this->belongsTo(User::class);
    }
  
}
