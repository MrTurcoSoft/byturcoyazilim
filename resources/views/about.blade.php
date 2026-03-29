@extends('layouts.app')

@section('title', __('messages.about') . ' - ' . \App\Models\Setting::get('site_name', 'Dijital Ajans'))

@section('content')
<!-- Hero Section -->
<section class="relative py-20 lg:py-32 bg-[var(--secondary)]">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center">
            <p class="text-xs font-bold uppercase tracking-[0.2em] text-[var(--primary)] mb-4">{{ __('messages.about') }}</p>
            <h1 class="text-4xl sm:text-5xl lg:text-6xl font-semibold tracking-tighter mb-6" data-testid="about-title">
                {{ __('messages.our_story') }}
            </h1>
            <p class="text-lg text-[var(--muted-foreground)] max-w-2xl mx-auto">
                {{ __('messages.about_description') }}
            </p>
        </div>
    </div>
</section>

<!-- About Content -->
<section class="py-20 lg:py-32">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 lg:gap-20 items-center">
            <div>
                <img src="https://images.pexels.com/photos/1170412/pexels-photo-1170412.jpeg?auto=compress&cs=tinysrgb&dpr=2&h=650&w=940" 
                     alt="Office" 
                     class="w-full rounded-lg shadow-2xl">
            </div>
            <div>
                <h2 class="text-3xl font-semibold mb-6">{{ \App\Models\Setting::get('site_name', 'DigiAgency') }}</h2>
                <p class="text-[var(--muted-foreground)] mb-6 leading-relaxed">
                    {{ \App\Models\Setting::get('about_text', 'Dijital dünyada fark yaratmak isteyen işletmelere, yaratıcı web tasarım ve akıllı yazılım çözümleri sunuyoruz. Fikirden hayata, her adımda yanınızdayız.') }}
                </p>
                <div class="grid grid-cols-2 gap-6 mt-8">
                    <div class="p-6 bg-[var(--secondary)] rounded-lg">
                        <div class="text-3xl font-bold text-[var(--primary)] mb-2">500+</div>
                        <div class="text-sm text-[var(--muted-foreground)]">{{ __('messages.completed_projects') }}</div>
                    </div>
                    <div class="p-6 bg-[var(--secondary)] rounded-lg">
                        <div class="text-3xl font-bold text-[var(--primary)] mb-2">10+</div>
                        <div class="text-sm text-[var(--muted-foreground)]">{{ __('messages.years_experience') }}</div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Vision & Mission -->
<section class="py-20 lg:py-32 bg-[var(--secondary)]">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid grid-cols-1 md:grid-cols-2 gap-8 lg:gap-12">
            <div class="p-8 lg:p-12 bg-[var(--card)] border border-[var(--border)] rounded-lg" data-testid="vision-card">
                <div class="w-12 h-12 rounded-lg bg-[var(--primary)]/10 flex items-center justify-center mb-6 text-[var(--primary)]">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                    </svg>
                </div>
                <h3 class="text-2xl font-semibold mb-4">{{ __('messages.vision') }}</h3>
                <p class="text-[var(--muted-foreground)] leading-relaxed">
                    {{ \App\Models\Setting::get('vision_text', 'Dijital dünyada lider bir ajans olarak, müşterilerimizin başarılarını en üst düzeye çıkarmak için yenilikçi çözümler sunmak.') }}
                </p>
            </div>
            <div class="p-8 lg:p-12 bg-[var(--card)] border border-[var(--border)] rounded-lg" data-testid="mission-card">
                <div class="w-12 h-12 rounded-lg bg-[var(--primary)]/10 flex items-center justify-center mb-6 text-[var(--primary)]">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"/>
                    </svg>
                </div>
                <h3 class="text-2xl font-semibold mb-4">{{ __('messages.mission') }}</h3>
                <p class="text-[var(--muted-foreground)] leading-relaxed">
                    {{ \App\Models\Setting::get('mission_text', 'En son teknolojileri kullanarak, müşterilerimize kaliteli, yenilikçi ve sürdürülebilir dijital çözümler sunmak.') }}
                </p>
            </div>
        </div>
    </div>
</section>

<!-- CTA Section -->
<section class="py-20 lg:py-32 bg-[var(--primary)]">
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
        <h2 class="text-3xl sm:text-4xl font-semibold tracking-tight text-white mb-6">
            {{ __('messages.cta_title') }}
        </h2>
        <p class="text-lg text-white/80 mb-10">
            {{ __('messages.cta_description') }}
        </p>
        <a href="{{ route('contact') }}" class="inline-flex items-center px-8 py-4 rounded-full bg-white text-[var(--primary)] font-medium hover:bg-white/90 transition-all" data-testid="about-cta">
            {{ __('messages.contact_us') }}
        </a>
    </div>
</section>
@endsection
