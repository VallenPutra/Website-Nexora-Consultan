@php
    $blocks = collect($article['body']);

    // Table of contents: every "h" block gets an anchor id.
    $toc = [];
    $blocks = $blocks->map(function (array $block) use (&$toc): array {
        if ($block['type'] === 'h') {
            $id = 'sec-'.(count($toc) + 1);
            $toc[] = ['id' => $id, 'text' => $block['text']];
            $block['id'] = $id;
        }

        return $block;
    });

    $wordCount = str_word_count(strip_tags($blocks->map(fn ($b) => $b['text'] ?? implode(' ', $b['items'] ?? []))->implode(' ')));
    $readMinutes = max(1, (int) ceil($wordCount / 200));
    $published = \Illuminate\Support\Carbon::parse($article['date'])->locale(app()->getLocale());
    $authorInitial = mb_strtoupper(mb_substr($article['author'], 0, 1));
    $shareUrl = urlencode(url()->current());
    $shareTitle = urlencode($article['title']);
@endphp

<x-layout
    :title="$article['title']"
    :description="$article['excerpt']"
>
    {{-- Top bar: back / next --}}
    <div class="border-b border-navy/10 bg-white">
        <div class="container-nexora flex items-center justify-between py-3 text-sm">
            <a href="{{ route('insights.index') }}" class="inline-flex items-center gap-1.5 font-medium text-muted transition-colors hover:text-accent">
                <svg class="h-4 w-4" viewBox="0 0 20 20" fill="none" aria-hidden="true"><path d="M12 5l-5 5 5 5" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"/></svg>
                {{ __('site.pages.insights.back_to_blog') }}
            </a>
            @if ($nextSlug)
                <a href="{{ route('insights.show', $nextSlug) }}" class="inline-flex items-center gap-1.5 font-medium text-muted transition-colors hover:text-accent">
                    {{ __('site.pages.insights.next_post') }}
                    <svg class="h-4 w-4" viewBox="0 0 20 20" fill="none" aria-hidden="true"><path d="M8 5l5 5-5 5" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"/></svg>
                </a>
            @endif
        </div>
    </div>

    <div class="container-nexora py-10 lg:py-14">
        <div class="grid gap-10 lg:grid-cols-[minmax(0,1fr)_320px] lg:gap-12">
            {{-- ===== Main column ===== --}}
            <article class="min-w-0">
                <header>
                    <div class="flex flex-col gap-5 sm:flex-row sm:items-start">
                        <div class="aspect-video w-full shrink-0 overflow-hidden rounded-xl bg-linear-to-br from-navy to-charcoal sm:w-48">
                            @if (!empty($article['image']))
                                <img src="{{ $article['image'] }}" alt="{{ $article['title'] }}" class="h-full w-full object-cover">
                            @endif
                        </div>
                        <div class="min-w-0 flex-1">
                            <h1 class="text-2xl font-bold leading-tight text-navy sm:text-3xl">{{ $article['title'] }}</h1>

                            <div class="mt-4 flex flex-wrap items-center gap-x-3 gap-y-2 text-xs text-muted">
                                <span class="inline-flex items-center gap-2">
                                    <span class="flex h-7 w-7 items-center justify-center rounded-full bg-accent-soft text-xs font-bold text-accent">{{ $authorInitial }}</span>
                                    <span class="font-medium text-charcoal">{{ $article['author'] }}</span>
                                </span>
                                <span aria-hidden="true">&middot;</span>
                                <time datetime="{{ $article['date'] }}">{{ __('site.pages.insights.published') }}: {{ $published->translatedFormat('d F Y') }}</time>
                                <span aria-hidden="true">&middot;</span>
                                <span>{{ $readMinutes }} {{ __('site.pages.insights.min_read') }}</span>
                            </div>

                            {{-- Share --}}
                            <div class="mt-4 flex items-center gap-2" data-share>
                                <span class="text-xs font-medium text-muted">{{ __('site.pages.insights.share') }}</span>
                                <a href="https://www.linkedin.com/sharing/share-offsite/?url={{ $shareUrl }}" target="_blank" rel="noopener" aria-label="LinkedIn" class="flex h-8 w-8 items-center justify-center rounded-full border border-navy/10 text-muted transition-colors hover:border-accent hover:text-accent">
                                    <svg class="h-4 w-4" viewBox="0 0 24 24" fill="currentColor" aria-hidden="true"><path d="M4.98 3.5a2.5 2.5 0 11-.02 5 2.5 2.5 0 01.02-5zM3 9.75h4V21H3V9.75zM9.75 9.75h3.83v1.54h.05c.53-1 1.84-2.06 3.78-2.06 4.04 0 4.79 2.66 4.79 6.12V21h-4v-5.1c0-1.22-.02-2.78-1.7-2.78-1.7 0-1.96 1.33-1.96 2.69V21h-4V9.75z"/></svg>
                                </a>
                                <a href="https://twitter.com/intent/tweet?url={{ $shareUrl }}&text={{ $shareTitle }}" target="_blank" rel="noopener" aria-label="X" class="flex h-8 w-8 items-center justify-center rounded-full border border-navy/10 text-muted transition-colors hover:border-accent hover:text-accent">
                                    <svg class="h-3.5 w-3.5" viewBox="0 0 24 24" fill="currentColor" aria-hidden="true"><path d="M18.2 2h3.3l-7.2 8.3L22.8 22h-6.6l-5.2-6.8L5 22H1.7l7.7-8.8L1.3 2H8l4.7 6.2L18.2 2zm-1.2 18h1.8L7.1 3.9H5.2L17 20z"/></svg>
                                </a>
                                <a href="https://wa.me/?text={{ $shareTitle }}%20{{ $shareUrl }}" target="_blank" rel="noopener" aria-label="WhatsApp" class="flex h-8 w-8 items-center justify-center rounded-full border border-navy/10 text-muted transition-colors hover:border-accent hover:text-accent">
                                    <svg class="h-4 w-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.7" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M3 21l1.65-4.8A8.5 8.5 0 1 1 8 19.4L3 21z"/><path d="M9 9.5c0 3 2.5 5.5 5.5 5.5l1-1.3-1.8-1-.8.7a3.6 3.6 0 0 1-1.8-1.8l.7-.8-1-1.8L9 9.5z"/></svg>
                                </a>
                                <button type="button" data-copy-link data-copied-label="{{ __('site.pages.insights.link_copied') }}" aria-label="{{ __('site.pages.insights.copy_link') }}" title="{{ __('site.pages.insights.copy_link') }}" class="flex h-8 w-8 items-center justify-center rounded-full border border-navy/10 text-muted transition-colors hover:border-accent hover:text-accent">
                                    <svg class="h-4 w-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.7" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M10 14a4 4 0 0 0 5.7 0l3-3a4 4 0 0 0-5.7-5.7l-1 1"/><path d="M14 10a4 4 0 0 0-5.7 0l-3 3a4 4 0 0 0 5.7 5.7l1-1"/></svg>
                                </button>
                                <span class="hidden text-xs font-medium text-accent" data-copy-feedback role="status"></span>
                            </div>
                        </div>
                    </div>
                </header>

                {{-- Key takeaways --}}
                <aside class="mt-8 rounded-xl border border-accent/30 border-l-4 border-l-accent bg-accent-soft p-5">
                    <p class="text-sm font-bold text-navy">{{ __('site.pages.insights.key_points') }}</p>
                    <p class="mt-2 text-sm leading-relaxed text-charcoal">{{ $article['excerpt'] }}</p>
                </aside>

                {{-- Mobile TOC --}}
                @if (count($toc) > 0)
                    <details class="mt-6 rounded-xl border border-navy/10 bg-surface p-4 lg:hidden">
                        <summary class="cursor-pointer text-sm font-bold text-navy">{{ __('site.pages.insights.toc') }}</summary>
                        <ol class="mt-3 space-y-2 text-sm">
                            @foreach ($toc as $item)
                                <li><a href="#{{ $item['id'] }}" class="text-muted hover:text-accent">{{ $item['text'] }}</a></li>
                            @endforeach
                        </ol>
                    </details>
                @endif

                {{-- Body --}}
                <div class="mt-8 space-y-5" data-article-body>
                    @foreach ($blocks as $block)
                        @if ($block['type'] === 'h')
                            <h2 id="{{ $block['id'] }}" class="scroll-mt-28 pt-4 text-xl font-bold text-navy sm:text-2xl">{{ $block['text'] }}</h2>
                        @elseif ($block['type'] === 'list')
                            <ul class="space-y-2.5 text-sm text-charcoal sm:text-base">
                                @foreach ($block['items'] as $li)
                                    <li class="flex gap-3">
                                        <span class="mt-2 h-1.5 w-1.5 shrink-0 rounded-full bg-accent" aria-hidden="true"></span>
                                        <span class="leading-relaxed">{{ $li }}</span>
                                    </li>
                                @endforeach
                            </ul>
                        @else
                            <p class="text-sm leading-relaxed text-charcoal sm:text-base sm:leading-8">{{ $block['text'] }}</p>
                        @endif
                    @endforeach
                </div>

                {{-- Inline CTA --}}
                <div class="mt-12 rounded-2xl bg-navy p-8 text-center">
                    <h2 class="text-xl font-bold text-white sm:text-2xl">{{ __('site.pages.insights.inline_cta_title') }}</h2>
                    <p class="mx-auto mt-3 max-w-xl text-sm text-white/70">{{ __('site.pages.insights.inline_cta_text') }}</p>
                    <div class="mt-6 flex flex-wrap justify-center gap-3">
                        <a href="{{ route('contact') }}" class="btn-accent">{{ __('site.pages.insights.inline_cta_button') }}</a>
                        <a href="{{ route('home') }}#services" class="inline-flex items-center justify-center rounded-lg border border-white/25 px-6 py-3 text-sm font-semibold text-white transition-colors hover:border-accent hover:text-accent">{{ __('site.pages.insights.inline_cta_secondary') }}</a>
                    </div>
                </div>

                {{-- Author --}}
                <section class="mt-12 border-t border-navy/10 pt-8">
                    <h2 class="text-lg font-bold text-navy">{{ __('site.pages.insights.author') }}</h2>
                    <div class="mt-4 flex items-start gap-4 rounded-xl border border-navy/10 bg-surface p-5">
                        <span class="flex h-14 w-14 shrink-0 items-center justify-center rounded-full bg-accent-soft text-xl font-bold text-accent">{{ $authorInitial }}</span>
                        <div>
                            <p class="font-semibold text-navy">{{ $article['author'] }}</p>
                            <p class="mt-1 text-sm leading-relaxed text-muted">{{ __('site.pages.insights.author_role') }}</p>
                        </div>
                    </div>
                </section>

                {{-- Category + tags --}}
                <section class="mt-8 space-y-5">
                    <div>
                        <p class="text-sm font-bold text-navy">{{ __('site.pages.insights.category') }}</p>
                        <div class="mt-2 flex flex-wrap gap-2">
                            <a href="{{ route('insights.index', ['category' => $article['category']]) }}" class="rounded-full bg-accent-soft px-3 py-1.5 text-xs font-semibold text-accent transition-colors hover:bg-accent hover:text-navy">{{ $article['category'] }}</a>
                        </div>
                    </div>
                    <div>
                        <p class="text-sm font-bold text-navy">{{ __('site.pages.insights.tags') }}</p>
                        <div class="mt-2 flex flex-wrap gap-2">
                            @foreach (array_unique([$article['category'], 'Nusa Indo Technology', 'IT Consulting']) as $tag)
                                <a href="{{ route('insights.index', ['q' => $tag]) }}" class="rounded-full border border-navy/10 px-3 py-1.5 text-xs font-medium text-muted transition-colors hover:border-accent hover:text-accent">#{{ $tag }}</a>
                            @endforeach
                        </div>
                    </div>
                    <a href="#main-content" class="inline-flex items-center gap-1.5 rounded-lg bg-navy px-4 py-2 text-xs font-semibold text-white transition-colors hover:bg-accent hover:text-navy">
                        <svg class="h-3.5 w-3.5" viewBox="0 0 20 20" fill="none" aria-hidden="true"><path d="M5 12l5-5 5 5" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"/></svg>
                        {{ __('site.pages.insights.back_to_top') }}
                    </a>
                </section>
            </article>

            {{-- ===== Sidebar ===== --}}
            <aside class="hidden lg:block">
                <div class="sticky top-24 space-y-6">
                    @if (count($toc) > 0)
                        <nav aria-label="{{ __('site.pages.insights.toc') }}" class="rounded-xl border border-navy/10 bg-white p-5" data-toc>
                            <p class="text-sm font-bold text-navy">{{ __('site.pages.insights.toc') }}</p>
                            <ol class="mt-3 space-y-1 border-l border-navy/10">
                                @foreach ($toc as $item)
                                    <li>
                                        <a href="#{{ $item['id'] }}" data-toc-link class="-ml-px block border-l-2 border-transparent py-1.5 pl-4 text-sm text-muted transition-colors hover:text-accent">{{ $item['text'] }}</a>
                                    </li>
                                @endforeach
                            </ol>
                        </nav>
                    @endif

                    <div class="overflow-hidden rounded-xl bg-navy">
                        <div class="aspect-[16/7] bg-linear-to-br from-charcoal to-navy p-5">
                            <span class="inline-flex rounded-full bg-accent px-3 py-1 text-[11px] font-bold uppercase tracking-wide text-navy">NIT</span>
                        </div>
                        <div class="p-5">
                            <p class="text-base font-bold leading-snug text-white">{{ __('site.pages.insights.side_cta_title') }}</p>
                            <p class="mt-2 text-sm leading-relaxed text-white/70">{{ __('site.pages.insights.side_cta_text') }}</p>
                            <a href="{{ route('contact') }}" class="btn-accent mt-4 w-full">{{ __('site.pages.insights.side_cta_button') }}</a>
                        </div>
                    </div>
                </div>
            </aside>
        </div>
    </div>

    {{-- Related posts --}}
    <section class="bg-surface py-14">
        <div class="container-nexora">
            <h2 class="text-xl font-bold text-navy sm:text-2xl">{{ __('site.pages.insights.related') }}</h2>
            <div class="mt-6 grid gap-4 md:grid-cols-2 lg:grid-cols-3">
                @foreach ($related as $relatedSlug => $relatedArticle)
                    <a href="{{ route('insights.show', $relatedSlug) }}" class="card-outline flex items-center gap-4 p-3">
                        <div class="aspect-4/3 w-28 shrink-0 overflow-hidden rounded-lg bg-linear-to-br from-navy to-charcoal">
                            @if (!empty($relatedArticle['image']))
                                <img src="{{ $relatedArticle['image'] }}" alt="{{ $relatedArticle['title'] }}" class="h-full w-full object-cover">
                            @endif
                        </div>
                        <div class="min-w-0">
                            <span class="text-[11px] font-semibold uppercase tracking-wide text-accent">{{ $relatedArticle['category'] }}</span>
                            <p class="mt-1 line-clamp-2 text-sm font-semibold text-navy">{{ $relatedArticle['title'] }}</p>
                            <time class="mt-1 block text-xs text-muted" datetime="{{ $relatedArticle['date'] }}">{{ \Illuminate\Support\Carbon::parse($relatedArticle['date'])->locale(app()->getLocale())->translatedFormat('d M Y') }}</time>
                        </div>
                    </a>
                @endforeach
            </div>
        </div>
    </section>

    <x-cta-section />
</x-layout>
