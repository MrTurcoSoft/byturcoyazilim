@extends('layouts.app')

@section('title', $reference->getTitle() . ' - ' . \App\Models\Setting::get('site_name', 'Dijital Ajans'))

@section('content')
<!-- Hero Section -->
<section class="relative py-20 lg:py-32 bg-[var(--secondary)]">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="max-w-3xl">
            <a href="{{ route('references') }}" class="inline-flex items-center text-sm text-[var(--muted-foreground)] hover:text-[var(--primary)] mb-6">
                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/>
                </svg>
                {{ __('messages.references') }}
            </a>
            @if($reference->category)
            <span class="inline-block text-xs font-medium px-3 py-1 rounded bg-[var(--primary)] text-white mb-4">{{ $reference->category }}</span>
            @endif
            <h1 class="text-4xl sm:text-5xl lg:text-6xl font-semibold tracking-tighter mb-6" data-testid="reference-detail-title">
                {{ $reference->getTitle() }}
            </h1>
            <p class="text-lg text-[var(--muted-foreground)]">
                {{ $reference->client_name }}
            </p>
        </div>
    </div>
</section>

<!-- Reference Content -->
<section class="py-20 lg:py-32">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-12">
            <div class="lg:col-span-2">
                <img src="{{ $reference->image }}" alt="{{ $reference->getTitle() }}" class="w-full rounded-lg mb-8">
                
                @if($reference->getDescription())
                <div class="prose prose-lg max-w-none dark:prose-invert">
                    {!! nl2br(e($reference->getDescription())) !!}
                </div>
                @endif
            </div>
            
            <div>
                <div class="sticky top-24 p-8 bg-[var(--card)] border border-[var(--border)] rounded-lg">
                    <h3 class="text-xl font-semibold mb-6">Proje Detayları</h3>
                    
                    <div class="space-y-4">
                        <div>
                            <span class="text-sm text-[var(--muted-foreground)]">Müşteri</span>
                            <p class="font-medium">{{ $reference->client_name }}</p>
                        </div>
                        
                        @if($reference->category)
                        <div>
                            <span class="text-sm text-[var(--muted-foreground)]">Kategori</span>
                            <p class="font-medium">{{ $reference->category }}</p>
                        </div>
                        @endif
                    </div>
                    
                    @if($reference->url)
                    <div class="mt-8 pt-8 border-t border-[var(--border)]">
                        <a href="{{ $reference->url }}" target="_blank" class="w-full inline-flex items-center justify-center px-6 py-3 rounded-full bg-[var(--primary)] text-white font-medium hover:opacity-90 transition-opacity" data-testid="visit-website">
                            {{ __('messages.visit_website') }}
                            <svg class="ml-2 w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"/>
                            </svg>
                        </a>
                    </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
