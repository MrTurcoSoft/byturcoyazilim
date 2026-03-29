<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Service;
use Illuminate\Http\Request;

class ServiceController extends Controller
{
    public function index()
    {
        $services = Service::ordered()->get();
        return view('admin.services.index', compact('services'));
    }

    public function create()
    {
        return view('admin.services.form');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title_tr' => 'required|string|max:255',
            'title_en' => 'nullable|string|max:255',
            'description_tr' => 'required|string',
            'description_en' => 'nullable|string',
            'features_tr' => 'nullable|string',
            'features_en' => 'nullable|string',
            'icon' => 'nullable|string|max:100',
            'image' => 'nullable|string|max:255',
            'order' => 'nullable|integer',
            'is_active' => 'boolean',
        ]);

        Service::create([
            'title' => ['tr' => $validated['title_tr'], 'en' => $validated['title_en'] ?? ''],
            'description' => ['tr' => $validated['description_tr'], 'en' => $validated['description_en'] ?? ''],
            'features' => [
                'tr' => array_filter(explode("\n", $validated['features_tr'] ?? '')),
                'en' => array_filter(explode("\n", $validated['features_en'] ?? ''))
            ],
            'icon' => $validated['icon'] ?? '',
            'image' => $validated['image'] ?? '',
            'order' => $validated['order'] ?? 0,
            'is_active' => $request->boolean('is_active'),
        ]);

        return redirect()->route('admin.services.index')->with('success', 'Hizmet başarıyla oluşturuldu.');
    }

    public function edit(Service $service)
    {
        return view('admin.services.form', compact('service'));
    }

    public function update(Request $request, Service $service)
    {
        $validated = $request->validate([
            'title_tr' => 'required|string|max:255',
            'title_en' => 'nullable|string|max:255',
            'description_tr' => 'required|string',
            'description_en' => 'nullable|string',
            'features_tr' => 'nullable|string',
            'features_en' => 'nullable|string',
            'icon' => 'nullable|string|max:100',
            'image' => 'nullable|string|max:255',
            'order' => 'nullable|integer',
            'is_active' => 'boolean',
        ]);

        $service->update([
            'title' => ['tr' => $validated['title_tr'], 'en' => $validated['title_en'] ?? ''],
            'description' => ['tr' => $validated['description_tr'], 'en' => $validated['description_en'] ?? ''],
            'features' => [
                'tr' => array_filter(explode("\n", $validated['features_tr'] ?? '')),
                'en' => array_filter(explode("\n", $validated['features_en'] ?? ''))
            ],
            'icon' => $validated['icon'] ?? '',
            'image' => $validated['image'] ?? '',
            'order' => $validated['order'] ?? 0,
            'is_active' => $request->boolean('is_active'),
        ]);

        return redirect()->route('admin.services.index')->with('success', 'Hizmet başarıyla güncellendi.');
    }

    public function destroy(Service $service)
    {
        $service->delete();
        return redirect()->route('admin.services.index')->with('success', 'Hizmet başarıyla silindi.');
    }
}
