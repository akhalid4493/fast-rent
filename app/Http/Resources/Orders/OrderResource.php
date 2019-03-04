<?php

namespace App\Http\Resources\Orders;

use Illuminate\Http\Resources\Json\Resource;
use App\Http\Resources\User\AddressResource;

class OrderResource extends Resource
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
            'id'            => $this->id,
            'subtotal'      => number_format($this->subtotal,3),
            'shipping'      => number_format($this->shipping,3),
            'total'         => number_format($this->total,3),
            'time'          => $this->time,
            'note'          => $this->note,
            'order_details' => OrderDetailsResource::collection($this->details),
            'address'       => new AddressResource($this->address),
        ];
    }
}
