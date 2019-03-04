<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Agency extends Model
{
    protected $fillable = [
        'name_en', 
        'name_ar', 
        'status' ,
        'image' ,
        'description_en' ,
        'description_ar' ,
        'block',
        'street',
        'address',
        'note',
        'building',
        'province_id',
        'user_id',
        'address_id',
    ];

    public function address()
    {       
        return $this->belongsTo('App\Models\Province' , 'province_id' ,'id');
    }

    public function user()
    {       
        return $this->belongsTo('App\Models\User' , 'user_id' ,'id');
    }
}
