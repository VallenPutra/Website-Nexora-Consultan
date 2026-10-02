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

            <nav data-portfolio-filters class="mt-8 flex flex-wrap justify-center gap-2" aria-label="{{ __('site.home.nit_portfolio_title') }}">
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

            <div data-portfolio-results aria-live="polite" aria-busy="false" class="relative min-h-20">
                <div data-portfolio-loading class="absolute inset-0 z-10 hidden items-start justify-center bg-white/85 pt-12" aria-hidden="true">
                    <span class="h-14 w-14 animate-spin rounded-full border-4 border-navy/15 border-t-accent" role="status" aria-label="Loading"></span>
                </div>
                <div data-portfolio-content>
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
            </div>
        </div>
    </section>

    <script>
        (() => {
            const filters = document.querySelector('[data-portfolio-filters]');
            const results = document.querySelector('[data-portfolio-results]');

            if (!filters || !results) {
                return;
            }

            const loadPortfolio = async (url, updateHistory = true) => {
                const currentResults = document.querySelector('[data-portfolio-results]');
                const currentContent = currentResults.querySelector('[data-portfolio-content]');
                const loading = currentResults.querySelector('[data-portfolio-loading]');

                currentResults.setAttribute('aria-busy', 'true');
                currentContent.classList.add('invisible');
                loading.classList.remove('hidden');
                loading.classList.add('flex');

                try {
                    const response = await fetch(url, {
                        headers: { 'X-Requested-With': 'XMLHttpRequest' },
                    });

                    if (!response.ok) {
                        window.location.assign(url);
                        return;
                    }

                    const documentFromResponse = new DOMParser().parseFromString(await response.text(), 'text/html');
                    const nextFilters = documentFromResponse.querySelector('[data-portfolio-filters]');
                    const nextResults = documentFromResponse.querySelector('[data-portfolio-results]');

                    if (!nextFilters || !nextResults) {
                        window.location.assign(url);
                        return;
                    }

                    document.querySelector('[data-portfolio-filters]').replaceWith(nextFilters);
                    currentResults.replaceWith(nextResults);

                    if (updateHistory) {
                        window.history.pushState({}, '', url);
                    }

                    window.scrollTo({ top: nextFilters.getBoundingClientRect().top + window.scrollY - 24, behavior: 'smooth' });
                    initializePortfolioFilters();
                } catch {
                    window.location.assign(url);
                }
            };

            const initializePortfolioFilters = () => {
                const currentFilters = document.querySelector('[data-portfolio-filters]');
                const currentResults = document.querySelector('[data-portfolio-results]');

                currentFilters.addEventListener('click', (event) => {
                    const link = event.target.closest('a');

                    if (link) {
                        event.preventDefault();
                        loadPortfolio(link.href);
                    }
                });

                currentResults.addEventListener('click', (event) => {
                    const link = event.target.closest('.pagination a');

                    if (link) {
                        event.preventDefault();
                        loadPortfolio(link.href);
                    }
                });
            };

            initializePortfolioFilters();
            window.addEventListener('popstate', () => loadPortfolio(window.location.href, false));
        })();
    </script>
</x-layout>
