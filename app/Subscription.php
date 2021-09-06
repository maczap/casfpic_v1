<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Subscription extends Model
{

    protected $fillable = [
        'subscription_code',
        'plan_id',
        'user_id',
        'status',
        'status_detail',
        'periodo',
        'amount',
        'boleto_url',
        'boleto_barcode',
        'payment_method',
        'plano',
        'pix_qr_code',
        'pix_expiration_date',
        'boleto_expiration_date',
        'manage_url',
        'manage_token'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function plan()
    {
        return $this->belongsTo(Plan::class);
    }
}
