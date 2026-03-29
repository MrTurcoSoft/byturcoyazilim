@extends('layouts.app')

@section('title', \App\Models\Setting::get('site_name', 'Dijital Ajans') . ' - ' . __('messages.home'))

@section('content')
<!-- Hero Section -->
<section class="relative min-h-[90vh] flex items-center justify-center overflow-hidden">
    <!-- Background Image -->
    <div class="absolute inset-0 z-0">
        <img src="https://static.prod-images.emergentagent.com/jobs/5763de9c-24bc-4105-8c94-47243f911710/images/6131d222ba14da2c0761e63dbc2808a37377d26fe25f34b3b13d969061ddf8b4.png" 
             alt="Hero Background" 
             class="w-full h-full object-cover dark:block hidden">
        <img src="https://static.prod-images.emergentagent.com/jobs/5763de9c-24bc-4105-8c94-47243f911710/images/a1df500aa352d9c54fb7022cbb2a2182f795d6b3d2a74518b98ffd5c931b3c1e.png" 
             alt="Hero Background" 
             class="w-full h-full object-cover dark:hidden block">
        <div class="absolute inset-0 bg-black/40"></div>
    </div>
    
    <!-- Content -->
    <div class="relative z-10 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
        <p class="text-xs font-bold uppercase tracking-[0.2em] text-[var(--primary)] mb-4" data-testid="hero-overline">
            {{ __('messages.hero_overline') }}
        </p>
        <h1 class="text-4xl sm:text-5xl lg:text-7xl font-semibold tracking-tighter text-white mb-6" data-testid="hero-title">
            {{ __('messages.hero_title') }}
        </h1>
        <p class="text-lg sm:text-xl text-white/80 max-w-2xl mx-auto mb-10" data-testid="hero-description">
            {{ __('messages.hero_description') }}
        </p>
        <div class="flex flex-col sm:flex-row items-center justify-center gap-4">
            <a href="{{ route('quote') }}" class="inline-flex items-center px-8 py-4 rounded-full bg-[var(--primary)] text-white font-medium hover:opacity-90 transition-all transform hover:-translate-y-1" data-testid="hero-cta-primary">
                {{ __('messages.get_quote') }}
                <svg class="ml-2 w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"/>
                </svg>
            </a>
            <a href="{{ route('references') }}" class="inline-flex items-center px-8 py-4 rounded-full border-2 border-white/30 text-white font-medium hover:bg-white/10 transition-all" data-testid="hero-cta-secondary">
                {{ __('messages.view_projects') }}
            </a>
        </div>
    </div>

    <!-- Scroll Indicator -->
    <div class="absolute bottom-8 left-1/2 transform -translate-x-1/2 animate-bounce">
        <svg class="w-6 h-6 text-white/60" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 14l-7 7m0 0l-7-7m7 7V3"/>
        </svg>
    </div>
</section>

<!-- Services Section -->
<section class="py-20 lg:py-32 bg-[var(--background)]" data-testid="services-section">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-16">
            <p class="text-xs font-bold uppercase tracking-[0.2em] text-[var(--primary)] mb-4">{{ __('messages.what_we_do') }}</p>
            <h2 class="text-3xl sm:text-4xl lg:text-5xl font-semibold tracking-tight">{{ __('messages.our_services') }}</h2>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            @forelse($services as $index => $service)
            <div class="group relative p-8 bg-[var(--card)] border border-[var(--border)] rounded-lg hover:border-[var(--primary)] transition-all duration-300 hover:-translate-y-1 {{ $index === 0 ? 'md:col-span-2' : '' }}" data-testid="service-card-{{ $service->id }}">
                @if($service->icon)
                <div class="w-12 h-12 rounded-lg bg-[var(--primary)]/10 flex items-center justify-center mb-6 text-[var(--primary)]">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.75 17L9 20l-1 1h8l-1-1-.75-3M3 13h18M5 17h14a2 2 0 002-2V5a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                    </svg>
                </div>
                @endif
                <h3 class="text-xl font-semibold mb-3 group-hover:text-[var(--primary)] transition-colors">
                    {{ $service->getTitle() }}
                </h3>
                <p class="text-[var(--muted-foreground)] mb-4 line-clamp-3">
                    {{ $service->getDescription() }}
                </p>
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

        <div class="text-center mt-12">
            <a href="{{ route('services') }}" class="inline-flex items-center px-6 py-3 rounded-full border border-[var(--border)] hover:border-[var(--primary)] hover:text-[var(--primary)] transition-colors" data-testid="view-all-services">
                {{ __('messages.view_all_services') }}
                <svg class="ml-2 w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"/>
                </svg>
            </a>
        </div>
    </div>
</section>

<!-- Stats Section -->
<section class="py-16 bg-[var(--secondary)]">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid grid-cols-2 lg:grid-cols-4 gap-8 lg:gap-12">
            <div class="text-center" data-testid="stat-projects">
                <div class="text-4xl lg:text-5xl font-bold text-[var(--primary)] mb-2">500+</div>
                <div class="text-sm text-[var(--muted-foreground)]">{{ __('messages.completed_projects') }}</div>
            </div>
            <div class="text-center" data-testid="stat-clients">
                <div class="text-4xl lg:text-5xl font-bold text-[var(--primary)] mb-2">200+</div>
                <div class="text-sm text-[var(--muted-foreground)]">{{ __('messages.happy_clients') }}</div>
            </div>
            <div class="text-center" data-testid="stat-experience">
                <div class="text-4xl lg:text-5xl font-bold text-[var(--primary)] mb-2">10+</div>
                <div class="text-sm text-[var(--muted-foreground)]">{{ __('messages.years_experience') }}</div>
            </div>
            <div class="text-center" data-testid="stat-satisfaction">
                <div class="text-4xl lg:text-5xl font-bold text-[var(--primary)] mb-2">100%</div>
                <div class="text-sm text-[var(--muted-foreground)]">{{ __('messages.satisfaction') }}</div>
            </div>
        </div>
    </div>
</section>

<!-- References Section -->
<section class="py-20 lg:py-32 bg-[var(--background)]" data-testid="references-section">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-16">
            <p class="text-xs font-bold uppercase tracking-[0.2em] text-[var(--primary)] mb-4">{{ __('messages.portfolio') }}</p>
            <h2 class="text-3xl sm:text-4xl lg:text-5xl font-semibold tracking-tight">{{ __('messages.our_work') }}</h2>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            @forelse($references as $reference)
            <a href="{{ route('references.detail', $reference->id) }}" class="group relative aspect-[4/3] overflow-hidden rounded-lg" data-testid="reference-card-{{ $reference->id }}">
                <img src="{{ $reference->image }}" alt="{{ $reference->getTitle() }}" class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-110">
                <div class="absolute inset-0 bg-gradient-to-t from-black/80 via-black/20 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300">
                    <div class="absolute bottom-0 left-0 right-0 p-6">
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

        <div class="text-center mt-12">
            <a href="{{ route('references') }}" class="inline-flex items-center px-6 py-3 rounded-full border border-[var(--border)] hover:border-[var(--primary)] hover:text-[var(--primary)] transition-colors" data-testid="view-all-references">
                {{ __('messages.view_all_projects') }}
                <svg class="ml-2 w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"/>
                </svg>
            </a>
        </div>
    </div>
</section>

<!-- Blog Section -->
@if($blogPosts->count() > 0)
<section class="py-20 lg:py-32 bg-[var(--secondary)]" data-testid="blog-section">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-16">
            <p class="text-xs font-bold uppercase tracking-[0.2em] text-[var(--primary)] mb-4">{{ __('messages.blog') }}</p>
            <h2 class="text-3xl sm:text-4xl lg:text-5xl font-semibold tracking-tight">{{ __('messages.latest_news') }}</h2>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
            @foreach($blogPosts as $post)
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
                    <h3 class="text-lg font-semibold mb-2 group-hover:text-[var(--primary)] transition-colors line-clamp-2">
                        {{ $post->getTitle() }}
                    </h3>
                    <p class="text-sm text-[var(--muted-foreground)] line-clamp-2 mb-4">
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
            @endforeach
        </div>

        <div class="text-center mt-12">
            <a href="{{ route('blog') }}" class="inline-flex items-center px-6 py-3 rounded-full border border-[var(--border)] hover:border-[var(--primary)] hover:text-[var(--primary)] transition-colors" data-testid="view-all-blog">
                {{ __('messages.view_all_posts') }}
            </a>
        </div>
    </div>
</section>
@endif

<!-- CTA Section -->
<section class="py-20 lg:py-32 bg-[var(--primary)]" data-testid="cta-section">
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
        <h2 class="text-3xl sm:text-4xl lg:text-5xl font-semibold tracking-tight text-white mb-6">
            {{ __('messages.cta_title') }}
        </h2>
        <p class="text-lg text-white/80 mb-10 max-w-2xl mx-auto">
            {{ __('messages.cta_description') }}
        </p>
        <div class="flex flex-col sm:flex-row items-center justify-center gap-4">
            <a href="{{ route('quote') }}" class="inline-flex items-center px-8 py-4 rounded-full bg-white text-[var(--primary)] font-medium hover:bg-white/90 transition-all transform hover:-translate-y-1" data-testid="cta-primary">
                {{ __('messages.start_project') }}
            </a>
            <a href="{{ route('contact') }}" class="inline-flex items-center px-8 py-4 rounded-full border-2 border-white/30 text-white font-medium hover:bg-white/10 transition-all" data-testid="cta-secondary">
                {{ __('messages.contact_us') }}
            </a>
        </div>
    </div>
</section>
@endsection
