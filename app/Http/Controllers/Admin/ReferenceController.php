<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Reference;
use Illuminate\Http\Request;

class ReferenceController extends Controller
{
    public function index()
    {
        $references = Reference::ordered()->get();
        return view('admin.references.index', compact('references'));
    }

    public function create()
    {
        return view('admin.references.form');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title_tr' => 'required|string|max:255',
            'title_en' => 'nullable|string|max:255',
            'description_tr' => 'nullable|string',
            'description_en' => 'nullable|string',
            'client_name' => 'required|string|max:255',
            'client_logo' => 'nullable|string|max:255',
            'image' => 'required|string|max:255',
            'url' => 'nullable|url|max:255',
            'category' => 'nullable|string|max:100',
            'order' => 'nullable|integer',
            'is_active' => 'boolean',
        ]);

        Reference::create([
            'title' => ['tr' => $validated['title_tr'], 'en' => $validated['title_en'] ?? ''],
            'description' => ['tr' => $validated['description_tr'] ?? '', 'en' => $validated['description_en'] ?? ''],
            'client_name' => $validated['client_name'],
            'client_logo' => $validated['client_logo'] ?? '',
            'image' => $validated['image'],
            'url' => $validated['url'] ?? '',
            'category' => $validated['category'] ?? '',
            'order' => $validated['order'] ?? 0,
            'is_active' => $request->boolean('is_active'),
        ]);

        return redirect()->route('admin.references.index')->with('success', 'Referans başarıyla oluşturuldu.');
    }

    public function edit(Reference $reference)
    {
        return view('admin.references.form', compact('reference'));
    }

    public function update(Request $request, Reference $reference)
    {
        $validated = $request->validate([
            'title_tr' => 'required|string|max:255',
            'title_en' => 'nullable|string|max:255',
            'description_tr' => 'nullable|string',
            'description_en' => 'nullable|string',
            'client_name' => 'required|string|max:255',
            'client_logo' => 'nullable|string|max:255',
            'image' => 'required|string|max:255',
            'url' => 'nullable|url|max:255',
            'category' => 'nullable|string|max:100',
            'order' => 'nullable|integer',
            'is_active' => 'boolean',
        ]);

        $reference->update([
            'title' => ['tr' => $validated['title_tr'], 'en' => $validated['title_en'] ?? ''],
            'description' => ['tr' => $validated['description_tr'] ?? '', 'en' => $validated['description_en'] ?? ''],
            'client_name' => $validated['client_name'],
            'client_logo' => $validated['client_logo'] ?? '',
            'image' => $validated['image'],
            'url' => $validated['url'] ?? '',
            'category' => $validated['category'] ?? '',
            'order' => $validated['order'] ?? 0,
            'is_active' => $request->boolean('is_active'),
        ]);

        return redirect()->route('admin.references.index')->with('success', 'Referans başarıyla güncellendi.');
    }

    public function destroy(Reference $reference)
    {
        $reference->delete();
        return redirect()->route('admin.references.index')->with('success', 'Referans başarıyla silindi.');
    }
}
