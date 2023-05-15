<?php

namespace App\Http\Controllers\WEB;

use App\Http\Controllers\Controller;
use App\Http\Requests\product\ProductStoreRequest;
use App\Http\Requests\product\ProductUpdateRequest;
use App\Models\Category;
use App\Models\Color;
use App\Models\ColorProduct;
use App\Models\Product;
use App\Models\ProductImage;
use App\Models\ProductTag;
use App\Models\Tag;
use Illuminate\Support\Facades\Storage;


class ProductController extends Controller
{

    public function index()
    {
        $products = Product::orderBy('id', 'DESC')->get();;
        return view('product.index', compact('products'));
    }


    public function create()
    {
        $tags = Tag::all();
        $colors = Color::all();
        $categories = Category::all();
        return view('product.create', compact('tags', 'colors', 'categories'));
    }


    public function store(ProductStoreRequest $request)
    {
        $data = $request->validated();

        $tagsIds = $data['tags'];
        $colorsIds = $data['colors'];

        $product = Product::firstOrCreate([
            'title' => $data['title'],
            'description' =>$data['description'],
            'price' =>$data['price'],
            'category_id' =>$data['category_id'],
        ]);


        foreach ($tagsIds as $tagsId){
            ProductTag::firstOrCreate([
                'product_id' => $product->id,
                'tag_id' => $tagsId,
            ]);
        }

        foreach ($colorsIds as $colorsId){

            ColorProduct::firstOrCreate([
                'product_id' => $product->id,
                'color_id' => $colorsId,

            ]);
        }

        if (array_key_exists('product_images', $data)) {
            $productImages = $data['product_images'];
            foreach ($productImages as $productImage) {
                $currentImagesCount = ProductImage::where('product_id', $product->id)->count();

                if ($currentImagesCount > 3) continue;
                $filePath = Storage::disk('public')->put('products', $productImage);
                ProductImage::create([
                    'product_id' => $product->id,
                    'file_path' => $filePath,
                ]);
            }
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
        $tags = Tag::all();
        $colors = Color::all();
        return view('product.edit', ['product'=>$product,'categories'=>$categories, 'tags'=>$tags, 'colors'=>$colors]);
    }


    public function update(ProductUpdateRequest $request, Product $product)
    {
        $data = $request->validated();

        if (array_key_exists('tags', $data)) {
            $product->tags()->sync($data['tags']);
            unset($data['tags']);
        }


        if (array_key_exists('product_images', $data)) {
            $productImages = $data['product_images'];
            unset($data['product_images']);

            foreach ($productImages as $productImage) {
                $filePath = Storage::disk('public')->put('products', $productImage);
                ProductImage::create([
                    'product_id' => $product->id,
                    'file_path' => $filePath,
                ]);
            }

            $product->update($data);
        }
        return view('product.show', ['product' => $product]);
    }




    public function destroy(Product $product)
    {
        $productImages = ProductImage::where('product_id', $product->id)->get();
        foreach ($productImages as $productImage) {
            unlink(public_path('storage/'.$productImage->file_path));
        }
        $product->delete();
        return redirect()->route('products.index');
    }
}



