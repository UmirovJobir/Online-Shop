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
            "content" => $this->content,
            "preview_image" => $this->imageUrl,
            "images" => $this->images,
            "price" => $this->price,
            "count" => $this->count,
            "is_published" => $this->is_published,
            "category" => new CategoryResource($this->category),
            "colors" => ColorResource::collection($this->colors),
            "product_images" => ProductImageResource::collection($this->productImages),
//            "tegs" => $this->tegs,
//            "colors" => $this->colors,
        ];
    }
}
