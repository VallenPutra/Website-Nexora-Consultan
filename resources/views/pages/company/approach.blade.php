<x-layout
    title="Our Approach"
    description="How NEXORA IT Consulting delivers technology projects: Discover, Plan, Design, Develop, Deploy, and Support."
>
    <x-breadcrumb :items="[['label' => 'Company', 'url' => route('company.about')], ['label' => 'Our Approach']]" />

    <section class="bg-surface">
        <div class="container-nexora py-14 lg:py-20">
            <p class="eyebrow">Our Approach</p>
            <h1 class="mt-2 max-w-3xl text-3xl font-bold text-navy sm:text-4xl">A structured process, applied flexibly to your business</h1>
            <p class="mt-4 max-w-2xl text-base text-muted">
                Every engagement follows the same disciplined process, adapted to the scale and complexity of your project. This keeps delivery predictable while leaving room for the details that make each business different.
            </p>
        </div>
    </section>

    <section class="section-py">
        <div class="container-nexora">
            <div class="grid gap-6 lg:grid-cols-3">
                @foreach ([
                    ['step' => 'Discover', 'desc' => 'We learn your business, current systems, and goals before recommending anything.'],
                    ['step' => 'Plan', 'desc' => 'We define scope, priorities, timeline, and success measures together with your team.'],
                    ['step' => 'Design', 'desc' => 'We design the solution architecture, workflows, and interfaces for validation before build.'],
                    ['step' => 'Develop', 'desc' => 'Our engineers build the solution in iterative, testable phases.'],
                    ['step' => 'Deploy', 'desc' => 'We roll out carefully, with testing and training to minimize disruption to daily operations.'],
                    ['step' => 'Support', 'desc' => 'We remain available after launch for fixes, updates, and future enhancements.'],
                ] as $index => $item)
                    <div class="rounded-xl border border-navy/10 p-6">
                        <span class="text-sm font-semibold text-accent">{{ sprintf('%02d', $index + 1) }}</span>
                        <p class="mt-2 text-base font-semibold text-navy">{{ $item['step'] }}</p>
                        <p class="mt-2 text-sm text-muted">{{ $item['desc'] }}</p>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    <x-cta-section />
</x-layout>
