<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ReviewResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public static $wrap = "review";
    public function toArray($request)
    {
         return [
            'id' => $this->id,
            'customer_id' => $this->customer_id,
            'product_id'=> $this->product_id,
            'body' => $this->body,
            
        ];
    }
}
