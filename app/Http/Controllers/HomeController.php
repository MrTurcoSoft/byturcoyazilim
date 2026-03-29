<?php

namespace App\Http\Controllers;

use App\Models\Service;
use App\Models\Reference;
use App\Models\BlogPost;
use App\Models\Setting;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $services = Service::active()->ordered()->take(6)->get();
        $references = Reference::active()->ordered()->take(6)->get();
        $blogPosts = BlogPost::published()->latest('published_at')->take(3)->get();
        
        return view('home', compact('services', 'references', 'blogPosts'));
    }

    public function about()
    {
        return view('about');
    }

    public function services()
    {
        $services = Service::active()->ordered()->get();
        return view('services', compact('services'));
    }

    public function serviceDetail($id)
    {
        $service = Service::findOrFail($id);
        return view('service-detail', compact('service'));
    }

    public function references()
    {
        $references = Reference::active()->ordered()->get();
        return view('references', compact('references'));
    }

    public function referenceDetail($id)
    {
        $reference = Reference::findOrFail($id);
        return view('reference-detail', compact('reference'));
    }

    public function blog()
    {
        $posts = BlogPost::published()->latest('published_at')->paginate(9);
        return view('blog', compact('posts'));
    }

    public function blogPost($slug)
    {
        $locale = app()->getLocale();
        $post = BlogPost::published()->get()->first(function ($p) use ($slug, $locale) {
            return ($p->slug[$locale] ?? $p->slug['tr'] ?? '') === $slug;
        });
        
        if (!$post) {
            abort(404);
        }
        
        $relatedPosts = BlogPost::published()
            ->where('id', '!=', $post->id)
            ->where('category', $post->category)
            ->take(3)
            ->get();
            
        return view('blog-post', compact('post', 'relatedPosts'));
    }

    public function contact()
    {
        return view('contact');
    }

    public function quote()
    {
        $services = Service::active()->ordered()->get();
        return view('quote', compact('services'));
    }

    public function setLocale($locale)
    {
        if (in_array($locale, ['tr', 'en'])) {
            session(['locale' => $locale]);
        }
        return redirect()->back();
    }
}
