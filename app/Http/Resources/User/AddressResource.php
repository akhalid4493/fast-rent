<?php

namespace App\Http\Resources\User;

use App\Http\Resources\Provinces\ProvinceResource;
use Illuminate\Http\Resources\Json\Resource;

class AddressResource extends Resource
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
            'street'        => $this->street,
            'building'      => $this->building,
            'note'          => $this->note,
            'block'         => $this->block,
            'address'       => $this->address,
            'province'      => new ProvinceResource($this->addressProvince),
        ];
    }
}
