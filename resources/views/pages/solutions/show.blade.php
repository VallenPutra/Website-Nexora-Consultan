<x-layout
    :title="$solution['title']"
    :description="$solution['short']"
>
    <x-breadcrumb :items="[
        ['label' => 'Solutions', 'url' => route('solutions.index')],
        ['label' => $solution['title']],
    ]" />

    {{-- Hero --}}
    <section class="bg-surface">
        <div class="container-nexora py-14 lg:py-20">
            <p class="eyebrow">{{ $solution['group'] }}</p>
            <h1 class="mt-2 max-w-3xl text-3xl font-bold text-navy sm:text-4xl">{{ $solution['hero'] }}</h1>
            <p class="mt-4 max-w-2xl text-base text-muted">{{ $solution['subheadline'] }}</p>
            <a href="{{ route('contact') }}" class="btn-primary mt-6">Start a Consultation</a>
        </div>
    </section>

    {{-- Problem / Solution --}}
    <section class="section-py">
        <div class="container-nexora grid gap-12 lg:grid-cols-2">
            <div>
                <h2 class="text-xl font-bold text-navy">The Challenge</h2>
                <div class="mt-4 space-y-4 text-sm text-muted sm:text-base">
                    @foreach ($solution['problem'] as $p)
                        <p>{{ $p }}</p>
                    @endforeach
                </div>
            </div>
            <div>
                <h2 class="text-xl font-bold text-navy">Our Approach</h2>
                <div class="mt-4 space-y-4 text-sm text-muted sm:text-base">
                    @foreach ($solution['solution'] as $p)
                        <p>{{ $p }}</p>
                    @endforeach
                </div>
            </div>
        </div>
    </section>

    {{-- Features / Capabilities --}}
    <section class="section-py bg-surface">
        <div class="container-nexora">
            <x-section-heading title="What's included" />
            <div class="mt-8 grid gap-4 sm:grid-cols-2">
                @foreach ($solution['features'] as $feature)
                    <div class="flex items-start gap-3 rounded-xl border border-navy/10 bg-white p-5">
                        <span class="mt-1 h-2 w-2 shrink-0 rounded-full bg-accent"></span>
                        <span class="text-sm text-charcoal">{{ $feature }}</span>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    {{-- Process --}}
    <section class="section-py">
        <div class="container-nexora">
            <x-section-heading title="How we work" />
            <div class="mt-8 grid gap-6 sm:grid-cols-3">
                @foreach (['Discover' => 'Understand your goals, constraints, and current environment.', 'Design & Build' => 'Design the solution and deliver it in manageable, validated phases.', 'Support' => 'Provide ongoing support as your business and needs evolve.'] as $step => $desc)
                    <div class="rounded-xl border border-navy/10 p-6">
                        <p class="text-sm font-semibold text-navy">{{ $step }}</p>
                        <p class="mt-2 text-sm text-muted">{{ $desc }}</p>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    {{-- Benefits --}}
    <section class="section-py bg-surface">
        <div class="container-nexora">
            <x-section-heading title="Benefits" />
            <ul class="mt-8 grid gap-4 sm:grid-cols-2">
                @foreach ($solution['benefits'] as $benefit)
                    <li class="flex items-start gap-3 text-sm text-charcoal sm:text-base">
                        <svg class="mt-0.5 h-5 w-5 shrink-0 text-accent" viewBox="0 0 20 20" fill="none" aria-hidden="true"><path d="M4 10.5l4 4 8-9" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"/></svg>
                        {{ $benefit }}
                    </li>
                @endforeach
            </ul>
        </div>
    </section>

    {{-- Related --}}
    <section class="section-py">
        <div class="container-nexora">
            <x-section-heading title="Related solutions" />
            <div class="mt-8 grid gap-6 sm:grid-cols-3">
                @foreach ($solution['related'] as $relatedSlug)
                    @continue(!isset($allSolutions[$relatedSlug]))
                    <a href="{{ route('solutions.show', $relatedSlug) }}" class="card-outline flex flex-col p-6">
                        <span class="text-sm font-semibold text-navy">{{ $allSolutions[$relatedSlug]['title'] }}</span>
                        <span class="mt-2 text-sm text-muted">{{ $allSolutions[$relatedSlug]['short'] }}</span>
                    </a>
                @endforeach
            </div>
        </div>
    </section>

    <x-cta-section title="Let's talk about {{ $solution['title'] }}" description="Tell us about your challenge and we'll help you find the right path forward." />
</x-layout>
