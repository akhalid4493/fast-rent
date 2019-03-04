<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    protected $fillable = [
        'ResponseCode',
        'ResponseMessage',
        'PayTxnID',
        'Paymode',
        'result',
        'gross_amount',
        'net_amount',
        'AuthID',
        'PostDate',
        'TransID',
        'RefID',
        'OrderID',
        'User_Id',
        'Price',
        'Order_id',
    ];
}
