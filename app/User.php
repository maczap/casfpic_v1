<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password','cep','endereco',
        'numero','complemento','bairro','cidade','uf','cpf','rg','sexo',
        'nascimento','ecivil','profissao','celular','area_atuacao',
        'admin','supervisor','promotor','cliente'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function subscriptions()
    {
        return $this->hasMany(Subscription::class);
    }    

    public function PromotorId($code){
        return User::select("code_pagseguro")
                ->where("promotor_code", $code)
                ->where("promotor", 1)
                ->first();
    }    
}
