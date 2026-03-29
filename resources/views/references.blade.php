@extends('layouts.app')

@section('title', __('messages.references') . ' - ' . \App\Models\Setting::get('site_name', 'Dijital Ajans'))

@section('content')
<!-- Hero Section -->
<section class="relative py-20 lg:py-32 bg-[var(--secondary)]">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center">
            <p class="text-xs font-bold uppercase tracking-[0.2em] text-[var(--primary)] mb-4">{{ __('messages.portfolio') }}</p>
            <h1 class="text-4xl sm:text-5xl lg:text-6xl font-semibold tracking-tighter mb-6" data-testid="references-title">
                {{ __('messages.our_work') }}
            </h1>
        </div>
    </div>
</section>

<!-- References Grid -->
<section class="py-20 lg:py-32">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            @forelse($references as $reference)
            <a href="{{ route('references.detail', $reference->id) }}" class="group relative aspect-[4/3] overflow-hidden rounded-lg" data-testid="reference-card-{{ $reference->id }}">
                <img src="{{ $reference->image }}" alt="{{ $reference->getTitle() }}" class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-110">
                <div class="absolute inset-0 bg-gradient-to-t from-black/80 via-black/20 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300">
                    <div class="absolute bottom-0 left-0 right-0 p-6">
                        @if($reference->category)
                        <span class="inline-block text-xs font-medium px-2 py-1 rounded bg-[var(--primary)] text-white mb-2">{{ $reference->category }}</span>
                        @endif
                        <h3 class="text-xl font-semibold text-white mb-1">{{ $reference->getTitle() }}</h3>
                        <p class="text-sm text-white/70">{{ $reference->client_name }}</p>
                    </div>
                </div>
            </a>
            @empty
            <div class="col-span-full text-center py-12 text-[var(--muted-foreground)]">
                {{ __('messages.no_references') }}
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
        <a href="{{ route('quote') }}" class="inline-flex items-center px-8 py-4 rounded-full bg-white text-[var(--primary)] font-medium hover:bg-white/90 transition-all" data-testid="references-cta">
            {{ __('messages.start_project') }}
        </a>
    </div>
</section>
@endsection
