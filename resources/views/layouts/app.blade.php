<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="{{ \App\Models\Setting::get('theme_mode', 'dark') }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    
    @php
        $seo = \App\Models\SeoSetting::getForPage($seoPage ?? 'home');
        $siteName = \App\Models\Setting::get('site_name', 'Dijital Ajans');
    @endphp
    
    <title>@yield('title', $seo['title'] ?: $siteName)</title>
    <meta name="description" content="@yield('description', $seo['description'] ?: \App\Models\Setting::get('site_description', 'Profesyonel web tasarım ve yazılım çözümleri'))">
    @if($seo['keywords'])
    <meta name="keywords" content="{{ $seo['keywords'] }}">
    @endif
    
    <!-- Open Graph -->
    <meta property="og:title" content="@yield('title', $seo['title'] ?: $siteName)">
    <meta property="og:description" content="@yield('description', $seo['description'] ?: \App\Models\Setting::get('site_description', ''))">
    <meta property="og:type" content="website">
    <meta property="og:url" content="{{ url()->current() }}">
    @if($seo['og_image'])
    <meta property="og:image" content="{{ $seo['og_image'] }}">
    @endif
    
    <!-- Twitter Card -->
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:title" content="@yield('title', $seo['title'] ?: $siteName)">
    <meta name="twitter:description" content="@yield('description', $seo['description'] ?: \App\Models\Setting::get('site_description', ''))">
    @if($seo['og_image'])
    <meta name="twitter:image" content="{{ $seo['og_image'] }}">
    @endif
    
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;500;600;700&family=Inter:wght@300;400;500;600&display=swap" rel="stylesheet">
    
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    
    <style>
        :root {
            --font-heading: 'Outfit', sans-serif;
            --font-body: 'Inter', sans-serif;
        }
        
        .light {
            --background: #FFFFFF;
            --foreground: #09090B;
            --primary: #0055FF;
            --primary-foreground: #FFFFFF;
            --secondary: #F4F4F5;
            --secondary-foreground: #18181B;
            --muted: #F4F4F5;
            --muted-foreground: #71717A;
            --accent: #F4F4F5;
            --border: #E4E4E7;
            --card: #FFFFFF;
            --card-foreground: #09090B;
        }
        
        .dark {
            --background: #09090B;
            --foreground: #FAFAFA;
            --primary: #3B82F6;
            --primary-foreground: #FFFFFF;
            --secondary: #27272A;
            --secondary-foreground: #FAFAFA;
            --muted: #27272A;
            --muted-foreground: #A1A1AA;
            --accent: #27272A;
            --border: #27272A;
            --card: #18181B;
            --card-foreground: #FAFAFA;
        }
        
        body {
            font-family: var(--font-body);
            background-color: var(--background);
            color: var(--foreground);
        }
        
        h1, h2, h3, h4, h5, h6 {
            font-family: var(--font-heading);
        }
    </style>
</head>
<body class="min-h-screen antialiased">
    <!-- Navigation -->
    <nav class="fixed top-0 left-0 right-0 z-50 backdrop-blur-xl bg-[var(--background)]/80 border-b border-[var(--border)]">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-center h-16 lg:h-20">
                <!-- Logo -->
                <a href="{{ route('home') }}" class="flex items-center space-x-2" data-testid="logo-link">
                    <span class="text-xl lg:text-2xl font-bold tracking-tight" style="color: var(--primary)">
                        {{ \App\Models\Setting::get('site_name', 'DigiAgency') }}
                    </span>
                </a>

                <!-- Desktop Navigation -->
                <div class="hidden lg:flex items-center space-x-8">
                    <a href="{{ route('home') }}" class="text-sm font-medium hover:text-[var(--primary)] transition-colors" data-testid="nav-home">
                        {{ __('messages.home') }}
                    </a>
                    <a href="{{ route('about') }}" class="text-sm font-medium hover:text-[var(--primary)] transition-colors" data-testid="nav-about">
                        {{ __('messages.about') }}
                    </a>
                    <a href="{{ route('services') }}" class="text-sm font-medium hover:text-[var(--primary)] transition-colors" data-testid="nav-services">
                        {{ __('messages.services') }}
                    </a>
                    <a href="{{ route('references') }}" class="text-sm font-medium hover:text-[var(--primary)] transition-colors" data-testid="nav-references">
                        {{ __('messages.references') }}
                    </a>
                    <a href="{{ route('blog') }}" class="text-sm font-medium hover:text-[var(--primary)] transition-colors" data-testid="nav-blog">
                        {{ __('messages.blog') }}
                    </a>
                    <a href="{{ route('contact') }}" class="text-sm font-medium hover:text-[var(--primary)] transition-colors" data-testid="nav-contact">
                        {{ __('messages.contact') }}
                    </a>
                </div>

                <!-- Right Side -->
                <div class="flex items-center space-x-4">
                    <!-- Language Switcher -->
                    <div class="flex items-center space-x-2">
                        <a href="{{ route('locale', 'tr') }}" class="text-xs font-medium px-2 py-1 rounded {{ app()->getLocale() == 'tr' ? 'bg-[var(--primary)] text-white' : 'hover:bg-[var(--secondary)]' }}" data-testid="lang-tr">TR</a>
                        <a href="{{ route('locale', 'en') }}" class="text-xs font-medium px-2 py-1 rounded {{ app()->getLocale() == 'en' ? 'bg-[var(--primary)] text-white' : 'hover:bg-[var(--secondary)]' }}" data-testid="lang-en">EN</a>
                    </div>
                    
                    <!-- Theme Toggle -->
                    <button id="theme-toggle" class="p-2 rounded-lg hover:bg-[var(--secondary)] transition-colors" data-testid="theme-toggle">
                        <svg class="w-5 h-5 hidden dark:block" fill="currentColor" viewBox="0 0 20 20">
                            <path d="M10 2a1 1 0 011 1v1a1 1 0 11-2 0V3a1 1 0 011-1zm4 8a4 4 0 11-8 0 4 4 0 018 0zm-.464 4.95l.707.707a1 1 0 001.414-1.414l-.707-.707a1 1 0 00-1.414 1.414zm2.12-10.607a1 1 0 010 1.414l-.706.707a1 1 0 11-1.414-1.414l.707-.707a1 1 0 011.414 0zM17 11a1 1 0 100-2h-1a1 1 0 100 2h1zm-7 4a1 1 0 011 1v1a1 1 0 11-2 0v-1a1 1 0 011-1zM5.05 6.464A1 1 0 106.465 5.05l-.708-.707a1 1 0 00-1.414 1.414l.707.707zm1.414 8.486l-.707.707a1 1 0 01-1.414-1.414l.707-.707a1 1 0 011.414 1.414zM4 11a1 1 0 100-2H3a1 1 0 000 2h1z"/>
                        </svg>
                        <svg class="w-5 h-5 block dark:hidden" fill="currentColor" viewBox="0 0 20 20">
                            <path d="M17.293 13.293A8 8 0 016.707 2.707a8.001 8.001 0 1010.586 10.586z"/>
                        </svg>
                    </button>

                    <!-- CTA Button -->
                    <a href="{{ route('quote') }}" class="hidden sm:inline-flex items-center px-4 py-2 rounded-full bg-[var(--primary)] text-white text-sm font-medium hover:opacity-90 transition-opacity" data-testid="cta-quote">
                        {{ __('messages.get_quote') }}
                    </a>

                    <!-- Mobile Menu Button -->
                    <button id="mobile-menu-btn" class="lg:hidden p-2 rounded-lg hover:bg-[var(--secondary)]" data-testid="mobile-menu-btn">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/>
                        </svg>
                    </button>
                </div>
            </div>
        </div>

        <!-- Mobile Menu -->
        <div id="mobile-menu" class="hidden lg:hidden border-t border-[var(--border)]">
            <div class="px-4 py-4 space-y-3">
                <a href="{{ route('home') }}" class="block py-2 text-sm font-medium hover:text-[var(--primary)]">{{ __('messages.home') }}</a>
                <a href="{{ route('about') }}" class="block py-2 text-sm font-medium hover:text-[var(--primary)]">{{ __('messages.about') }}</a>
                <a href="{{ route('services') }}" class="block py-2 text-sm font-medium hover:text-[var(--primary)]">{{ __('messages.services') }}</a>
                <a href="{{ route('references') }}" class="block py-2 text-sm font-medium hover:text-[var(--primary)]">{{ __('messages.references') }}</a>
                <a href="{{ route('blog') }}" class="block py-2 text-sm font-medium hover:text-[var(--primary)]">{{ __('messages.blog') }}</a>
                <a href="{{ route('contact') }}" class="block py-2 text-sm font-medium hover:text-[var(--primary)]">{{ __('messages.contact') }}</a>
                <a href="{{ route('quote') }}" class="block py-2 px-4 rounded-full bg-[var(--primary)] text-white text-sm font-medium text-center">{{ __('messages.get_quote') }}</a>
            </div>
        </div>
    </nav>

    <!-- Main Content -->
    <main class="pt-16 lg:pt-20">
        @yield('content')
    </main>

    <!-- Footer -->
    <footer class="bg-[var(--secondary)] border-t border-[var(--border)]">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12 lg:py-16">
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8 lg:gap-12">
                <!-- Company Info -->
                <div class="lg:col-span-2">
                    <span class="text-2xl font-bold" style="color: var(--primary)">
                        {{ \App\Models\Setting::get('site_name', 'DigiAgency') }}
                    </span>
                    <p class="mt-4 text-sm" style="color: var(--muted-foreground)">
                        {{ \App\Models\Setting::get('site_description', 'Profesyonel web tasarım, yazılım ve dijital pazarlama çözümleri sunuyoruz.') }}
                    </p>
                    <div class="mt-6 flex space-x-4">
                        @if(\App\Models\Setting::get('social_facebook'))
                        <a href="{{ \App\Models\Setting::get('social_facebook') }}" class="text-[var(--muted-foreground)] hover:text-[var(--primary)]" target="_blank" data-testid="social-facebook">
                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24"><path d="M24 12.073c0-6.627-5.373-12-12-12s-12 5.373-12 12c0 5.99 4.388 10.954 10.125 11.854v-8.385H7.078v-3.47h3.047V9.43c0-3.007 1.792-4.669 4.533-4.669 1.312 0 2.686.235 2.686.235v2.953H15.83c-1.491 0-1.956.925-1.956 1.874v2.25h3.328l-.532 3.47h-2.796v8.385C19.612 23.027 24 18.062 24 12.073z"/></svg>
                        </a>
                        @endif
                        @if(\App\Models\Setting::get('social_instagram'))
                        <a href="{{ \App\Models\Setting::get('social_instagram') }}" class="text-[var(--muted-foreground)] hover:text-[var(--primary)]" target="_blank" data-testid="social-instagram">
                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24"><path d="M12.017 0C5.396 0 .029 5.367.029 11.987c0 5.079 3.158 9.417 7.618 11.162-.105-.949-.199-2.403.041-3.439.219-.937 1.406-5.957 1.406-5.957s-.359-.72-.359-1.781c0-1.663.967-2.911 2.168-2.911 1.024 0 1.518.769 1.518 1.688 0 1.029-.653 2.567-.992 3.992-.285 1.193.6 2.165 1.775 2.165 2.128 0 3.768-2.245 3.768-5.487 0-2.861-2.063-4.869-5.008-4.869-3.41 0-5.409 2.562-5.409 5.199 0 1.033.394 2.143.889 2.741.099.12.112.225.085.345-.09.375-.293 1.199-.334 1.363-.053.225-.172.271-.401.165-1.495-.69-2.433-2.878-2.433-4.646 0-3.776 2.748-7.252 7.92-7.252 4.158 0 7.392 2.967 7.392 6.923 0 4.135-2.607 7.462-6.233 7.462-1.214 0-2.354-.629-2.758-1.379l-.749 2.848c-.269 1.045-1.004 2.352-1.498 3.146 1.123.345 2.306.535 3.55.535 6.607 0 11.985-5.365 11.985-11.987C23.97 5.39 18.592.026 11.985.026L12.017 0z"/></svg>
                        </a>
                        @endif
                        @if(\App\Models\Setting::get('social_linkedin'))
                        <a href="{{ \App\Models\Setting::get('social_linkedin') }}" class="text-[var(--muted-foreground)] hover:text-[var(--primary)]" target="_blank" data-testid="social-linkedin">
                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24"><path d="M20.447 20.452h-3.554v-5.569c0-1.328-.027-3.037-1.852-3.037-1.853 0-2.136 1.445-2.136 2.939v5.667H9.351V9h3.414v1.561h.046c.477-.9 1.637-1.85 3.37-1.85 3.601 0 4.267 2.37 4.267 5.455v6.286zM5.337 7.433c-1.144 0-2.063-.926-2.063-2.065 0-1.138.92-2.063 2.063-2.063 1.14 0 2.064.925 2.064 2.063 0 1.139-.925 2.065-2.064 2.065zm1.782 13.019H3.555V9h3.564v11.452zM22.225 0H1.771C.792 0 0 .774 0 1.729v20.542C0 23.227.792 24 1.771 24h20.451C23.2 24 24 23.227 24 22.271V1.729C24 .774 23.2 0 22.222 0h.003z"/></svg>
                        </a>
                        @endif
                    </div>
                </div>

                <!-- Quick Links -->
                <div>
                    <h4 class="text-sm font-semibold uppercase tracking-wider mb-4">{{ __('messages.quick_links') }}</h4>
                    <ul class="space-y-3">
                        <li><a href="{{ route('services') }}" class="text-sm text-[var(--muted-foreground)] hover:text-[var(--primary)]">{{ __('messages.services') }}</a></li>
                        <li><a href="{{ route('references') }}" class="text-sm text-[var(--muted-foreground)] hover:text-[var(--primary)]">{{ __('messages.references') }}</a></li>
                        <li><a href="{{ route('blog') }}" class="text-sm text-[var(--muted-foreground)] hover:text-[var(--primary)]">{{ __('messages.blog') }}</a></li>
                        <li><a href="{{ route('about') }}" class="text-sm text-[var(--muted-foreground)] hover:text-[var(--primary)]">{{ __('messages.about') }}</a></li>
                    </ul>
                </div>

                <!-- Contact Info -->
                <div>
                    <h4 class="text-sm font-semibold uppercase tracking-wider mb-4">{{ __('messages.contact') }}</h4>
                    <ul class="space-y-3 text-sm text-[var(--muted-foreground)]">
                        @if(\App\Models\Setting::get('contact_phone'))
                        <li>{{ \App\Models\Setting::get('contact_phone') }}</li>
                        @endif
                        @if(\App\Models\Setting::get('contact_email'))
                        <li>{{ \App\Models\Setting::get('contact_email') }}</li>
                        @endif
                        @if(\App\Models\Setting::get('contact_address'))
                        <li>{{ \App\Models\Setting::get('contact_address') }}</li>
                        @endif
                    </ul>
                </div>
            </div>

            <div class="mt-12 pt-8 border-t border-[var(--border)]">
                <p class="text-sm text-center text-[var(--muted-foreground)]">
                    &copy; {{ date('Y') }} {{ \App\Models\Setting::get('site_name', 'DigiAgency') }}. {{ __('messages.all_rights_reserved') }}
                </p>
            </div>
        </div>
    </footer>

    <script>
        // Theme Toggle
        const themeToggle = document.getElementById('theme-toggle');
        const html = document.documentElement;
        
        themeToggle.addEventListener('click', () => {
            html.classList.toggle('dark');
            html.classList.toggle('light');
            localStorage.setItem('theme', html.classList.contains('dark') ? 'dark' : 'light');
        });
        
        // Load saved theme
        const savedTheme = localStorage.getItem('theme');
        if (savedTheme) {
            html.classList.remove('dark', 'light');
            html.classList.add(savedTheme);
        }

        // Mobile Menu
        const mobileMenuBtn = document.getElementById('mobile-menu-btn');
        const mobileMenu = document.getElementById('mobile-menu');
        
        mobileMenuBtn.addEventListener('click', () => {
            mobileMenu.classList.toggle('hidden');
        });
    </script>
</body>
</html>
