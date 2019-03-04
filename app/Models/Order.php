<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $fillable = [
        'subtotal', 
        'service_price', 
        'shipping',
        'off',
        'note',
        'time',
        'total',
        'method',
        'user_id',
        'address_id',
        'order_status_id',
    ];
    
    public function address()
    {       
        return $this->belongsTo('App\Models\Address' , 'address_id' ,'id');
    }
    
    public function orderStatus()
    {
        return $this->belongsTo('App\Models\OrderStatus','order_status_id','id');
    }
    
    public function user()
    {
        return $this->belongsTo('App\Models\User','user_id','id');
    }

    public function details()
    {       
      return $this->hasMany('App\Models\OrderDetail');
    }
}
