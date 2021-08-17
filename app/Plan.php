<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use DB;

class Plan extends Model
{
    protected $table = "plans";

    protected $fillable = [
        'id', 'nome', 'codigo','valor','periodo','nick','codigo_pagseguro'
    ];    


    public function get_plan(){
      return DB::table('plans')
        ->where('periodo',"mensal")
        ->get();        
    }   
}
