@extends('layouts.app')

@section('title', __('messages.services') . ' - ' . \App\Models\Setting::get('site_name', 'Dijital Ajans'))

@section('content')
<!-- Hero Section -->
<section class="relative py-20 lg:py-32 bg-[var(--secondary)]">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center">
            <p class="text-xs font-bold uppercase tracking-[0.2em] text-[var(--primary)] mb-4">{{ __('messages.what_we_do') }}</p>
            <h1 class="text-4xl sm:text-5xl lg:text-6xl font-semibold tracking-tighter mb-6" data-testid="services-title">
                {{ __('messages.our_services') }}
            </h1>
            <p class="text-lg text-[var(--muted-foreground)] max-w-2xl mx-auto">
                {{ __('messages.our_expertise') }}
            </p>
        </div>
    </div>
</section>

<!-- Services Grid -->
<section class="py-20 lg:py-32">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
            @forelse($services as $service)
            <div class="group p-8 bg-[var(--card)] border border-[var(--border)] rounded-lg hover:border-[var(--primary)] transition-all duration-300 hover:-translate-y-1" data-testid="service-card-{{ $service->id }}">
                @if($service->image)
                <div class="aspect-video rounded-lg overflow-hidden mb-6">
                    <img src="{{ $service->image }}" alt="{{ $service->getTitle() }}" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
                </div>
                @else
                <div class="w-14 h-14 rounded-lg bg-[var(--primary)]/10 flex items-center justify-center mb-6 text-[var(--primary)]">
                    <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.75 17L9 20l-1 1h8l-1-1-.75-3M3 13h18M5 17h14a2 2 0 002-2V5a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                    </svg>
                </div>
                @endif
                
                <h3 class="text-xl font-semibold mb-3 group-hover:text-[var(--primary)] transition-colors">
                    {{ $service->getTitle() }}
                </h3>
                <p class="text-[var(--muted-foreground)] mb-4">
                    {{ $service->getDescription() }}
                </p>
                
                @php
                    $features = $service->features[app()->getLocale()] ?? $service->features['tr'] ?? [];
                @endphp
                @if(!empty($features))
                <ul class="space-y-2 mb-6">
                    @foreach(array_slice($features, 0, 4) as $feature)
                    <li class="flex items-center text-sm text-[var(--muted-foreground)]">
                        <svg class="w-4 h-4 text-[var(--primary)] mr-2 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                        </svg>
                        {{ $feature }}
                    </li>
                    @endforeach
                </ul>
                @endif
                
                <a href="{{ route('services.detail', $service->id) }}" class="inline-flex items-center text-sm font-medium text-[var(--primary)] hover:underline">
                    {{ __('messages.learn_more') }}
                    <svg class="ml-1 w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                    </svg>
                </a>
            </div>
            @empty
            <div class="col-span-full text-center py-12 text-[var(--muted-foreground)]">
                {{ __('messages.no_services') }}
            </div>
            @endforelse
        </div>
    </div>
</section>

<!-- CTA Section -->
<section class="py-20 lg:py-32 bg-[var(--primary)]">
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
        <h2 class="text-3xl sm:text-4xl font-semibold tracking-tight text-white mb-6">
            {{ __('messages.cta_title') }}
        </h2>
        <a href="{{ route('quote') }}" class="inline-flex items-center px-8 py-4 rounded-full bg-white text-[var(--primary)] font-medium hover:bg-white/90 transition-all" data-testid="services-cta">
            {{ __('messages.get_quote') }}
        </a>
    </div>
</section>
@endsection
