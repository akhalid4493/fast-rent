<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Car extends Model
{
    protected $fillable = [
        'name_en', 
        'name_ar',
        'description_en' ,
        'description_ar' ,
        'status' ,
        'image' ,
        'year',
        'price',
        'qty',
        'body_color',
        'interior_color',
        'category_id',
        'condition_id',
        'model_id',
        'transmission_id',
        'fuel_id',
        'agency_id'
    ];
}
