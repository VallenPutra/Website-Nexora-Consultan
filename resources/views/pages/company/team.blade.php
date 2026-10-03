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
                <div class="card-outline overflow-hidden">
                    @if (!empty($member['photo']))
                        <img src="{{ $member['photo'] }}" alt="{{ $member['name'] }}" class="aspect-[4/3] w-full object-cover">
                    @else
                        <div class="flex aspect-[4/3] items-center justify-center bg-navy text-3xl font-semibold text-white">
                            {{ collect(explode(' ', $member['name']))->map(fn ($n) => $n[0])->take(2)->implode('') }}
                        </div>
                    @endif
                    <div class="p-6">
                    <p class="mt-4 text-base font-semibold text-navy">{{ $member['name'] }}</p>
                    <p class="text-sm font-medium text-accent">{{ $member['role'] }}</p>
                    @if (!empty($member['expertise']))<p class="mt-2 text-sm text-muted">{{ $member['expertise'] }}</p>@endif
                    @if (!empty($member['bio']))<p class="mt-3 text-sm leading-relaxed text-muted">{{ $member['bio'] }}</p>@endif
                    </div>
                </div>
            @endforeach
        </div>
    </section>

    @if (count($teamGroupPhotos))
        <section class="section-py bg-surface">
            <div class="container-nexora space-y-6" data-team-gallery>
                <div class="flex items-end justify-between gap-4">
                    <div>
                        <p class="eyebrow">{{ __('site.pages.company.team_title') }}</p>
                        <h2 class="mt-2 text-2xl font-bold text-navy sm:text-3xl">{{ __('site.pages.company.team_heading') }}</h2>
                    </div>
                    @if (count($teamGroupPhotos) > 1)
                        <div class="flex shrink-0 gap-2">
                            <button type="button" data-team-gallery-prev aria-label="Previous team photo" class="flex h-11 w-11 items-center justify-center rounded-full border border-navy/15 bg-white text-navy hover:border-accent hover:text-accent">&larr;</button>
                            <button type="button" data-team-gallery-next aria-label="Next team photo" class="flex h-11 w-11 items-center justify-center rounded-full border border-navy/15 bg-white text-navy hover:border-accent hover:text-accent">&rarr;</button>
                        </div>
                    @endif
                </div>
                <div data-team-gallery-track class="flex snap-x snap-mandatory gap-5 overflow-x-auto scroll-smooth pb-2">
                    @foreach ($teamGroupPhotos as $photo)
                        <article class="min-w-full snap-center overflow-hidden rounded-2xl border border-navy/10 bg-white sm:min-w-[85%]">
                            <img src="{{ $photo['image'] }}" alt="{{ $photo['title'] }}" class="aspect-[16/8] w-full object-cover">
                            <div class="p-5 sm:p-6">
                                <h3 class="text-lg font-semibold text-navy">{{ $photo['title'] }}</h3>
                                @if ($photo['description'])<p class="mt-2 text-sm leading-relaxed text-muted">{{ $photo['description'] }}</p>@endif
                            </div>
                        </article>
                    @endforeach
                </div>
            </div>
        </section>
    @endif

    <x-cta-section title="Want to work with our team?" description="Tell us about your project and we'll match you with the right consultants." />
</x-layout>
