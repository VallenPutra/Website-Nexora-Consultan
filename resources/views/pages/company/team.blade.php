<x-layout
    :title="__('site.pages.company.team_title')"
    :description="__('site.pages.company.team_description')"
>
    <x-breadcrumb :items="[['label' => __('site.nav.company'), 'url' => route('company.about')], ['label' => __('site.pages.company.team_title')]]" />

    <section class="bg-surface">
        <div class="container-nexora py-14 lg:py-20">
            <p class="eyebrow">{{ __('site.pages.company.team_title') }}</p>
            <h1 class="mt-2 max-w-3xl text-3xl font-bold text-navy sm:text-4xl">{{ __('site.pages.company.team_heading') }}</h1>
            <p class="mt-4 max-w-2xl text-base text-muted">
                {{ __('site.pages.company.team_intro') }}
            </p>
        </div>
    </section>

    <section class="section-py">
        <div class="container-nexora grid gap-6 sm:grid-cols-2 lg:grid-cols-3">
            @foreach ($team as $member)
                <div class="card-outline p-6">
                    <div class="flex h-14 w-14 items-center justify-center rounded-full bg-navy text-sm font-semibold text-white">
                        {{ collect(explode(' ', $member['name']))->map(fn ($n) => $n[0])->take(2)->implode('') }}
                    </div>
                    <p class="mt-4 text-base font-semibold text-navy">{{ $member['name'] }}</p>
                    <p class="text-sm font-medium text-accent">{{ $member['role'] }}</p>
                    <p class="mt-2 text-sm text-muted">{{ $member['expertise'] }}</p>
                </div>
            @endforeach
        </div>
    </section>

    <x-cta-section title="Want to work with our team?" description="Tell us about your project and we'll match you with the right consultants." />
</x-layout>
