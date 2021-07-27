<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Plan extends Model
{
    protected $table = "plans";

    protected $fillable = [
        'id', 'nome', 'codigo','valor','periodo','nick'
    ];    
}
