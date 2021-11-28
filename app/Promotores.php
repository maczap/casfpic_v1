<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use DB;
use App\User;
use App\Subscription;


class Promotores extends Model
{
    
    protected $table = "users";


    public function getPromotor($code)
    {

            return User::select("id as promotor_id","promotor_code","super_id as supervidor_id","super_id as s_id","rec_id")
            ->where("promotor_code", $code)
            ->Where("promotor", 1)
            ->addSelect(['supervisor' => User::select('supervidor_id')
                ->whereColumn('id', 's_id')
                ->limit(1)  
            ])
            ->get();    

            
        
    }

    public function cadastro_promotores($code)
    {

            return User::select("name","cpf","id as u_id", DB::raw("DATE_FORMAT(created_at, '%d/%m/%Y') as data"))
            ->where("vinculo", $code)
            ->orderBy("id","desc")
            ->addSelect(['plano' => Subscription::select('plano')
                ->whereColumn('user_id', 'u_id')
                ->orderBy('id','desc')
                ->limit(1)  
            ])             
            ->addSelect(['status' => Subscription::select('status')
                ->whereColumn('user_id', 'u_id')
                ->orderBy('id','desc')
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

    public function porcentagem($periodo, $plano)
    {

        return DB::table('porcentagens')
            ->where("periodo", $periodo)
            ->Where("plano", $plano)
            ->get();    
        
    }       





}
