<?php

// app/Http/Controllers/QuoteController.php

namespace App\Http\Controllers;

use App\Models\Quote;
use Illuminate\Http\Request;


class QuoteController extends Controller
{
    public function index()
    {
        $quotes = Quote::paginate(20);

        return view('admin.quotes.index', compact('quotes'));
    }


    // Show the form to create a new quote
    public function create()
    {
        return view('admin.quotes.create');
    }

    // Store a newly created quote
    public function store(Request $request)
    {
        $request->validate([
            'quote' => 'required|string|max:255',
            'author' => 'nullable|string|max:100',
        ]);

        Quote::create($request->only('quote', 'author'));

        return redirect()->route('admin.quotes.index')->with('success', 'Quote created successfully');
    }

    // Show the form to edit an existing quote
    public function edit(Quote $quote)
    {
        return view('admin.quotes.edit', compact('quote'));
    }

    // Update the specified quote
    public function update(Request $request, Quote $quote)
    {
        $request->validate([
            'quote' => 'required|string|max:255',
            'author' => 'nullable|string|max:100',
        ]);

        $quote->update($request->only('quote', 'author'));

        return redirect()->route('admin.quotes.index')->with('success', 'Quote updated successfully');
    }

    // Delete the specified quote
    public function destroy(Quote $quote)
    {
        $quote->delete();

        return redirect()->route('admin.quotes.index')->with('success', 'Quote deleted successfully');
    }
}
