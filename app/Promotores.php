<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use DB;
use App\User;
use App\Promotores;

class Promotores extends Model
{
    
    private $table = "users";


    public function getPromotor($code)
    {

            return User::select("id","code_pagseguro")
            ->where("promotor_code", $code)
            ->Where("promotor", 1)
            ->addSelect(['payment_metthod' => Subscription::select('payment_method')
                ->whereColumn('user_id', 'users.id')
                ->orderByDesc('created_at')
                ->limit(1)  
            ])
            ->addSelect(['status' => Subscription::select('status')
            ->whereColumn('user_id', 'users.id')
            ->orderByDesc('created_at')
            ->limit(1)  
            ])    
            ->addSelect(['manage_url' => Subscription::select('manage_url')
            ->whereColumn('user_id', 'users.id')
            ->orderByDesc('created_at')
            ->limit(1)  
            ])   
            ->addSelect(['plan_id' => Subscription::select('plan_id')
            ->whereColumn('user_id', 'users.id')
            ->orderByDesc('created_at')
            ->limit(1)  
            ])        
    
            ->addSelect(['plan_amount' => Plan::select('amount')
            ->whereColumn('plan_id', 'plans.id')
            ->limit(1)  
            ])     
    
            ->addSelect(['plano' => Plan::select('name')
            ->whereColumn('plan_id', 'plans.id')
            ->limit(1)  
            ])     
            ->addSelect(['plano_periodo' => Plan::select('periodo')
            ->whereColumn('plan_id', 'plans.id')
            ->limit(1)  
            ])          
            ->orderBy("created_at","desc")                     
            ->paginate(7);    
        
    }

}
