<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\product\ProductStoreRequest;
use App\Http\Requests\product\ProductUpdateRequest;
use App\Http\Resources\ProductResource;
use App\Models\ColorProduct;
use App\Models\Product;
use App\Models\ProductImage;
use App\Models\ProductTag;
use Illuminate\Support\Facades\Storage;

class ProductAPIController extends Controller
{

    public function index()
    {
        $products = Product::all();
        return ProductResource::collection($products);
    }


    public function store(ProductStoreRequest $request)
    {
        $data = $request->validated();

        $product = Product::create([
            'title' => $data['title'],
            'description' =>$data['description'],
            'price' =>$data['price'],
            'category_id' =>$data['category_id'],
            'user_id' => auth()->user()->id
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


    public function update(ProductUpdateRequest $request, $id)
    {
        $data = $request->validated();


        $product = Product::with('productImages')->findOrFail($id);

        if (array_key_exists('tags', $data)) {
            $product->tags()->sync($data['tags']);
            unset($data['tags']);
        }


        if (array_key_exists('product_images', $data)) {
            $newImages = $data['product_images'];
            unset($data['product_images']);

            $productImages = ProductImage::where("product_id", $product->id)->get();
            foreach ($productImages as $productImage){
                unlink(public_path('storage/' . $productImage->file_path));
                $productImage->delete();
            }

            foreach ($newImages as $image) {
                $filePath = Storage::disk('public')->put('products', $image);
                ProductImage::create([
                    'product_id' => $product->id,
                    'file_path' => $filePath,
                ]);
            }
        }
        return new ProductResource($product);

    }

    public function destroy($id)
    {
        $product = Product::with('productImages')->findOrFail($id);

        $productImages = ProductImage::where("product_id", $product->id)->get();
        foreach ($productImages as $productImage){
            unlink(public_path('storage/' . $productImage->file_path));
            $productImage->delete();
        }

        $product->delete();

        return response()->json([
            'status' => true,
            'message' => "Product deleted successfully!",
        ], 200);

    }
}
