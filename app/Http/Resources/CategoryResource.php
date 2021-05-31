<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class CategoryResource extends JsonResource
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
            'value'   => $this->id,
            'id'  => $this->id,
            'text' => $this->name,
            'parent_id' => $this->parent_id
        ];
    }
}
