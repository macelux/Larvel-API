<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateProductRequest extends FormRequest
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
            'name'      =>  'nullable|string|max:255',
            'sku'       =>  'nullable|numeric',
            
            'price'     =>  'nullable|regex:/^\d+(\.\d{1,2})?$/',
            'special_price'     =>  'nullable|regex:/^\d+(\.\d{1,2})?$/',
            'quantity'  =>  'nullable|numeric',
            

        ];
    }
}
