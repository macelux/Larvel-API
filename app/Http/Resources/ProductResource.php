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
            'id' => $this->id,
            'sku'=> $this->sku,
            'name' => $this->name,
            'slug' => $this->slug,
            'description'  => $this->description,
            'quantity' => $this->quantity,
            'weight'=> $this->weight,
            'price' => $this->price,
            'sale_price' => $this->sale_price,
            'status' => $this->status
        ];
    }
}
