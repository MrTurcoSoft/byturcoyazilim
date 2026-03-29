<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\BlogPost;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class BlogController extends Controller
{
    public function index()
    {
        $posts = BlogPost::latest()->get();
        return view('admin.blog.index', compact('posts'));
    }

    public function create()
    {
        return view('admin.blog.form');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title_tr' => 'required|string|max:255',
            'title_en' => 'nullable|string|max:255',
            'excerpt_tr' => 'nullable|string',
            'excerpt_en' => 'nullable|string',
            'content_tr' => 'required|string',
            'content_en' => 'nullable|string',
            'image' => 'nullable|string|max:255',
            'category' => 'nullable|string|max:100',
            'tags' => 'nullable|string',
            'is_published' => 'boolean',
        ]);

        BlogPost::create([
            'title' => ['tr' => $validated['title_tr'], 'en' => $validated['title_en'] ?? ''],
            'slug' => ['tr' => Str::slug($validated['title_tr']), 'en' => Str::slug($validated['title_en'] ?? $validated['title_tr'])],
            'excerpt' => ['tr' => $validated['excerpt_tr'] ?? '', 'en' => $validated['excerpt_en'] ?? ''],
            'content' => ['tr' => $validated['content_tr'], 'en' => $validated['content_en'] ?? ''],
            'image' => $validated['image'] ?? '',
            'category' => $validated['category'] ?? '',
            'tags' => array_filter(array_map('trim', explode(',', $validated['tags'] ?? ''))),
            'user_id' => auth()->id(),
            'is_published' => $request->boolean('is_published'),
            'published_at' => $request->boolean('is_published') ? now() : null,
        ]);

        return redirect()->route('admin.blog.index')->with('success', 'Blog yazısı başarıyla oluşturuldu.');
    }

    public function edit(BlogPost $blog)
    {
        return view('admin.blog.form', ['post' => $blog]);
    }

    public function update(Request $request, BlogPost $blog)
    {
        $validated = $request->validate([
            'title_tr' => 'required|string|max:255',
            'title_en' => 'nullable|string|max:255',
            'excerpt_tr' => 'nullable|string',
            'excerpt_en' => 'nullable|string',
            'content_tr' => 'required|string',
            'content_en' => 'nullable|string',
            'image' => 'nullable|string|max:255',
            'category' => 'nullable|string|max:100',
            'tags' => 'nullable|string',
            'is_published' => 'boolean',
        ]);

        $wasPublished = $blog->is_published;
        $isPublished = $request->boolean('is_published');

        $blog->update([
            'title' => ['tr' => $validated['title_tr'], 'en' => $validated['title_en'] ?? ''],
            'slug' => ['tr' => Str::slug($validated['title_tr']), 'en' => Str::slug($validated['title_en'] ?? $validated['title_tr'])],
            'excerpt' => ['tr' => $validated['excerpt_tr'] ?? '', 'en' => $validated['excerpt_en'] ?? ''],
            'content' => ['tr' => $validated['content_tr'], 'en' => $validated['content_en'] ?? ''],
            'image' => $validated['image'] ?? '',
            'category' => $validated['category'] ?? '',
            'tags' => array_filter(array_map('trim', explode(',', $validated['tags'] ?? ''))),
            'is_published' => $isPublished,
            'published_at' => !$wasPublished && $isPublished ? now() : $blog->published_at,
        ]);

        return redirect()->route('admin.blog.index')->with('success', 'Blog yazısı başarıyla güncellendi.');
    }

    public function destroy(BlogPost $blog)
    {
        $blog->delete();
        return redirect()->route('admin.blog.index')->with('success', 'Blog yazısı başarıyla silindi.');
    }
}
