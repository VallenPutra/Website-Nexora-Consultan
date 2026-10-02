<x-layout
    :title="$service['title']"
    :description="$service['description']"
>
    <x-breadcrumb :items="[
        ['label' => __('site.nav.services'), 'url' => route('services.index')],
        ['label' => $service['title']],
    ]" />

    <section class="bg-surface">
        <div class="container-nexora py-14 lg:py-20">
            <p class="eyebrow">{{ __('site.pages.detail.service') }}</p>
            <h1 class="mt-2 max-w-3xl text-3xl font-bold text-navy sm:text-4xl">{{ $service['title'] }}</h1>
            <p class="mt-4 max-w-2xl text-base text-muted">{{ $service['description'] }}</p>
            <a href="{{ route('contact') }}" class="btn-primary mt-6">{{ __('site.pages.detail.contact') }}</a>
        </div>
    </section>

    <section class="section-py">
        <div class="container-nexora grid gap-12 lg:grid-cols-2">
            <div>
                <h2 class="text-xl font-bold text-navy">{{ __('site.home.nit_service_overview') }}</h2>
                <p class="mt-4 text-sm text-muted sm:text-base">{{ $service['description'] }}</p>
            </div>
            <div class="rounded-xl border border-navy/10 bg-surface p-6 sm:p-8">
                <p class="text-sm font-semibold text-navy">{{ __('site.home.nit_service_detail_invite', ['service' => $service['title']]) }}</p>
                <a href="{{ route('contact') }}" class="btn-primary mt-5">{{ __('site.pages.detail.contact') }}</a>
            </div>
        </div>
    </section>

    @php($relatedServices = collect(__('site.home.nit_services'))->where('slug', '!=', $slug)->take(3))

    <section class="section-py bg-surface">
        <div class="container-nexora">
            <x-section-heading :title="__('site.pages.services.title')" />
            <div class="mt-8 grid gap-6 sm:grid-cols-3">
                @foreach ($relatedServices as $relatedService)
                    <a href="{{ route('services.show', $relatedService['slug']) }}" class="card-outline flex flex-col p-6">
                        <span class="text-sm font-semibold text-navy">{{ $relatedService['title'] }}</span>
                        <span class="mt-2 flex-1 text-sm text-muted">{{ $relatedService['description'] }}</span>
                        <span class="mt-4 text-sm font-semibold text-accent">{{ __('site.pages.services.explore') }} &rarr;</span>
                    </a>
                @endforeach
            </div>
        </div>
    </section>

    <x-cta-section />
</x-layout>
