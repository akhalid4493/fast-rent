<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Models extends Model
{
    protected $fillable = [
        'name_en', 
        'name_ar', 
        'status',
        'brand_id',
    ];

    public function brand()
    {       
        return $this->belongsTo('App\Models\Brand' , 'brand_id' ,'id');
    }
}
