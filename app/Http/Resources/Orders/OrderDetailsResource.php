<?php

namespace App\Http\Resources\Orders;

use Illuminate\Http\Resources\Json\Resource;
use App\Http\Resources\Products\ProductResource;

class OrderDetailsResource extends Resource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
         return [
            'orderQtyProduct'       => $this->qty,
            'orderTotalProduct'     => number_format($this->total,3),
            'orderPriceProduct'     => number_format($this->price,3),
            'productDetails'        => new ProductResource($this->product),
        ];
    }
}
