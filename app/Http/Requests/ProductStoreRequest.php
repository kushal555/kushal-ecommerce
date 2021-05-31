<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProductStoreRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return auth()->user()->role == 'shop';
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'product_name' => 'required|min:10',
            'category_id'   =>  'required|exists:categories,id',
            'subcategory_id'   =>  'required|exists:categories,id',
            'price' => 'required|regex:/^\d+(\.\d{1,2})?$/',
            'description' => 'required',
            'image' => 'required|image',
            'status'    =>  'required'
        ];
    }
}
