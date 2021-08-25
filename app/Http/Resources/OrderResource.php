<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class OrderResource extends JsonResource
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
            'order_number' => $this->order_number,
            'customer_id'=> $this->customer_id,
            'status' => $this->status,
            'grand_total' => $this->grand_total,
            'item_count'  => $this->item_count,
            'payment_status' => $this->payment_status,
            'payment_method'=> $this->payment_method,
             'status' => $this->status,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }
}
