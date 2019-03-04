<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OrderDetail extends Model
{
    protected $fillable = [
        'product_id', 
        'order_id',
        'price',
        'qty',
        'total',
    ];

    public function orderOfDetails()
    {       
        return $this->belongsTo('App\Models\Order' , 'order_id' ,'id');
    }


    public function product()
    {       
        return $this->belongsTo('App\Models\Product' , 'product_id' , 'id' );
    }
}
