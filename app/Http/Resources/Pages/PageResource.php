<?php

namespace App\Http\Resources\Pages;

use Illuminate\Http\Resources\Json\Resource;

class PageResource extends Resource
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
            'id'         => $this->id,
            'title'      => transText($this,'name'),
            'slug'       => $this->slug,
            'content'    => transText($this,'description'),
            'link'       => [
                    url(route('page',$this->id))
            ],
        ];
    }
}
