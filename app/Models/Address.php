<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Address extends Model
{
    protected $fillable = [
        'block',
        'street',
        'address',
        'note',
        'building',
        'province_id',
        'user_id',
    ];

    public function addressProvince()
    {       
        return $this->belongsTo('App\Models\Province' , 'province_id' ,'id');
    }

    public function agency()
    {       
        return $this->hasMany('App\Models\Agency');
    }
}
