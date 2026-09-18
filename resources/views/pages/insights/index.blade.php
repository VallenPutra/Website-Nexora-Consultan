<x-layout
    :title="__('site.pages.insights.title')"
    :description="__('site.pages.insights.description')"
>
    <x-breadcrumb :items="[['label' => __('site.pages.insights.title')]]" />

    <section class="bg-surface">
        <div class="container-nexora py-14">
            <x-section-heading
                :eyebrow="__('site.pages.insights.eyebrow')"
                :title="__('site.pages.insights.heading')"
                :description="__('site.pages.insights.description_text')"
            />
        </div>
    </section>

    @if ($featured && !$activeCategory && !$search)
        <section class="section-py">
            <div class="container-nexora">
                <a href="{{ route('insights.show', $featuredSlug) }}" class="card-outline grid gap-0 overflow-hidden lg:grid-cols-2">
                    <div class="aspect-[16/9] bg-gradient-to-br from-navy to-charcoal lg:aspect-auto"></div>
                    <div class="flex flex-col justify-center p-8">
                        <span class="eyebrow">{{ __('site.pages.insights.featured') }}</span>
                        <h2 class="mt-2 text-xl font-bold text-navy sm:text-2xl">{{ $featured['title'] }}</h2>
                        <p class="mt-3 text-sm text-muted">{{ $featured['excerpt'] }}</p>
                        <span class="mt-4 text-xs text-muted">{{ $featured['author'] }} &middot; {{ \Illuminate\Support\Carbon::parse($featured['date'])->format('d M Y') }}</span>
                        <span class="mt-5 text-sm font-semibold text-accent">{{ __('site.pages.insights.read') }} &rarr;</span>
                    </div>
                </a>
            </div>
        </section>
    @endif

    <section class="{{ $featured && !$activeCategory && !$search ? 'pb-16 lg:pb-24' : 'section-py' }}">
        <div class="container-nexora">
            {{-- Search + filters --}}
            <div class="flex flex-col gap-4 border-b border-navy/10 pb-6 sm:flex-row sm:items-center sm:justify-between">
                <form method="GET" action="{{ route('insights.index') }}" class="flex w-full max-w-xs items-center gap-2 rounded-lg border border-navy/10 px-3 py-2">
                    <svg class="h-4 w-4 shrink-0 text-muted" viewBox="0 0 20 20" fill="none" aria-hidden="true"><circle cx="9" cy="9" r="6" stroke="currentColor" stroke-width="1.6"/><path d="M14 14l4 4" stroke="currentColor" stroke-width="1.6" stroke-linecap="round"/></svg>
                    <input type="search" name="q" value="{{ $search }}" placeholder="{{ __('site.pages.insights.search') }}" class="w-full border-0 p-0 text-sm text-charcoal placeholder:text-muted focus:outline-none focus:ring-0">
                    @if ($activeCategory)
                        <input type="hidden" name="category" value="{{ $activeCategory }}">
                    @endif
                </form>

                <div class="flex flex-wrap gap-2">
                    <a href="{{ route('insights.index') }}" class="rounded-full px-3 py-1.5 text-xs font-semibold {{ !$activeCategory ? 'bg-navy text-white' : 'bg-surface text-muted hover:text-navy' }}">{{ __('site.pages.insights.all') }}</a>
                    @foreach ($categories as $category)
                        <a href="{{ route('insights.index', ['category' => $category]) }}" class="rounded-full px-3 py-1.5 text-xs font-semibold {{ $activeCategory === $category ? 'bg-navy text-white' : 'bg-surface text-muted hover:text-navy' }}">{{ $category }}</a>
                    @endforeach
                </div>
            </div>

            @if ($articles->isEmpty())
                <p class="mt-10 text-sm text-muted">{{ __('site.pages.insights.empty') }}</p>
            @else
                <div class="mt-10 grid gap-6 lg:grid-cols-3">
                    @foreach ($articles as $slug => $article)
                        <a href="{{ route('insights.show', $slug) }}" class="card-outline flex flex-col overflow-hidden">
                            <div class="aspect-[16/9] bg-gradient-to-br from-navy to-charcoal"></div>
                            <div class="flex flex-1 flex-col p-6">
                                <span class="text-xs font-semibold uppercase tracking-wide text-accent">{{ $article['category'] }}</span>
                                <span class="mt-2 text-base font-semibold text-navy">{{ $article['title'] }}</span>
                                <span class="mt-2 flex-1 text-sm text-muted">{{ $article['excerpt'] }}</span>
                                <span class="mt-4 text-xs text-muted">{{ \Illuminate\Support\Carbon::parse($article['date'])->format('d M Y') }}</span>
                            </div>
                        </a>
                    @endforeach
                </div>
            @endif
        </div>
    </section>

    <x-cta-section />
</x-layout>
