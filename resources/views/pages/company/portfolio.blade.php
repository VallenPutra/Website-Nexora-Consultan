<x-layout
    :title="__('site.home.nit_portfolio_title')"
    :description="__('site.home.nit_portfolio_description')"
>
    <x-breadcrumb :items="[['label' => __('site.nav.company'), 'url' => route('company.about')], ['label' => __('site.nav.portfolio')]]" />

    <section class="section-py">
        <div class="container-nexora">
            <x-section-heading
                eyebrow="NIT"
                :title="__('site.home.nit_portfolio_title')"
                :description="__('site.home.nit_portfolio_description')"
            />

            <nav class="mt-8 flex flex-wrap justify-center gap-2" aria-label="{{ __('site.home.nit_portfolio_title') }}">
                <a
                    href="{{ route('portfolio.index') }}"
                    @if ($activeCategory === null) aria-current="page" @endif
                    class="rounded-md px-4 py-2 text-xs font-semibold transition-colors {{ $activeCategory === null ? 'bg-accent text-navy' : 'bg-surface text-muted hover:bg-accent-soft hover:text-navy' }}"
                >
                    {{ __('site.home.nit_portfolio_categories.all') }}
                </a>
                @foreach ($categories as $category => $label)
                    <a
                        href="{{ route('portfolio.index', ['category' => $category]) }}"
                        @if ($activeCategory === $category) aria-current="page" @endif
                        class="rounded-md px-4 py-2 text-xs font-semibold transition-colors {{ $activeCategory === $category ? 'bg-accent text-navy' : 'bg-surface text-muted hover:bg-accent-soft hover:text-navy' }}"
                    >
                        {{ __('site.home.nit_portfolio_categories.'.$category) }}
                    </a>
                @endforeach
            </nav>

            @if ($portfolioItems->isEmpty())
                <div class="mt-8 rounded-xl border border-navy/10 bg-surface p-8 text-center text-sm text-muted">
                    {{ __('site.home.nit_portfolio_empty') }}
                </div>
            @else
                <div class="mt-6 grid gap-4 sm:grid-cols-2 lg:grid-cols-3">
                    @foreach ($portfolioItems as $portfolioItem)
                        <article class="overflow-hidden rounded-xl border border-navy/10 bg-white">
                            <div class="aspect-video bg-surface">
                                @if ($portfolioItem->image_path)
                                    <img
                                        src="{{ \Illuminate\Support\Facades\Storage::disk('public')->url($portfolioItem->image_path) }}"
                                        alt="{{ $portfolioItem->localizedName() }}"
                                        class="h-full w-full object-cover"
                                        loading="lazy"
                                    >
                                @else
                                    <div class="flex h-full items-center justify-center bg-linear-to-br from-navy/5 to-accent-soft/60" aria-hidden="true">
                                        <span class="text-3xl font-bold tracking-wide text-navy/20">NIT</span>
                                    </div>
                                @endif
                            </div>
                            <div class="p-5">
                                <span class="text-[11px] font-semibold uppercase tracking-wide text-accent">{{ __('site.home.nit_portfolio_categories.'.$portfolioItem->category) }}</span>
                                <h2 class="mt-1 text-sm font-semibold text-navy">{{ $portfolioItem->localizedName() }}</h2>
                                <p class="mt-2 text-sm text-muted">{{ $portfolioItem->localizedWork() }}</p>
                            </div>
                        </article>
                    @endforeach
                </div>
                <div class="mt-8">{{ $portfolioItems->links() }}</div>
            @endif
        </div>
    </section>
</x-layout>
