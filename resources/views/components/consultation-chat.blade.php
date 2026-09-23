<div data-consultation-chat data-authenticated="{{ auth()->check() ? 'true' : 'false' }}" data-chat-handled-by="{{ __('site.chat.handled_by') }}" data-chat-typing="{{ __('site.chat.typing') }}" data-chat-start="{{ __('site.chat.start') }}" data-chat-starting="{{ __('site.chat.starting') }}" class="fixed bottom-5 right-5 z-40 w-[min(22rem,calc(100vw-2rem))]">
    <button type="button" data-chat-toggle class="ml-auto flex items-center gap-2 rounded-full bg-navy px-4 py-3 text-sm font-semibold text-white shadow-lg hover:bg-accent hover:text-navy"><span class="h-2 w-2 rounded-full bg-emerald-400"></span> {{ __('site.chat.toggle') }}</button>
    <div data-chat-panel class="mt-3 hidden overflow-hidden rounded-2xl border border-navy/10 bg-white shadow-2xl">
        <div class="flex items-center justify-between bg-navy px-4 py-3 text-white"><div><p class="text-sm font-semibold">{{ __('site.chat.title') }}</p><p class="text-xs text-white/60">{{ __('site.chat.subtitle') }}</p></div><button type="button" data-chat-close class="text-white/70 hover:text-white" aria-label="Close chat">&times;</button></div>
        <div data-chat-messages class="flex max-h-72 min-h-24 flex-col gap-2 overflow-y-auto p-4 text-sm"></div>
        @auth
            <form data-chat-start-form class="space-y-3 border-t border-navy/10 p-4"><p class="text-xs text-muted">{{ __('site.chat.greeting', ['name' => auth()->user()->name]) }}</p><textarea name="message" required rows="3" placeholder="{{ __('site.chat.message_placeholder') }}" class="w-full rounded-lg border border-navy/15 px-3 py-2 text-sm focus:border-accent focus:outline-none"></textarea><button class="btn-primary w-full" type="submit">{{ __('site.chat.start') }}</button></form>
        @else
            <div class="border-t border-navy/10 p-4"><p class="text-sm font-medium text-navy">{{ __('site.chat.login_title') }}</p><p class="mt-1 text-xs leading-relaxed text-muted">{{ __('site.chat.login_description') }}</p><div class="mt-3 flex gap-2"><a href="{{ route('login') }}" class="btn-primary flex-1 text-center">{{ __('site.chat.login') }}</a><a href="{{ route('register') }}" class="flex-1 rounded-lg border border-navy/15 px-3 py-2 text-center text-sm font-semibold text-navy hover:border-accent">{{ __('site.chat.register') }}</a></div></div>
        @endauth
        @auth
            <form data-chat-reply-form class="hidden w-full flex flex-nowrap items-center gap-2 border-t border-navy/10 p-4"><input name="body" required placeholder="{{ __('site.chat.write_placeholder') }}" class="min-w-0 basis-0 flex-1 rounded-lg border border-navy/15 px-3 py-2 text-sm focus:border-accent focus:outline-none"><button class="btn-primary shrink-0 whitespace-nowrap px-4" type="submit">{{ __('site.chat.send') }}</button></form>
        @endauth
    </div>
</div>
