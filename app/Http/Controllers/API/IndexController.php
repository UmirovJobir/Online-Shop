<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\WEB\Controller;
use App\Http\Filters\ProductFilter;
use App\Http\Requests\API\ProductAPIStoreRequest;
use App\Http\Resources\ProductResource;
use App\Models\Product;

class IndexController extends Controller
{
    public function __invoke(ProductAPIStoreRequest $request)
    {
        $data = $request->validated();
        $filter = app()->make(ProductFilter::class, ['queryParams' => array_filter($data)]);
        $products = Product::filter($filter)->get();
        return ProductResource::collection($products);
    }
}
