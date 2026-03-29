<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Quote;
use Illuminate\Http\Request;

class QuoteController extends Controller
{
    public function index()
    {
        $quotes = Quote::latest()->paginate(20);
        return view('admin.quotes.index', compact('quotes'));
    }

    public function show(Quote $quote)
    {
        return view('admin.quotes.show', compact('quote'));
    }

    public function update(Request $request, Quote $quote)
    {
        $validated = $request->validate([
            'status' => 'required|in:pending,reviewing,quoted,accepted,rejected',
            'admin_notes' => 'nullable|string',
            'quoted_amount' => 'nullable|numeric|min:0',
        ]);

        $quote->update($validated);

        return back()->with('success', 'Teklif güncellendi.');
    }

    public function destroy(Quote $quote)
    {
        $quote->delete();
        return redirect()->route('admin.quotes.index')->with('success', 'Teklif silindi.');
    }
}
