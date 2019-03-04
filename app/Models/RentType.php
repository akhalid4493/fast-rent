<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RentType extends Model
{
    protected $fillable = [
        'name_en', 
        'name_ar', 
        'status' ,
    ];
}
