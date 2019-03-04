<?php

namespace App\Models;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Zizaco\Entrust\Traits\EntrustUserTrait;

class User extends Authenticatable
{
    use EntrustUserTrait;
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'email',
        'full_name', 
        'password',
        'country_id',
        'mobile',
        'code',
        'api_token',
        'platform',
        'device_id',
        'active',
        'image',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 
        'remember_token',
    ];
    

    public function userCountry()
    {       
        return $this->belongsTo('App\Models\Country' , 'country_id' ,'id');
    }

    public function orders()
    {       
        return $this->hasMany('App\Models\Order');
    }


    public function address()
    {
        return $this->hasMany('App\Models\Address');
    }
    
    public function userInfoAP()
    {       
        return $this->hasOne('App\Models\AP\APUserInfo');
    }

    public function allMyAPInfo()
    {       
        return $this->hasMany('App\Models\AP\APUserInfo')->orderBy('id','desc');
    }

    public function subscription()
    {
        return $this->hasOne('App\Models\UserSubscription')->latest();
    }

    public function adminOfAgency()
    {
        return $this->hasOne('App\Models\Agency')->latest();
    }
}
