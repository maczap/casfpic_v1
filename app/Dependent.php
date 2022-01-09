<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Dependent extends Model
{
    protected $table = 'dependents';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'nome',
        'nomemae',
        'cpf',
        'parentesco',
        'sexo',
        'nascimento',
        'user_id'
    ];    
}
