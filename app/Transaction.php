<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    protected $fillable = [
        'user_id',
        'date',
        'code',
        'reference',
        'type',
        'status',
        'lastEventDate',
        'paymentMethodType',
        'grossAmount',
        'lastEventDate',
        'discountAmount',
        'lastEventDate',
        'creditorFeesInstallmentFeeAmount',
        'creditorFeesIntermediationRateAmount',
        'creditorFeesIntermediationFeeAmount',
        'netAmount',
        'extraAmount',
        'installmentCount',
        'itemCount',
        'itemId',
        'itemDescription',
        'itemQuantity',
        'itemAmount',
        'paid_amount',
        'refunded_amount',
        'installments',
        'cost',
        'subscription_code',
        'postback_url',
        'card_holder_name',
        'card_last_digits',
        'card_first_digits',
        'card_last_digits',
        'card_brand',
        'payment_method',
        'boleto_url',
        'boleto_barcode',
        'boleto_expiration_date'

    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function getAmountAttribute($value)
    {
        return $value/100;
    }

    public function getAmountFormatedAttribute()
    {
        return number_format($this->amount, 2, ',', '.');
    }    

    
}
