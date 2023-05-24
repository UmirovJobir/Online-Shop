<?php

namespace App\Http\Requests\product;

use Illuminate\Foundation\Http\FormRequest;

class FilterRequest extends FormRequest
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
            'user_id' => "nullable",
            "title" => "nullable|string",
            "description" => "nullable",
            "price" => "nullable",
            "status" => "nullable",
            "category_id" => "nullable",
            "tags" => "nullable|array",
            "colors" => "nullable|array",

//            'user_id' => "",
//            "title" => "string",
//            "description" => "string",
//            "price" => "int",
//            "status" => "",
//            "category_id" => "",
//            "tags" => "",
//            "colors" => "",
//            "product_images"=>"",









        ];
    }
}
