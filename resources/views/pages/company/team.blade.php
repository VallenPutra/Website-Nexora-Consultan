<x-layout
    title="Our Team"
    description="Meet the consultants and engineers behind NEXORA IT Consulting's project delivery."
>
    <x-breadcrumb :items="[['label' => 'Company', 'url' => route('company.about')], ['label' => 'Our Team']]" />

    <section class="bg-surface">
        <div class="container-nexora py-14 lg:py-20">
            <p class="eyebrow">Our Team</p>
            <h1 class="mt-2 max-w-3xl text-3xl font-bold text-navy sm:text-4xl">The people behind every engagement</h1>
            <p class="mt-4 max-w-2xl text-base text-muted">
                Our team combines strategic consultants and hands-on engineers, so the recommendations we make are the same people who help build and support them.
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
