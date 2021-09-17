<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class CartItemResource extends JsonResource
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
            'cart_id' => $this->cart_id,

            'product_id' => $this->product_id,

            'quantity' => $this->quantity,
            'Price'  => $this->Price,

        ];
    }
}
