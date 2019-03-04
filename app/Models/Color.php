<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Color extends Model
{
    protected $fillable = [
        'name_en', 
        'name_ar', 
        'status' ,
    ];
}
