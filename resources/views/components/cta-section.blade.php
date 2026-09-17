@props([
    'title' => "Let's build your next digital solution",
    'description' => 'Tell us about your challenge and discover how technology can help your business grow.',
    'buttonLabel' => 'Contact Our Team',
])

<section class="section-py bg-navy">
    <div class="container-nexora flex flex-col items-center gap-6 text-center">
        <h2 class="max-w-2xl text-2xl font-bold text-white sm:text-3xl">{{ $title }}</h2>
        <p class="max-w-xl text-sm text-white/70 sm:text-base">{{ $description }}</p>
        <a href="{{ route('contact') }}" class="btn-accent">{{ $buttonLabel }}</a>
    </div>
</section>
