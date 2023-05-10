<?php

namespace App\Http\Controllers;

use App\Http\Requests\product\ProductStoreRequest;
use App\Http\Requests\product\ProductUpdateRequest;
use App\Http\Resources\CategoryResource;
use App\Models\Category;
use App\Models\Color;
use App\Models\Product;
use App\Models\ProductImage;
use App\Models\ProductTeg;
use App\Models\Teg;
use App\Models\ColorProduct;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{

    public function index()
    {
        $products = Product::all();
        return view('product.index', compact('products'));
    }


    public function create()
    {
        $tegs = Teg::all();
        $colors = Color::all();
        $categories = Category::all();
        return view('product.create', compact('tegs', 'colors', 'categories'));
    }


    public function store(ProductStoreRequest $request)
    {
        $data = $request->validated();

        if (array_key_exists('product_images', $data)){
            $productImages = $data['product_images'];
        }

        if (array_key_exists('preview_image', $data)){
            $data['preview_image'] = Storage::disk('public')->put('preview_image', $data['preview_image']);
        }

//        $preview_image = time().'.'.$request->file('preview_image')->getClientOriginalExtension();
//        $request->file('preview_image')->storeAs('/public/images', $preview_image);
//
//        $image_names = [];
//        foreach($request->file('images') as $key => $item) {
//            $file_names = time() . '_' . $key . '.' . $item->getClientOriginalExtension();
//            $item->storeAs('/public/products', $file_names);
//            $image_names[] = $file_names;
//        }
//        $images = implode(',', $image_names);

//        $data['preview_image'] = $preview_image ?? '';
//        $data['images'] = $images ?? '';

        $tegsIds = $data['tegs'];
        $colorsIds = $data['colors'];
        unset($data['tegs'], $data['colors'], $data['product_images']);

        $product = Product::firstOrCreate([
            'title' => $data['title']
        ], $data);

        foreach ($tegsIds as $tagsId){

            ProductTeg::firstOrCreate([
                'product_id' => $product->id,
                'teg_id' => $tagsId,

            ]);
        }

        foreach ($colorsIds as $colorsId){

            ColorProduct::firstOrCreate([
                'product_id' => $product->id,
                'color_id' => $colorsId,

            ]);
        }

        foreach ($productImages as $productImage) {
            $currentImagesCount = ProductImage::where('product_id', $product->id)->count();

            if ($currentImagesCount > 3) continue;
            $filePath = Storage::disk('public')->put('products', $productImage);
            ProductImage::create([
                'product_id' => $product->id,
                'file_path' => $filePath,

            ]);
        }

        return redirect()->route('products.index');
    }



    public function show(Product $product)
    {
        return view('product.show', compact('product'));
    }



    public function edit(Product $product)
    {
        $categories = Category::all();
        $tegs = Teg::all();
        $colors = Color::all();
        return view('product.edit', ['product'=>$product,'categories'=>$categories, 'tegs'=>$tegs, 'colors'=>$colors]);
    }


    public function update(ProductUpdateRequest $request, Product $product)
    {
        $data = $request->validated();

        $tegs = $data['tegs'];

        unset($data['tegs']);

        $product->update($data);

        $product->tegs()->sync($tegs);
        return view('product.show', ['product'=>$product]);

    }


    public function destroy(Product $product)
    {
        $product->delete();
        return redirect()->route('products.index');
    }
}



