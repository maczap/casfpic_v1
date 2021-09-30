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

            return User::select("id as promotor_id","promotor_code as promotor","super_id as supervidor_id","super_id as s_id","rec_id")
            ->where("promotor_code", $code)
            ->Where("promotor", 1)
            ->addSelect(['supervisor' => User::select('supervidor_id')
                ->whereColumn('id', 's_id')
                ->limit(1)  
            ])
            ->get();    

            
        
    }

    public function testaPromotor($code)
    {

            return User::select("id")
            ->where("promotor_code", $code)
            ->Where("promotor", 1)
            ->get();    
        
    }    

}
