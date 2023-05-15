<?php

namespace App\Http\Requests\product_image;

use Illuminate\Foundation\Http\FormRequest;

class ProductStoreImageRequest extends FormRequest
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
            "product_images"=>"required|array",
        ];
    }
}
