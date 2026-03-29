<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Admin - {{ \App\Models\Setting::get('site_name', 'Dijital Ajans') }}</title>
    
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    
    <style>
        body { font-family: 'Inter', sans-serif; }
    </style>
</head>
<body class="bg-gray-50 dark:bg-gray-900 text-gray-900 dark:text-gray-100 min-h-screen">
    <div class="flex">
        <!-- Sidebar -->
        <aside class="fixed left-0 top-0 h-screen w-64 bg-white dark:bg-gray-800 border-r border-gray-200 dark:border-gray-700 z-50">
            <div class="p-6 border-b border-gray-200 dark:border-gray-700">
                <a href="{{ route('admin.dashboard') }}" class="text-xl font-bold text-blue-600">Admin Panel</a>
            </div>
            
            <nav class="p-4 space-y-2">
                <a href="{{ route('admin.dashboard') }}" class="flex items-center px-4 py-2 rounded-lg {{ request()->routeIs('admin.dashboard') ? 'bg-blue-50 text-blue-600 dark:bg-blue-900/30' : 'hover:bg-gray-100 dark:hover:bg-gray-700' }}" data-testid="nav-dashboard">
                    <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/>
                    </svg>
                    Dashboard
                </a>
                
                <a href="{{ route('admin.services.index') }}" class="flex items-center px-4 py-2 rounded-lg {{ request()->routeIs('admin.services.*') ? 'bg-blue-50 text-blue-600 dark:bg-blue-900/30' : 'hover:bg-gray-100 dark:hover:bg-gray-700' }}" data-testid="nav-services">
                    <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"/>
                    </svg>
                    Hizmetler
                </a>
                
                <a href="{{ route('admin.references.index') }}" class="flex items-center px-4 py-2 rounded-lg {{ request()->routeIs('admin.references.*') ? 'bg-blue-50 text-blue-600 dark:bg-blue-900/30' : 'hover:bg-gray-100 dark:hover:bg-gray-700' }}" data-testid="nav-references">
                    <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                    </svg>
                    Referanslar
                </a>
                
                <a href="{{ route('admin.blog.index') }}" class="flex items-center px-4 py-2 rounded-lg {{ request()->routeIs('admin.blog.*') ? 'bg-blue-50 text-blue-600 dark:bg-blue-900/30' : 'hover:bg-gray-100 dark:hover:bg-gray-700' }}" data-testid="nav-blog">
                    <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z"/>
                    </svg>
                    Blog
                </a>
                
                <a href="{{ route('admin.contacts.index') }}" class="flex items-center px-4 py-2 rounded-lg {{ request()->routeIs('admin.contacts.*') ? 'bg-blue-50 text-blue-600 dark:bg-blue-900/30' : 'hover:bg-gray-100 dark:hover:bg-gray-700' }}" data-testid="nav-contacts">
                    <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                    </svg>
                    Mesajlar
                    @php $newContacts = \App\Models\Contact::where('status', 'new')->count(); @endphp
                    @if($newContacts > 0)
                    <span class="ml-auto bg-red-500 text-white text-xs px-2 py-0.5 rounded-full">{{ $newContacts }}</span>
                    @endif
                </a>
                
                <a href="{{ route('admin.quotes.index') }}" class="flex items-center px-4 py-2 rounded-lg {{ request()->routeIs('admin.quotes.*') ? 'bg-blue-50 text-blue-600 dark:bg-blue-900/30' : 'hover:bg-gray-100 dark:hover:bg-gray-700' }}" data-testid="nav-quotes">
                    <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01"/>
                    </svg>
                    Teklifler
                    @php $pendingQuotes = \App\Models\Quote::where('status', 'pending')->count(); @endphp
                    @if($pendingQuotes > 0)
                    <span class="ml-auto bg-orange-500 text-white text-xs px-2 py-0.5 rounded-full">{{ $pendingQuotes }}</span>
                    @endif
                </a>
                
                <a href="{{ route('admin.settings.index') }}" class="flex items-center px-4 py-2 rounded-lg {{ request()->routeIs('admin.settings.*') ? 'bg-blue-50 text-blue-600 dark:bg-blue-900/30' : 'hover:bg-gray-100 dark:hover:bg-gray-700' }}" data-testid="nav-settings">
                    <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"/>
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                    </svg>
                    Ayarlar
                </a>
                
                <a href="{{ route('admin.seo.index') }}" class="flex items-center px-4 py-2 rounded-lg {{ request()->routeIs('admin.seo.*') ? 'bg-blue-50 text-blue-600 dark:bg-blue-900/30' : 'hover:bg-gray-100 dark:hover:bg-gray-700' }}" data-testid="nav-seo">
                    <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                    </svg>
                    SEO
                </a>
            </nav>
            
            <div class="absolute bottom-0 left-0 right-0 p-4 border-t border-gray-200 dark:border-gray-700">
                <div class="flex items-center justify-between">
                    <div class="flex items-center">
                        <div class="w-8 h-8 rounded-full bg-blue-500 flex items-center justify-center text-white text-sm font-medium">
                            {{ substr(auth()->user()->name ?? 'A', 0, 1) }}
                        </div>
                        <span class="ml-3 text-sm font-medium">{{ auth()->user()->name ?? 'Admin' }}</span>
                    </div>
                    <form action="{{ route('logout') }}" method="POST">
                        @csrf
                        <button type="submit" class="p-2 text-gray-500 hover:text-red-500" data-testid="logout-btn">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"/>
                            </svg>
                        </button>
                    </form>
                </div>
                <a href="{{ route('home') }}" target="_blank" class="mt-3 flex items-center text-sm text-gray-500 hover:text-blue-600">
                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"/>
                    </svg>
                    Siteyi Görüntüle
                </a>
            </div>
        </aside>
        
        <!-- Main Content -->
        <main class="ml-64 flex-1 min-h-screen">
            <header class="bg-white dark:bg-gray-800 border-b border-gray-200 dark:border-gray-700 px-8 py-4">
                <h1 class="text-xl font-semibold">@yield('header', 'Dashboard')</h1>
            </header>
            
            <div class="p-8">
                @if(session('success'))
                <div class="mb-6 p-4 bg-green-50 dark:bg-green-900/20 border border-green-200 dark:border-green-800 rounded-lg text-green-600 dark:text-green-400" data-testid="success-alert">
                    {{ session('success') }}
                </div>
                @endif
                
                @if(session('error'))
                <div class="mb-6 p-4 bg-red-50 dark:bg-red-900/20 border border-red-200 dark:border-red-800 rounded-lg text-red-600 dark:text-red-400" data-testid="error-alert">
                    {{ session('error') }}
                </div>
                @endif
                
                @yield('content')
            </div>
        </main>
    </div>
</body>
</html>
