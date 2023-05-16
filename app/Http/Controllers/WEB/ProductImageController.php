<?php

namespace App\Http\Controllers\WEB;

use App\Http\Controllers\Controller;
use App\Http\Requests\product_image\ProductImageRequest;
use App\Models\Product;
use App\Models\ProductImage;
use Illuminate\Support\Facades\Storage;

class ProductImageController extends Controller
{
    public function destroy(ProductImageRequest $request, $id)
    {
        $productImages = ProductImage::where('product_id', $id)->where('file_path', $request->product_image)->get()->first();
        unlink(public_path('storage/' . $productImages->file_path));
        $productImages->delete();
        return redirect('products/'.$id.'/edit');
    }
}
