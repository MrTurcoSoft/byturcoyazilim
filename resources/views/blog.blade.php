@extends('layouts.app')

@section('title', __('messages.blog') . ' - ' . \App\Models\Setting::get('site_name', 'Dijital Ajans'))

@section('content')
<!-- Hero Section -->
<section class="relative py-20 lg:py-32 bg-[var(--secondary)]">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center">
            <p class="text-xs font-bold uppercase tracking-[0.2em] text-[var(--primary)] mb-4">{{ __('messages.blog') }}</p>
            <h1 class="text-4xl sm:text-5xl lg:text-6xl font-semibold tracking-tighter mb-6" data-testid="blog-title">
                {{ __('messages.latest_news') }}
            </h1>
        </div>
    </div>
</section>

<!-- Blog Grid -->
<section class="py-20 lg:py-32">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
            @forelse($posts as $post)
            <article class="bg-[var(--card)] border border-[var(--border)] rounded-lg overflow-hidden group hover:border-[var(--primary)] transition-all duration-300" data-testid="blog-card-{{ $post->id }}">
                @if($post->image)
                <div class="aspect-video overflow-hidden">
                    <img src="{{ $post->image }}" alt="{{ $post->getTitle() }}" class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-105">
                </div>
                @endif
                <div class="p-6">
                    <div class="flex items-center gap-2 mb-3">
                        @if($post->category)
                        <span class="text-xs font-medium px-2 py-1 rounded bg-[var(--primary)]/10 text-[var(--primary)]">{{ $post->category }}</span>
                        @endif
                        <span class="text-xs text-[var(--muted-foreground)]">{{ $post->published_at?->format('d M Y') }}</span>
                    </div>
                    <h2 class="text-lg font-semibold mb-2 group-hover:text-[var(--primary)] transition-colors line-clamp-2">
                        {{ $post->getTitle() }}
                    </h2>
                    <p class="text-sm text-[var(--muted-foreground)] line-clamp-3 mb-4">
                        {{ $post->getExcerpt() }}
                    </p>
                    <a href="{{ route('blog.post', $post->getSlug()) }}" class="inline-flex items-center text-sm font-medium text-[var(--primary)] hover:underline">
                        {{ __('messages.read_more') }}
                        <svg class="ml-1 w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                        </svg>
                    </a>
                </div>
            </article>
            @empty
            <div class="col-span-full text-center py-12 text-[var(--muted-foreground)]">
                Henüz blog yazısı eklenmemiş.
            </div>
            @endforelse
        </div>
        
        @if($posts->hasPages())
        <div class="mt-12 flex justify-center">
            {{ $posts->links() }}
        </div>
        @endif
    </div>
</section>
@endsection
