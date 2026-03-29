@extends('layouts.app')

@section('title', $service->getTitle() . ' - ' . \App\Models\Setting::get('site_name', 'Dijital Ajans'))

@section('content')
<!-- Hero Section -->
<section class="relative py-20 lg:py-32 bg-[var(--secondary)]">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="max-w-3xl">
            <a href="{{ route('services') }}" class="inline-flex items-center text-sm text-[var(--muted-foreground)] hover:text-[var(--primary)] mb-6">
                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/>
                </svg>
                {{ __('messages.services') }}
            </a>
            <h1 class="text-4xl sm:text-5xl lg:text-6xl font-semibold tracking-tighter mb-6" data-testid="service-detail-title">
                {{ $service->getTitle() }}
            </h1>
            <p class="text-lg text-[var(--muted-foreground)]">
                {{ $service->getDescription() }}
            </p>
        </div>
    </div>
</section>

<!-- Service Content -->
<section class="py-20 lg:py-32">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-12">
            <div class="lg:col-span-2">
                @if($service->image)
                <img src="{{ $service->image }}" alt="{{ $service->getTitle() }}" class="w-full rounded-lg mb-8">
                @endif
                
                <div class="prose prose-lg max-w-none dark:prose-invert">
                    {!! nl2br(e($service->getDescription())) !!}
                </div>
            </div>
            
            <div>
                @php
                    $features = $service->features[app()->getLocale()] ?? $service->features['tr'] ?? [];
                @endphp
                @if(!empty($features))
                <div class="sticky top-24 p-8 bg-[var(--card)] border border-[var(--border)] rounded-lg">
                    <h3 class="text-xl font-semibold mb-6">{{ __('messages.features') }}</h3>
                    <ul class="space-y-4">
                        @foreach($features as $feature)
                        <li class="flex items-start">
                            <svg class="w-5 h-5 text-[var(--primary)] mr-3 mt-0.5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                            </svg>
                            <span class="text-[var(--muted-foreground)]">{{ $feature }}</span>
                        </li>
                        @endforeach
                    </ul>
                    
                    <div class="mt-8 pt-8 border-t border-[var(--border)]">
                        <a href="{{ route('quote') }}" class="w-full inline-flex items-center justify-center px-6 py-3 rounded-full bg-[var(--primary)] text-white font-medium hover:opacity-90 transition-opacity" data-testid="service-cta">
                            {{ __('messages.get_quote') }}
                        </a>
                    </div>
                </div>
                @endif
            </div>
        </div>
    </div>
</section>
@endsection
