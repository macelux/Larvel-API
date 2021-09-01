<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateOrderRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'order_number '=>'numeric|nullable' ,
            'customer_id'=>'numeric|exists:users,id',
            'status'=>Rule::in(['pending' , 'processing' , 'completed' , 'declined']),
            'grand_total' =>'numeric' ,
            'item_count' => 'numeric' ,
            'payment_status' => [Rule::in("paid" , "not paid")],
            'payment_method' => 'string'



        ];
    }
}
