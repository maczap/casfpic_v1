<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use App\User;

class Split extends Model
{

    protected $table = "splits";

    protected $fillable = [
        'id_promotor',
        'valor',
        'id_sub',
        'tipo',
        'pago',
        'data_pago',
        'data_saque'

    ];    

    public function pagamentos()
    {

        return Split::select('splits.*', DB::raw("DATE_FORMAT(created_at, '%d/%m/%Y') as data"))
        ->where("tipo", 0)
        ->addSelect(['nome' => User::select('name')
            ->whereColumn('id', 'id_promotor')
            ->limit(1)  
        ])
        ->get();            

            return Split::get();    

            
        
    }
}
