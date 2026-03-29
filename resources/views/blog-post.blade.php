@extends('layouts.app')

@section('title', $post->getTitle() . ' - ' . \App\Models\Setting::get('site_name', 'Dijital Ajans'))

@section('content')
<!-- Article -->
<article class="py-20 lg:py-32">
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
        <a href="{{ route('blog') }}" class="inline-flex items-center text-sm text-[var(--muted-foreground)] hover:text-[var(--primary)] mb-6">
            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/>
            </svg>
            {{ __('messages.blog') }}
        </a>
        
        <div class="flex items-center gap-3 mb-6">
            @if($post->category)
            <span class="text-xs font-medium px-3 py-1 rounded bg-[var(--primary)] text-white">{{ $post->category }}</span>
            @endif
            <span class="text-sm text-[var(--muted-foreground)]">{{ $post->published_at?->format('d M Y') }}</span>
        </div>
        
        <h1 class="text-4xl sm:text-5xl font-semibold tracking-tight mb-8" data-testid="blog-post-title">
            {{ $post->getTitle() }}
        </h1>
        
        @if($post->image)
        <div class="aspect-video rounded-lg overflow-hidden mb-12">
            <img src="{{ $post->image }}" alt="{{ $post->getTitle() }}" class="w-full h-full object-cover">
        </div>
        @endif
        
        <div class="prose prose-lg max-w-none dark:prose-invert">
            {!! nl2br(e($post->getContent())) !!}
        </div>
        
        @if($post->tags && count($post->tags) > 0)
        <div class="mt-12 pt-8 border-t border-[var(--border)]">
            <h3 class="text-sm font-medium mb-4">{{ __('messages.tags') }}</h3>
            <div class="flex flex-wrap gap-2">
                @foreach($post->tags as $tag)
                <span class="text-sm px-3 py-1 rounded bg-[var(--secondary)]">{{ $tag }}</span>
                @endforeach
            </div>
        </div>
        @endif
    </div>
</article>

<!-- Related Posts -->
@if($relatedPosts->count() > 0)
<section class="py-20 bg-[var(--secondary)]">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <h2 class="text-2xl font-semibold mb-8">{{ __('messages.related_posts') }}</h2>
        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
            @foreach($relatedPosts as $related)
            <article class="bg-[var(--card)] border border-[var(--border)] rounded-lg overflow-hidden group hover:border-[var(--primary)] transition-all duration-300">
                @if($related->image)
                <div class="aspect-video overflow-hidden">
                    <img src="{{ $related->image }}" alt="{{ $related->getTitle() }}" class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-105">
                </div>
                @endif
                <div class="p-6">
                    <h3 class="text-lg font-semibold mb-2 group-hover:text-[var(--primary)] transition-colors line-clamp-2">
                        {{ $related->getTitle() }}
                    </h3>
                    <a href="{{ route('blog.post', $related->getSlug()) }}" class="inline-flex items-center text-sm font-medium text-[var(--primary)] hover:underline">
                        {{ __('messages.read_more') }}
                    </a>
                </div>
            </article>
            @endforeach
        </div>
    </div>
</section>
@endif
@endsection
