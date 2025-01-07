<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Element;

class ElementController extends Controller
{
    //
    public function index()
    {
        $elements = Element::with('steps')->get();
        return view('elements.index', compact('elements'));
    }

    public function create()
    {
        return view('elements.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'description' => 'required',
        ]);

        Element::create($request->all());
        return redirect()->back()->with('success', 'Element created successfully');
    }
}
