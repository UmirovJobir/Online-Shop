<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\WEB\Controller;
use App\Http\Requests\product\ProductStoreRequest;
use App\Http\Requests\product\ProductUpdateRequest;
use App\Http\Resources\ProductResource;
use App\Models\ColorProduct;
use App\Models\Product;
use App\Models\ProductImage;
use App\Models\ProductTag;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProductAPIController extends Controller
{

    public function index()
    {
        $products = Product::all();
        return ProductResource::collection($products);
    }

    public function create()
    {
        //
    }

    public function store(ProductStoreRequest $request)
    {
        $data = $request->validated();

        $product = Product::create([
            'title' => $data['title'],
            'description' =>$data['description'],
            'price' =>$data['price'],
            'category_id' =>$data['category_id'],
        ]);


        if (array_key_exists('tags', $data)) {
            $tagsIds = $data['tags'];
            foreach ($tagsIds as $tagsId) {
                ProductTag::firstOrCreate([
                    'product_id' => $product->id,
                    'tag_id' => $tagsId,
                ]);
            }
        }

        if (array_key_exists('colors', $data)) {
            $colorsIds = $data['colors'];
            foreach ($colorsIds as $colorsId) {
                ColorProduct::firstOrCreate([
                    'product_id' => $product->id,
                    'color_id' => $colorsId,

                ]);
            }
        }

        if (array_key_exists('product_images', $data)) {
            $productImages = $data['product_images'];
            foreach ($productImages as $productImage) {
//                $currentImagesCount = ProductImage::where('product_id', $product->id)->count();
//
//                if ($currentImagesCount > 3) continue;
                $filePath = Storage::disk('public')->put('products', $productImage);
                ProductImage::create([
                    'product_id' => $product->id,
                    'file_path' => $filePath,
                ]);
            }
        }
        return new ProductResource($product);
    }

    public function show($id)
    {
        $product = Product::with('productImages')->findOrFail($id);
        return new ProductResource($product);
    }

    public function update(ProductUpdateRequest $request, Product $product)
    {
        $data = $request->validated();

        dd($data);
        $product->update($data);
        return $product;
    }

    public function destroy($id)
    {
        //
    }
}
