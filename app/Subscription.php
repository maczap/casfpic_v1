<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Subscription extends Model
{

    protected $fillable = [
        'subscription_code', 'amount','plan_id', 'user_id','status','manage_url','payment_method','periodo','transaction_code'
    ];    

    public function user()
    {
        return $this->belongsTo(User::class);
    }
  
}
