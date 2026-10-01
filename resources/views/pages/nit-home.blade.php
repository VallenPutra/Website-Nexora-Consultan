<x-layout
    :title="__('site.home.seo_title')"
    :description="__('site.home.seo_description')"
    keywords="Konsultan IT Surabaya, IT Management Consultant, IT Governance, IT Audit, Enterprise Architecture, IT Blueprint, Pengembangan Software, Training IT"
>
    <section class="relative overflow-hidden bg-white">
        <div class="pointer-events-none absolute inset-0 bg-linear-to-br from-accent-soft via-white to-white"></div>
        <div class="container-nexora relative grid items-center gap-12 py-16 lg:grid-cols-2 lg:py-24">
            <div>
                <p class="eyebrow">{{ __('site.hero.eyebrow') }}</p>
                <h1 class="mt-3 text-4xl font-bold leading-tight text-navy sm:text-5xl">{{ __('site.hero.headline') }}</h1>
                <p class="mt-5 max-w-xl text-base leading-7 text-muted">{{ __('site.hero.subheadline') }}</p>
                <div class="mt-8 flex flex-wrap gap-4">
                    <a href="#layanan" class="btn-primary">{{ __('site.hero.cta_primary') }}</a>
                    <a href="#portofolio" class="btn-secondary">{{ __('site.hero.cta_secondary') }}</a>
                </div>
                <p class="mt-6 text-sm font-semibold text-navy">{{ __('site.hero.uptime_label') }} <span class="text-accent">2010</span></p>
            </div>
            <div class="rounded-2xl bg-navy p-8 text-white shadow-xl sm:p-10">
                <p class="text-xs font-semibold uppercase tracking-[0.18em] text-accent">NIT</p>
                <h2 class="mt-3 text-2xl font-bold">{{ __('site.home.nit_featured_title') }}</h2>
                <div class="mt-6 grid gap-3">
                    @foreach (__('site.home.nit_featured') as $item)
                        <div class="rounded-xl border border-white/10 bg-white/5 p-4">
                            <h3 class="text-sm font-semibold">{{ $item['title'] }}</h3>
                            <p class="mt-1 text-sm leading-6 text-white/65">{{ $item['description'] }}</p>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </section>

    <section id="tentang" class="border-y border-navy/10 bg-surface">
        <div class="container-nexora py-10">
            <p class="text-center text-xs font-semibold uppercase tracking-wide text-muted">{{ __('site.home.trusted_by') }}</p>
            <div class="mx-auto mt-4 max-w-4xl text-center">
                <p class="text-lg font-bold text-navy">{{ __('site.home.nit_about_title') }}</p>
                <p class="mt-2 text-sm leading-6 text-muted">{{ __('site.home.nit_about') }}</p>
            </div>
        </div>
    </section>

    <section id="layanan" class="section-py">
        <div class="container-nexora">
            <x-section-heading eyebrow="NIT" :title="__('site.home.nit_services_title')" :description="__('site.home.nit_services_description')" />
            <div class="mt-10 grid gap-5 sm:grid-cols-2 lg:grid-cols-3">
                @foreach (__('site.home.nit_services') as $service)
                    <article class="card-outline p-6">
                        <span class="text-xs font-bold text-accent">{{ sprintf('%02d', $loop->iteration) }}</span>
                        <h2 class="mt-3 text-base font-semibold text-navy">{{ $service['title'] }}</h2>
                        <p class="mt-2 text-sm leading-6 text-muted">{{ $service['description'] }}</p>
                    </article>
                @endforeach
            </div>
        </div>
    </section>

    <section class="section-py bg-surface">
        <div class="container-nexora">
            <x-section-heading :title="__('site.home.nit_why_title')" :description="__('site.home.nit_consulting_intro')" align="center" />
            <div class="mx-auto mt-10 grid max-w-5xl gap-5 sm:grid-cols-2 lg:grid-cols-4">
                @foreach (__('site.home.nit_why') as $reason)
                    <article class="rounded-xl bg-white p-6">
                        <h3 class="text-sm font-semibold text-navy">{{ $reason['title'] }}</h3>
                        <p class="mt-2 text-sm leading-6 text-muted">{{ $reason['description'] }}</p>
                    </article>
                @endforeach
            </div>
        </div>
    </section>

    <section class="section-py bg-surface">
        <div class="container-nexora">
            <x-section-heading :title="__('site.home.nit_why_choose_title')" :description="__('site.home.nit_why_choose_description')" align="center" />
        </div>
    </section>

    <section id="portofolio" class="section-py">
        <div class="container-nexora">
            <x-section-heading eyebrow="NIT" :title="__('site.home.nit_portfolio_title')" :description="__('site.home.nit_portfolio_description')" />
            <div class="mt-8 flex flex-wrap justify-center gap-2" data-portfolio-filters role="group" aria-label="{{ __('site.home.nit_portfolio_title') }}">
                @foreach (__('site.home.nit_portfolio_categories') as $category => $label)
                    <button type="button" data-portfolio-filter="{{ $category }}" aria-pressed="{{ $loop->first ? 'true' : 'false' }}" class="rounded-md px-4 py-2 text-xs font-semibold transition-colors {{ $loop->first ? 'bg-accent text-navy' : 'bg-surface text-muted hover:bg-accent-soft hover:text-navy' }}">
                        {{ $label }}
                    </button>
                @endforeach
            </div>
            <div class="mt-6 grid gap-4 sm:grid-cols-2 lg:grid-cols-3" data-portfolio-grid>
                @foreach (__('site.home.nit_portfolio') as $project)
                    <article data-portfolio-item="{{ $project['category'] }}" class="rounded-xl border border-navy/10 bg-white p-5">
                        <span class="text-[11px] font-semibold uppercase tracking-wide text-accent">{{ __('site.home.nit_portfolio_categories.'.$project['category']) }}</span>
                        <h3 class="text-sm font-semibold text-navy">{{ $project['name'] }}</h3>
                        <p class="mt-2 text-sm text-muted">{{ $project['work'] }}</p>
                    </article>
                @endforeach
            </div>
        </div>
    </section>

    <section class="section-py bg-surface">
        <div class="container-nexora">
            <x-section-heading :title="__('site.pages.nit_company.title')" :description="__('site.home.nit_about')" />
            <div class="mt-10 grid items-center gap-10 lg:grid-cols-2">
                <div>
                    <h3 class="text-base font-semibold text-navy">{{ __('site.home.nit_video_title') }}</h3>
                    <div class="mt-4 aspect-video overflow-hidden rounded-xl bg-navy">
                        <iframe class="h-full w-full" src="https://www.youtube-nocookie.com/embed/qDI2oF1bASk" title="{{ __('site.home.nit_video_title') }}" loading="lazy" referrerpolicy="strict-origin-when-cross-origin" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" allowfullscreen></iframe>
                    </div>
                </div>
                <div class="grid gap-4">
                    <article class="rounded-xl border border-navy/10 bg-white p-6">
                        <h3 class="text-sm font-semibold uppercase tracking-wide text-accent">{{ __('site.pages.company.vision') }}</h3>
                        <p class="mt-2 text-sm leading-6 text-muted">{{ __('site.pages.nit_company.vision') }}</p>
                    </article>
                    <article class="rounded-xl border border-navy/10 bg-white p-6">
                        <h3 class="text-sm font-semibold uppercase tracking-wide text-accent">{{ __('site.pages.company.mission') }}</h3>
                        <p class="mt-2 text-sm leading-6 text-muted">{{ __('site.pages.nit_company.mission') }}</p>
                    </article>
                    <article class="rounded-xl border border-navy/10 bg-white p-6">
                        <h3 class="text-sm font-semibold uppercase tracking-wide text-accent">{{ __('site.pages.nit_company.culture_title') }}</h3>
                        <ul class="mt-2 flex flex-wrap gap-x-6 gap-y-2 text-sm text-muted">
                            @foreach (__('site.pages.nit_company.culture') as $value)
                                <li>{{ $value }}</li>
                            @endforeach
                        </ul>
                    </article>
                </div>
            </div>
        </div>
    </section>

    <section class="section-py bg-surface">
        <div class="container-nexora">
            <x-section-heading :title="__('site.home.nit_process_title')" />
            <ol class="mt-10 grid gap-4 sm:grid-cols-2 lg:grid-cols-3">
                @foreach (__('site.home.nit_process') as $step)
                    <li class="rounded-xl border border-navy/10 bg-white p-5">
                        <span class="text-xs font-bold text-accent">{{ sprintf('%02d', $loop->iteration) }}</span>
                        <h3 class="mt-2 text-sm font-semibold text-navy">{{ $step['title'] }}</h3>
                        <p class="mt-2 text-sm leading-6 text-muted">{{ $step['description'] }}</p>
                    </li>
                @endforeach
            </ol>
        </div>
    </section>

</x-layout>
