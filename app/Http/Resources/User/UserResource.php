<?php

namespace App\Http\Resources\User;

use Illuminate\Http\Resources\Json\Resource;

class UserResource extends Resource
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
            'email'         => $this->email,
            'mobile'        => $this->mobile,
            'full_name'     => $this->full_name,
            'avatar'        => url($this->image),
            'api_token'     => $this->api_token,
            'device_token'  => $this->device_id,
        ];
    }
}
