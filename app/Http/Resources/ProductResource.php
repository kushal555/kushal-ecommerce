<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ProductResource extends JsonResource
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
            'id'    =>  $this->id,
            'product_name' => $this->product_name,
            'description' => $this->description,
            'status' => $this->status,
            'image' => asset('storage/products/' . $this->image),
            'thumbnail' => asset('storage/products/thumbnails/' . $this->image),
            'category' => $this->category->name,
            'subcategory' => $this->subcategory->name,
            'category_id' => $this->category->id,
            'subcategory_id' => $this->subcategory->id,
            'price' => $this->price
        ];
    }
}
