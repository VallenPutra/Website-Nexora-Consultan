<x-layout
    title="About Us"
    description="Learn about NEXORA IT Consulting's mission, vision, values, and why businesses choose us as their technology partner."
>
    <x-breadcrumb :items="[['label' => 'Company', 'url' => route('company.about')], ['label' => 'About Us']]" />

    <section class="bg-surface">
        <div class="container-nexora py-14 lg:py-20">
            <p class="eyebrow">About NEXORA</p>
            <h1 class="mt-2 max-w-3xl text-3xl font-bold text-navy sm:text-4xl">Technology consulting built around real business outcomes</h1>
            <p class="mt-4 max-w-2xl text-base text-muted">
                NEXORA IT CONSULTING was founded to help growing businesses use technology as a genuine advantage, not just a cost center. We combine strategic consulting with hands-on engineering delivery, so recommendations turn into working systems.
            </p>
        </div>
    </section>

    <section class="section-py">
        <div class="container-nexora grid gap-8 sm:grid-cols-3">
            <div class="rounded-xl border border-navy/10 p-6">
                <p class="text-sm font-semibold text-accent">Vision</p>
                <p class="mt-2 text-sm text-muted">To be the technology partner that businesses trust to turn complex challenges into practical, working solutions.</p>
            </div>
            <div class="rounded-xl border border-navy/10 p-6">
                <p class="text-sm font-semibold text-accent">Mission</p>
                <p class="mt-2 text-sm text-muted">To design and deliver technology that measurably improves how our clients operate, communicate transparently, and support them for the long term.</p>
            </div>
            <div class="rounded-xl border border-navy/10 p-6">
                <p class="text-sm font-semibold text-accent">Values</p>
                <p class="mt-2 text-sm text-muted">Business-first thinking, technical honesty, and accountability for the outcomes we help create.</p>
            </div>
        </div>
    </section>

    <section class="section-py bg-surface">
        <div class="container-nexora">
            <x-section-heading eyebrow="Why NEXORA" title="Why businesses choose to work with us" />
            <div class="mt-10 grid gap-6 sm:grid-cols-2 lg:grid-cols-4">
                @foreach ([
                    'Business-focused approach' => 'We start every engagement with your business goals, not a predetermined technology stack.',
                    'Experienced delivery team' => 'Our consultants and engineers have delivered projects across manufacturing, healthcare, retail, and finance.',
                    'Scalable by design' => 'Systems we build are designed to grow with you, not need to be rebuilt at the next stage.',
                    'Transparent, long-term partnership' => 'We communicate clearly throughout delivery and remain available well after go-live.',
                ] as $title => $desc)
                    <div class="rounded-xl bg-white p-6">
                        <p class="text-sm font-semibold text-navy">{{ $title }}</p>
                        <p class="mt-2 text-sm text-muted">{{ $desc }}</p>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    <x-cta-section />
</x-layout>
