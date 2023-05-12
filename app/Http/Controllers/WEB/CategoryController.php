<?php

namespace App\Http\Controllers\WEB;

use App\Http\Requests\Category\StoreRequest;
use App\Http\Requests\Category\UpdateRequest;
use App\Models\Category;

class CategoryController extends Controller
{
    public function index()
    {
        $categories = Category::all();
        return view('category.index', compact('categories'));
    }


    public function create()
    {
        return view('category.create');
    }


    public function store(StoreRequest $request)
    {
        $data = $request->validated();
        Category::firstOrCreate($data);

        return redirect()->route('category.index');
    }


    public function show(Category $category)
    {
        return view('category.show', compact('category'));
    }


    public function edit(Category $category)
    {
        return view('category.edit', ['category'=>$category]);
    }


    public function update(UpdateRequest $request, Category $category)
    {
        $data = $request->validated();
        $category->update($data);

        return view('category.show', ['category'=>$category]);
    }


    public function destroy(Category $category)
    {
        $category->delete();

        return redirect()->route('category.index');
    }
}
