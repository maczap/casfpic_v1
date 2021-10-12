<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use DB;

class Plan extends Model
{
    protected $table = "plans";

    protected $fillable = [
        'id', 'nome', 'codigo','valor','periodo','nick','codigo_pagseguro','amount','descricao','qtd_dep','tipo', 'percent_promotor'
    ];    


    public function get_plan(){
      return DB::table('plans')
        ->where('periodo',"mensal")
        ->where('tipo',"teste")
        
        ->get();        
    }   
}
