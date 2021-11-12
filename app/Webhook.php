<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Webhook extends Model
{
    protected $table = "webhooks";

    protected $fillable = [
        'hooks',
        'id',
        'recipient',
        'email',
        'od_webhook',
        'event',
        'domain',
        'tag'

    ];        
}
