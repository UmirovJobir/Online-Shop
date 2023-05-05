<?php

namespace App\Http\Controllers;

use App\Http\Requests\product\ProductStoreRequest;
use App\Http\Requests\product\ProductUpdateRequest;
use App\Models\Category;
use App\Models\Color;
use App\Models\Product;
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

//        $data['images'] = Storage::disk('public')->put('products', $data['images']);

        $image_names = [];
        foreach($request->file('images') as $key => $item) {
            $file_names = time() . '_' . $key . '.' . $item->getClientOriginalExtension();
            $item->storeAs('/public/products', $file_names);
            $image_names[] = $file_names;
        }
        $images = implode(',', $image_names);

        $data['images'] = $images ?? '';

        $tegsIds = $data['tegs'];
        $colorsIds = $data['colors'];
        unset($data['tegs'], $data['colors']);

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

        return redirect()->route('products.index');
    }



    public function show(Product $product)
    {
        $tegs = ProductTeg::get();
        return view('product.show', compact('product'));
    }



    public function edit(Product $product)
    {
        $categories = Category::all();
        return view('product.edit', ['product'=>$product,'categories'=>$categories]);
    }


    public function update(ProductUpdateRequest $request, Product $product)
    {
        dd($request);
    }


    public function destroy($id)
    {
        $tegs = Product::with(['tegs'])->get();

        return view('test', ['tegs'=>$tegs]);
    }
}



