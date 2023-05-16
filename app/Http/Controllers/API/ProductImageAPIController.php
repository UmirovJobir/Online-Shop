<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\product_image\ProductImageRequest;
use App\Http\Resources\ProductImageResource;
use App\Http\Resources\ProductResource;
use App\Models\Product;
use App\Models\ProductImage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProductImageAPIController extends Controller
{

    public function store(ProductImageRequest $request, $id)
    {
        $data = $request->validated();
        $newImages = $data['product_images'];

        $product = Product::findOrFail($id);

        foreach ($newImages as $image) {
            $filePath = Storage::disk('public')->put('products', $image);
            ProductImage::create([
                'product_id' => $product->id,
                'file_path' => $filePath,
            ]);
        }

        return new ProductResource($product);
    }


    public function destroy($id)
    {
        $product = ProductImage::findOrFail($id);
        $product->delete();
        return response()->json([
            'status' => true,
            'message' => "ProductImage deleted successfully!",
        ], 200);
    }
}
