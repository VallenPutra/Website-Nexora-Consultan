<x-layout
    :title="$article['title']"
    :description="$article['excerpt']"
>
    <x-breadcrumb :items="[
        ['label' => 'Insights', 'url' => route('insights.index')],
        ['label' => $article['title']],
    ]" />

    <article class="section-py">
        <div class="container-nexora max-w-3xl">
            <span class="eyebrow">{{ $article['category'] }}</span>
            <h1 class="mt-2 text-3xl font-bold leading-tight text-navy sm:text-4xl">{{ $article['title'] }}</h1>
            <p class="mt-4 text-base text-muted">{{ $article['excerpt'] }}</p>
            <div class="mt-4 flex items-center gap-3 text-xs text-muted">
                <span>{{ $article['author'] }}</span>
                <span aria-hidden="true">&middot;</span>
                <time datetime="{{ $article['date'] }}">{{ \Illuminate\Support\Carbon::parse($article['date'])->format('d F Y') }}</time>
            </div>

            <div class="mt-8 aspect-video rounded-2xl bg-linear-to-br from-navy to-charcoal">
                @if (!empty($article['image']))
                    <img src="{{ $article['image'] }}" alt="{{ $article['title'] }}" class="h-full w-full rounded-2xl object-cover">
                @endif
            </div>

            <div class="prose-nexora mt-10 space-y-5">
                @foreach ($article['body'] as $block)
                    @if ($block['type'] === 'h')
                        <h2 class="text-xl font-bold text-navy">{{ $block['text'] }}</h2>
                    @elseif ($block['type'] === 'list')
                        <ul class="list-inside list-disc space-y-2 text-sm text-charcoal sm:text-base">
                            @foreach ($block['items'] as $li)
                                <li>{{ $li }}</li>
                            @endforeach
                        </ul>
                    @else
                        <p class="text-sm leading-relaxed text-charcoal sm:text-base">{{ $block['text'] }}</p>
                    @endif
                @endforeach
            </div>
        </div>
    </article>

    <section class="section-py bg-surface">
        <div class="container-nexora">
            <x-section-heading title="Related articles" />
            <div class="mt-8 grid gap-6 lg:grid-cols-3">
                @foreach ($related as $relatedSlug => $relatedArticle)
                    <a href="{{ route('insights.show', $relatedSlug) }}" class="card-outline flex flex-col overflow-hidden bg-white">
                        <div class="aspect-video bg-linear-to-br from-navy to-charcoal">
                            @if (!empty($relatedArticle['image']))
                                <img src="{{ $relatedArticle['image'] }}" alt="{{ $relatedArticle['title'] }}" class="h-full w-full object-cover">
                            @endif
                        </div>
                        <div class="flex flex-1 flex-col p-6">
                            <span class="text-xs font-semibold uppercase tracking-wide text-accent">{{ $relatedArticle['category'] }}</span>
                            <span class="mt-2 text-sm font-semibold text-navy">{{ $relatedArticle['title'] }}</span>
                        </div>
                    </a>
                @endforeach
            </div>
        </div>
    </section>

    <x-cta-section />
</x-layout>
