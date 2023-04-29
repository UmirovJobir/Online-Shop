<?php

namespace App\Http\Controllers;

use App\Http\Requests\Teg\TegStoreRequest;
use App\Models\Teg;
use Illuminate\Http\Request;

class TegController extends Controller
{
    public function index()
    {
        $tegs = Teg::all();
        return view('teg.index', compact('tegs'));
    }

    public function create()
    {
        return view('teg.create');
    }

    public function store(TegStoreRequest $request)
    {
        $data = $request->validated();
        Teg::firstOrCreate($data);

        return redirect()->route('tegs.index');
    }

    public function show(Teg $teg)
    {
        return view('teg.show', compact('teg'));
    }

    public function edit(Teg $teg)
    {
        return view('teg.edit', compact('teg'));
    }

    public function update(TegStoreRequest $request, Teg $teg)
    {
        $data = $request->validated();
        $teg->update($data);

        return view('teg.show', compact('teg'));
    }

    public function destroy(Teg $teg)
    {
        $teg->delete();

        return redirect()->route('tegs.index');
    }
}
