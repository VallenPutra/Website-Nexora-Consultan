<x-layout
    :title="__('site.pages.company.careers_title')"
    :description="__('site.pages.company.careers_description')"
>
    <x-breadcrumb :items="[['label' => __('site.nav.company'), 'url' => route('company.about')], ['label' => __('site.pages.company.careers_title')]]" />

    <section class="bg-surface">
        <div class="container-nexora py-14 lg:py-20">
            <p class="eyebrow">{{ __('site.pages.company.careers_title') }}</p>
            <h1 class="mt-2 max-w-3xl text-3xl font-bold text-navy sm:text-4xl">{{ __('site.pages.company.careers_heading') }}</h1>
            <p class="mt-4 max-w-2xl text-base text-muted">
                {{ __('site.pages.company.careers_intro') }}
            </p>
        </div>
    </section>

    <section class="section-py">
        <div class="container-nexora space-y-4">
            @foreach ($positions as $position)
                <div class="flex flex-col gap-4 rounded-xl border border-navy/10 p-6 sm:flex-row sm:items-center sm:justify-between">
                    <div>
                        <p class="text-base font-semibold text-navy">{{ $position['title'] }}</p>
                        <p class="mt-1 text-sm text-muted">{{ $position['type'] }}</p>
                        <p class="mt-2 max-w-xl text-sm text-muted">{{ $position['summary'] }}</p>
                    </div>
                    <a href="{{ route('contact') }}" class="btn-secondary shrink-0">{{ __('site.pages.company.apply') }}</a>
                </div>
            @endforeach
        </div>
    </section>

    <x-cta-section title="Don't see the right role?" description="Send us your CV and tell us where you think you could add the most value." buttonLabel="Get in Touch" />
</x-layout>
