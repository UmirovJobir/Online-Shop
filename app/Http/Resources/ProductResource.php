<?php

namespace App\Http\Resources;

use App\Models\Category;
use App\Models\Product;
use App\Models\ProductImage;
use Illuminate\Http\Resources\Json\JsonResource;

class ProductResource extends JsonResource
{
    public function toArray($request)
    {
//        $products = Product::where();

        return [
            "id" => $this->id,
            "title" => $this->title,
            "description" => $this->description,
            "price" => $this->price,
            "status" => $this->status,
            "category" => new CategoryResource($this->category),
            "tegs" => TagResource::collection($this->tags),
            "colors" => ColorResource::collection($this->colors),
            "product_images" => ProductImageResource::collection($this->productImages),
        ];
    }
}
