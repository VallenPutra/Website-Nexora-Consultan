<x-layout
    title="Careers"
    description="Join NEXORA IT Consulting. Explore current open positions in engineering, design, and consulting."
>
    <x-breadcrumb :items="[['label' => 'Company', 'url' => route('company.about')], ['label' => 'Careers']]" />

    <section class="bg-surface">
        <div class="container-nexora py-14 lg:py-20">
            <p class="eyebrow">Careers</p>
            <h1 class="mt-2 max-w-3xl text-3xl font-bold text-navy sm:text-4xl">Build technology that businesses actually rely on</h1>
            <p class="mt-4 max-w-2xl text-base text-muted">
                We're a small, senior team that values ownership, clear communication, and getting things done well. If that sounds like you, we'd like to hear from you, even if none of the roles below are an exact fit.
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
                    <a href="{{ route('contact') }}" class="btn-secondary shrink-0">Apply Now</a>
                </div>
            @endforeach
        </div>
    </section>

    <x-cta-section title="Don't see the right role?" description="Send us your CV and tell us where you think you could add the most value." buttonLabel="Get in Touch" />
</x-layout>
