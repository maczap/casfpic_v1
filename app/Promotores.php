<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use DB;
use App\User;
use App\Promotores;

class Promotores extends Model
{
    
    protected $table = "users";


    public function getPromotor($code)
    {

            return User::select("id as promotor_id","code_pagseguro as promotor","super_id as supervidor_id","super_id as s_id")
            ->where("promotor_code", $code)
            ->Where("promotor", 1)
            ->addSelect(['supervisor' => User::select('code_pagseguro')
                ->whereColumn('id', 's_id')
                ->limit(1)  
            ])
            ->get();    

            
        
    }

}
