<?php

namespace App\Http\Controllers\WEB;

use App\Http\Requests\color\ColorStoreRequest;
use App\Http\Requests\color\ColorUpdateRequest;
use App\Models\Color;

class ColorController extends Controller
{
    public function index()
    {
        $colors = Color::all();
        return view('color.index', compact('colors'));
    }

    public function create()
    {
        return view('color.create');
    }


    public function store(ColorStoreRequest $request)
    {
        $data = $request->validated();
        Color::firstOrCreate($data);

        return redirect()->route('colors.index');
    }


    public function show(Color $color)
    {
        return view('color.show', compact('color'));
    }


    public function edit(Color $color)
    {
        return view('color.edit', ['color'=>$color]);
    }


    public function update(ColorUpdateRequest $request, Color $color)
    {
        $data = $request->validated();
        $color->update($data);

        return view('color.show', ['color'=>$color]);
    }


    public function destroy(Color $color)
    {
        $color->delete();

        return redirect()->route('colors.index');
    }
}
