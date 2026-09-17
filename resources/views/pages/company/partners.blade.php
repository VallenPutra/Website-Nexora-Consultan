<x-layout
    title="Partners"
    description="NEXORA IT Consulting's technology and integration partners across cloud, enterprise software, and security."
>
    <x-breadcrumb :items="[['label' => 'Company', 'url' => route('company.about')], ['label' => 'Partners']]" />

    <section class="bg-surface">
        <div class="container-nexora py-14 lg:py-20">
            <p class="eyebrow">Partners</p>
            <h1 class="mt-2 max-w-3xl text-3xl font-bold text-navy sm:text-4xl">Working with proven technology platforms</h1>
            <p class="mt-4 max-w-2xl text-base text-muted">
                We stay platform-agnostic in our recommendations, but maintain deep working knowledge of the following platforms so we can implement and integrate them well.
            </p>
        </div>
    </section>

    <section class="section-py space-y-12">
        <div class="container-nexora space-y-12">
            @foreach ($partnerGroups as $group => $partners)
                <div>
                    <p class="text-xs font-semibold uppercase tracking-wide text-muted">{{ $group }}</p>
                    <div class="mt-4 grid gap-4 sm:grid-cols-3">
                        @foreach ($partners as $partner)
                            <div class="flex items-center justify-center rounded-xl border border-navy/10 bg-surface py-8 text-sm font-semibold text-navy/60">
                                {{ $partner }}
                            </div>
                        @endforeach
                    </div>
                </div>
            @endforeach
        </div>
    </section>

    <x-cta-section title="Have a platform in mind?" description="Tell us which systems you're already using and we'll help you get the most out of them." />
</x-layout>
