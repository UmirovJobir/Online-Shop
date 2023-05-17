<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;

class TestProductAPIController extends Controller
{
    public function index()
    {
        $products = auth()->user()->products;

        return response()->json([
            'success' => true,
            'data' => $products
        ]);
    }

    public function show($id)
    {
        $products = auth()->user()->products()->find($id);

        if (!$products) {
            return response()->json([
                'success' => false,
                'message' => 'Product not found '
            ], 400);
        }

        return response()->json([
            'success' => true,
            'data' => $products->toArray()
        ], 400);
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'title' => 'required',
            'description' => 'required',
            'price' => 'required',
            'category_id' => 'required'
        ]);

        $product = new Product();
        $product->title = $request->title;
        $product->description = $request->description;
        $product->price = $request->price;
        $product->category_id = $request->category_id;

        if (auth()->user()->products()->save($product))
            return response()->json([
                'success' => true,
                'data' => $product->toArray()
            ]);
        else
            return response()->json([
                'success' => false,
                'message' => 'Product not added'
            ], 500);
    }

    public function update(Request $request, $id)
    {
        $product = auth()->user()->products()->find($id);

        if (!$product) {
            return response()->json([
                'success' => false,
                'message' => 'Product not found'
            ], 400);
        }

        $updated = $product->fill($request->all())->save();

        if ($updated)
            return response()->json([
                'success' => true
            ]);
        else
            return response()->json([
                'success' => false,
                'message' => 'Product can not be updated'
            ], 500);
    }

    public function destroy($id)
    {
        $product = auth()->user()->products()->find($id);

        if (!$product) {
            return response()->json([
                'success' => false,
                'message' => 'Product not found'
            ], 400);
        }

        if ($product->delete()) {
            return response()->json([
                'success' => true
            ]);
        } else {
            return response()->json([
                'success' => false,
                'message' => 'Product can not be deleted'
            ], 500);
        }
    }
}
