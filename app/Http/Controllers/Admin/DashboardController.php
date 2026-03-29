<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Contact;
use App\Models\Quote;
use App\Models\BlogPost;
use App\Models\Reference;
use App\Models\Service;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $stats = [
            'contacts' => Contact::count(),
            'new_contacts' => Contact::where('status', 'new')->count(),
            'quotes' => Quote::count(),
            'pending_quotes' => Quote::where('status', 'pending')->count(),
            'services' => Service::count(),
            'references' => Reference::count(),
            'blog_posts' => BlogPost::count(),
        ];

        $recentContacts = Contact::latest()->take(5)->get();
        $recentQuotes = Quote::latest()->take(5)->get();

        return view('admin.dashboard', compact('stats', 'recentContacts', 'recentQuotes'));
    }
}
