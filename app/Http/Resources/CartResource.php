<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class CartResource extends JsonResource
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
            'id' =>$this->id,

            'customer_id' =>$this->customer_id,

            'product_id' => $this->product_id,

            'quantity' => $this->quantity,
            'Price'  => $this->Price,

        ];
    }
}
