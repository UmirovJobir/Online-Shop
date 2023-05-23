<?php

namespace App\Http\Requests\product;

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
            'user_id' => "required",
            "title" => "required|string",
            "description" => "required",
            "price" => "required",
            "status" => "nullable",
            "category_id" => "required",
            "tags" => "nullable|array",
            "colors" => "nullable|array",
            "product_images"=>"nullable|array",









        ];
    }
}
