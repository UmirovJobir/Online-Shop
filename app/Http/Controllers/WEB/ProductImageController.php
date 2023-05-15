<?php

namespace App\Http\Controllers\WEB;

use App\Http\Controllers\Controller;
use App\Http\Requests\product_image\ProductStoreImageRequest;
use App\Http\Requests\product_image\ProductUpadateImageRequest;
use App\Models\Product;
use App\Models\ProductImage;
use Illuminate\Support\Facades\Storage;

class ProductImageController extends Controller
{
    public function store(ProductStoreImageRequest $request, $id)
    {
        $data = $request->validated();

        $productImages = $data['product_images'];

        foreach ($productImages as $productImage) {
            $filePath = Storage::disk('public')->put('products', $productImage);
            ProductImage::create([
                'product_id' => $id,
                'file_path' => $filePath,
            ]);
        }
        return redirect('products/'.$id);
    }

    public function destroy(ProductUpadateImageRequest $request, $id)
    {
        $productImages = ProductImage::where('product_id', $id)->where('file_path', $request->product_image)->get()->first();
        unlink(public_path('storage/' . $productImages->file_path));
        $productImages->delete();
        return redirect('products/'.$id.'/edit');
    }
}
