<?php

namespace App\Http\Controllers;

use App\Http\Requests\product\ProductStoreRequest;
use App\Models\Color;
use App\Models\Product;
use App\Models\ProductTeg;
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
        return view('product.create');
    }


    public function store(ProductStoreRequest $request)
    {
        $data = $request->validated();
        $data['preview_image'] = Storage::disk('public')->put('images', $data['preview_image']);

        $tegsIds = $data['tags'];
        $colorsIds = $data['colors'];
        unset($data['tags'], $data['colors']);

        $product = Product::firstOrCreate([
            'title' => $data['title']
        ], $data);

        foreach ($tegsIds as $tagsId){

            ProductTeg::firstOrCreate([
                'product_id' => $product->id,
                'tag_id' => $tagsId,

            ]);
        }

        foreach ($colorsIds as $colorsId){

            Color::firstOrCreate([
                'product_id' => $product->id,
                'tag_id' => $colorsId,

            ]);
        }
    }


    public function show($id)
    {
        //
    }



    public function edit($id)
    {
        //
    }


    public function update(Request $request, $id)
    {
        //
    }


    public function destroy($id)
    {
        //
    }
}
