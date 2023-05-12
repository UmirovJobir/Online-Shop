<?php

namespace App\Http\Controllers\WEB;

use App\Http\Requests\product_image\ProductStoreImageRequest;
use App\Http\Requests\product_image\ProductUpadateImageRequest;
use App\Models\ProductImage;
use Illuminate\Support\Facades\Storage;

class ProductImageController extends Controller
{
    public function store(ProductStoreImageRequest $request)
    {
        $data = $request->validated();

        $productImages = $data['product_images'];

        foreach ($productImages as $productImage) {
            $filePath = Storage::disk('public')->put('products', $productImage);
            ProductImage::create([
                'product_id' => $request->product,
                'file_path' => $filePath,
            ]);
        }
        return redirect('products/'.$request->product);
    }

    public function update(ProductUpadateImageRequest $request)
    {
        $productImages = ProductImage::where('product_id', $request->product)->where('file_path', $request->product_image)->get()->first();
        unlink(public_path('storage/' . $productImages->file_path));
        $productImages->delete();
        return redirect('products/'.$request->product.'/edit');
    }
}
