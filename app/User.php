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
        'name',
        'nomemae',
        'email',
        'password',
        'admin',
        'supervisor',
        'promotor',
        'cliente',
        'super_id',
        'promotor_code',
        'cep',
        'endereco',
        'numero',
        'complemento',
        'bairro',
        'cidade',
        'uf',
        'cpf',
        'rg',
        'sexo',
        'nascimento',
        'ecivil',
        'area_atuacao',
        'profissao',
        'celular',
        'vinculo',
        'link'
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

    public function transactions()
    {
        return $this->hasMany(Transaction::class);
    }

    public function usercards()
    {
        return $this->hasMany(Usercard::class);
    }

    public function setIsAdminAttribute($value)
    {
        
        $this->attributes['is_admin'] = ($value === true || $value === 'on' ? 1 : 0);
    }

    public function setPasswordAttribute($value)
    {
        if (is_null($value)) {
            unset($this->attributes['password']);
            return;
        }

        $this->attributes['password'] = bcrypt($value);
    }

    public function setCpfAttribute($value)
    {
        if (!is_null($value)) {
            $this->attributes['cpf'] = $this->numericMaskRemove($value);
        }
    }

    public function setRgAttribute($value)
    {
        if (!is_null($value)) {
            $this->attributes['rg'] = $this->numericMaskRemove($value);
        }
    }

    public function setCellAttribute($value)
    {
        if (!is_null($value)) {
            $this->attributes['cell'] = $this->numericMaskRemove($value);
        }
    }

    public function setPhoneAttribute($value)
    {
        if (!is_null($value)) {
            $this->attributes['phone'] = $this->numericMaskRemove($value);
        }
    }

    public function setZipCodeAttribute($value)
    {
        if (!is_null($value)) {
            $this->attributes['zip_code'] = $this->numericMaskRemove($value);
        }
    }

    public function setBirthDateAttribute($value)
    {
        $this->attributes['birth_date'] = $this->convertStringToDate($value);
    }

    public function getBirthDateAttribute($value)
    {
        if (!is_null($value)) {
            return date('d/m/Y', strtotime($value));
        }
        return null;
    }

    private function convertStringToDate(?string $param)
    {
        if (empty($param)){
            return null;
        }

        list($day, $month, $year) = explode('/', $param);

        return (new DateTime($year .'-'. $month .'-'. $day))->format('Y-m-d');
    }

    private function numericMaskRemove($value)
    {
        return preg_replace('/[^0-9]/', '', $value);
    }

    public function user_view($id){

        return User::select("name",'id as u_id')
        ->where("id", $id)
        ->addSelect(['boleto_url' => Subscription::select('boleto_url')
            ->whereColumn('user_id', 'u_id')
            ->orderBy('id','desc')
            ->limit(1)  
        ])
         ->addSelect(['boleto_barcode' => Subscription::select('boleto_barcode')
            ->whereColumn('user_id', 'u_id')
            ->orderBy('id','desc')
            ->limit(1)  
        ])       
        ->addSelect(['plano' => Subscription::select('plano')
            ->whereColumn('user_id', 'u_id')
            ->orderBy('id','desc')
            ->limit(1)  
        ])  
        ->addSelect(['periodo' => Subscription::select('periodo')
            ->whereColumn('user_id', 'u_id')
            ->orderBy('id','desc')
            ->limit(1)  
        ])      
        ->addSelect(['status' => Subscription::select('status')
            ->whereColumn('user_id', 'u_id')
            ->orderBy('id','desc')
            ->limit(1)  
        ])   
        ->addSelect(['status_detail' => Subscription::select('status_detail')
            ->whereColumn('user_id', 'u_id')
            ->orderBy('id','desc')
            ->limit(1)  
        ])      

        ->addSelect(['pix_qr_code' => Subscription::select('pix_qr_code')
            ->whereColumn('user_id', 'u_id')
            ->orderBy('id','desc')
            ->limit(1)  
        ])      
        ->addSelect(['pix_expiration_date' => Subscription::select('pix_expiration_date')
            ->whereColumn('user_id', 'u_id')
            ->orderBy('id','desc')
            ->limit(1)  
        ])                  
        
        ->addSelect(['subscription_id' => Subscription::select('id')
            ->whereColumn('user_id', 'u_id')
            ->orderBy('id','desc')
            ->limit(1)  
        ])           
        ->get();    

    }
}
