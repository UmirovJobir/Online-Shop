<?php

namespace App\Http\Controllers\API;

use App\Http\Resources\ProductResource;
use App\Models\Category;
use App\Models\Color;
use App\Models\Product;
use App\Models\Tag;

class FilterListController
{
    public function __invoke(Product $product)
    {
        $categories = Category::all();
        $colors = Color::all();
        $tegs = Tag::all();

        $maxPrice = Product::orderBy('price', 'DESC')->first()->price;
        $mixPrice = Product::orderBy('price', 'ASC')->first()->price;

        $result = [
            'categories' => $categories,
            'colors' => $colors,
            'tegs' => $tegs,
            'price' => [
                'max' => $maxPrice,
                'mix' => $mixPrice,
            ],
        ];

        return response()->json($result);
    }

}
