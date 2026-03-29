@extends('layouts.app')

@section('title', __('messages.contact') . ' - ' . \App\Models\Setting::get('site_name', 'Dijital Ajans'))

@section('content')
<!-- Hero Section -->
<section class="relative py-20 lg:py-32 bg-[var(--secondary)]">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center">
            <p class="text-xs font-bold uppercase tracking-[0.2em] text-[var(--primary)] mb-4">{{ __('messages.contact') }}</p>
            <h1 class="text-4xl sm:text-5xl lg:text-6xl font-semibold tracking-tighter mb-6" data-testid="contact-title">
                {{ __('messages.contact_title') }}
            </h1>
            <p class="text-lg text-[var(--muted-foreground)] max-w-2xl mx-auto">
                {{ __('messages.contact_description') }}
            </p>
        </div>
    </div>
</section>

<!-- Contact Content -->
<section class="py-20 lg:py-32">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 lg:gap-20">
            <!-- Contact Info -->
            <div>
                <h2 class="text-2xl font-semibold mb-8">{{ __('messages.contact_info') }}</h2>
                
                <div class="space-y-6">
                    @if(\App\Models\Setting::get('contact_phone'))
                    <div class="flex items-start space-x-4">
                        <div class="w-12 h-12 rounded-lg bg-[var(--primary)]/10 flex items-center justify-center text-[var(--primary)] flex-shrink-0">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/>
                            </svg>
                        </div>
                        <div>
                            <h3 class="font-medium mb-1">Telefon</h3>
                            <a href="tel:{{ \App\Models\Setting::get('contact_phone') }}" class="text-[var(--muted-foreground)] hover:text-[var(--primary)]">
                                {{ \App\Models\Setting::get('contact_phone') }}
                            </a>
                        </div>
                    </div>
                    @endif
                    
                    @if(\App\Models\Setting::get('contact_email'))
                    <div class="flex items-start space-x-4">
                        <div class="w-12 h-12 rounded-lg bg-[var(--primary)]/10 flex items-center justify-center text-[var(--primary)] flex-shrink-0">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                            </svg>
                        </div>
                        <div>
                            <h3 class="font-medium mb-1">E-posta</h3>
                            <a href="mailto:{{ \App\Models\Setting::get('contact_email') }}" class="text-[var(--muted-foreground)] hover:text-[var(--primary)]">
                                {{ \App\Models\Setting::get('contact_email') }}
                            </a>
                        </div>
                    </div>
                    @endif
                    
                    @if(\App\Models\Setting::get('contact_address'))
                    <div class="flex items-start space-x-4">
                        <div class="w-12 h-12 rounded-lg bg-[var(--primary)]/10 flex items-center justify-center text-[var(--primary)] flex-shrink-0">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/>
                            </svg>
                        </div>
                        <div>
                            <h3 class="font-medium mb-1">Adres</h3>
                            <p class="text-[var(--muted-foreground)]">
                                {{ \App\Models\Setting::get('contact_address') }}
                            </p>
                        </div>
                    </div>
                    @endif
                </div>
                
                <!-- Social Links -->
                <div class="mt-12">
                    <h3 class="font-medium mb-4">Sosyal Medya</h3>
                    <div class="flex space-x-4">
                        @if(\App\Models\Setting::get('social_facebook'))
                        <a href="{{ \App\Models\Setting::get('social_facebook') }}" target="_blank" class="w-10 h-10 rounded-lg bg-[var(--secondary)] flex items-center justify-center hover:bg-[var(--primary)] hover:text-white transition-colors" data-testid="social-facebook">
                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24"><path d="M24 12.073c0-6.627-5.373-12-12-12s-12 5.373-12 12c0 5.99 4.388 10.954 10.125 11.854v-8.385H7.078v-3.47h3.047V9.43c0-3.007 1.792-4.669 4.533-4.669 1.312 0 2.686.235 2.686.235v2.953H15.83c-1.491 0-1.956.925-1.956 1.874v2.25h3.328l-.532 3.47h-2.796v8.385C19.612 23.027 24 18.062 24 12.073z"/></svg>
                        </a>
                        @endif
                        @if(\App\Models\Setting::get('social_instagram'))
                        <a href="{{ \App\Models\Setting::get('social_instagram') }}" target="_blank" class="w-10 h-10 rounded-lg bg-[var(--secondary)] flex items-center justify-center hover:bg-[var(--primary)] hover:text-white transition-colors" data-testid="social-instagram">
                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24"><path d="M12 2.163c3.204 0 3.584.012 4.85.07 3.252.148 4.771 1.691 4.919 4.919.058 1.265.069 1.645.069 4.849 0 3.205-.012 3.584-.069 4.849-.149 3.225-1.664 4.771-4.919 4.919-1.266.058-1.644.07-4.85.07-3.204 0-3.584-.012-4.849-.07-3.26-.149-4.771-1.699-4.919-4.92-.058-1.265-.07-1.644-.07-4.849 0-3.204.013-3.583.07-4.849.149-3.227 1.664-4.771 4.919-4.919 1.266-.057 1.645-.069 4.849-.069zm0-2.163c-3.259 0-3.667.014-4.947.072-4.358.2-6.78 2.618-6.98 6.98-.059 1.281-.073 1.689-.073 4.948 0 3.259.014 3.668.072 4.948.2 4.358 2.618 6.78 6.98 6.98 1.281.058 1.689.072 4.948.072 3.259 0 3.668-.014 4.948-.072 4.354-.2 6.782-2.618 6.979-6.98.059-1.28.073-1.689.073-4.948 0-3.259-.014-3.667-.072-4.947-.196-4.354-2.617-6.78-6.979-6.98-1.281-.059-1.69-.073-4.949-.073zm0 5.838c-3.403 0-6.162 2.759-6.162 6.162s2.759 6.163 6.162 6.163 6.162-2.759 6.162-6.163c0-3.403-2.759-6.162-6.162-6.162zm0 10.162c-2.209 0-4-1.79-4-4 0-2.209 1.791-4 4-4s4 1.791 4 4c0 2.21-1.791 4-4 4zm6.406-11.845c-.796 0-1.441.645-1.441 1.44s.645 1.44 1.441 1.44c.795 0 1.439-.645 1.439-1.44s-.644-1.44-1.439-1.44z"/></svg>
                        </a>
                        @endif
                        @if(\App\Models\Setting::get('social_linkedin'))
                        <a href="{{ \App\Models\Setting::get('social_linkedin') }}" target="_blank" class="w-10 h-10 rounded-lg bg-[var(--secondary)] flex items-center justify-center hover:bg-[var(--primary)] hover:text-white transition-colors" data-testid="social-linkedin">
                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24"><path d="M20.447 20.452h-3.554v-5.569c0-1.328-.027-3.037-1.852-3.037-1.853 0-2.136 1.445-2.136 2.939v5.667H9.351V9h3.414v1.561h.046c.477-.9 1.637-1.85 3.37-1.85 3.601 0 4.267 2.37 4.267 5.455v6.286zM5.337 7.433c-1.144 0-2.063-.926-2.063-2.065 0-1.138.92-2.063 2.063-2.063 1.14 0 2.064.925 2.064 2.063 0 1.139-.925 2.065-2.064 2.065zm1.782 13.019H3.555V9h3.564v11.452zM22.225 0H1.771C.792 0 0 .774 0 1.729v20.542C0 23.227.792 24 1.771 24h20.451C23.2 24 24 23.227 24 22.271V1.729C24 .774 23.2 0 22.222 0h.003z"/></svg>
                        </a>
                        @endif
                    </div>
                </div>
            </div>
            
            <!-- Contact Form -->
            <div class="p-8 bg-[var(--card)] border border-[var(--border)] rounded-lg">
                @if(session('success'))
                <div class="mb-6 p-4 bg-green-500/10 border border-green-500/20 rounded-lg text-green-600 dark:text-green-400" data-testid="success-message">
                    {{ session('success') }}
                </div>
                @endif
                
                @if($errors->any())
                <div class="mb-6 p-4 bg-red-500/10 border border-red-500/20 rounded-lg text-red-600 dark:text-red-400">
                    <ul class="list-disc list-inside">
                        @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
                @endif
                
                <form action="{{ route('contact.submit') }}" method="POST" data-testid="contact-form">
                    @csrf
                    
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-6 mb-6">
                        <div>
                            <label for="name" class="block text-sm font-medium mb-2">{{ __('messages.name') }} *</label>
                            <input type="text" id="name" name="name" required value="{{ old('name') }}"
                                   class="w-full px-4 py-3 rounded-lg border border-[var(--border)] bg-[var(--background)] focus:outline-none focus:ring-2 focus:ring-[var(--primary)]"
                                   data-testid="contact-name">
                        </div>
                        <div>
                            <label for="email" class="block text-sm font-medium mb-2">{{ __('messages.email') }} *</label>
                            <input type="email" id="email" name="email" required value="{{ old('email') }}"
                                   class="w-full px-4 py-3 rounded-lg border border-[var(--border)] bg-[var(--background)] focus:outline-none focus:ring-2 focus:ring-[var(--primary)]"
                                   data-testid="contact-email">
                        </div>
                    </div>
                    
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-6 mb-6">
                        <div>
                            <label for="phone" class="block text-sm font-medium mb-2">{{ __('messages.phone') }}</label>
                            <input type="tel" id="phone" name="phone" value="{{ old('phone') }}"
                                   class="w-full px-4 py-3 rounded-lg border border-[var(--border)] bg-[var(--background)] focus:outline-none focus:ring-2 focus:ring-[var(--primary)]"
                                   data-testid="contact-phone">
                        </div>
                        <div>
                            <label for="company" class="block text-sm font-medium mb-2">{{ __('messages.company') }}</label>
                            <input type="text" id="company" name="company" value="{{ old('company') }}"
                                   class="w-full px-4 py-3 rounded-lg border border-[var(--border)] bg-[var(--background)] focus:outline-none focus:ring-2 focus:ring-[var(--primary)]"
                                   data-testid="contact-company">
                        </div>
                    </div>
                    
                    <div class="mb-6">
                        <label for="subject" class="block text-sm font-medium mb-2">{{ __('messages.subject') }} *</label>
                        <input type="text" id="subject" name="subject" required value="{{ old('subject') }}"
                               class="w-full px-4 py-3 rounded-lg border border-[var(--border)] bg-[var(--background)] focus:outline-none focus:ring-2 focus:ring-[var(--primary)]"
                               data-testid="contact-subject">
                    </div>
                    
                    <div class="mb-6">
                        <label for="message" class="block text-sm font-medium mb-2">{{ __('messages.message') }} *</label>
                        <textarea id="message" name="message" rows="5" required
                                  class="w-full px-4 py-3 rounded-lg border border-[var(--border)] bg-[var(--background)] focus:outline-none focus:ring-2 focus:ring-[var(--primary)] resize-none"
                                  data-testid="contact-message">{{ old('message') }}</textarea>
                    </div>
                    
                    <button type="submit" class="w-full px-6 py-3 rounded-full bg-[var(--primary)] text-white font-medium hover:opacity-90 transition-opacity" data-testid="contact-submit">
                        {{ __('messages.send_message') }}
                    </button>
                </form>
            </div>
        </div>
    </div>
</section>
@endsection
