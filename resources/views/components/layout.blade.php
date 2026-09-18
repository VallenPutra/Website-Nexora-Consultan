@props([
    'title' => 'NEXORA IT Consulting',
    'description' => __('site.hero.subheadline'),
])
<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="scroll-smooth">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ $title }} | NEXORA IT Consulting</title>
    <meta name="description" content="{{ $description }}">
    <meta name="theme-color" content="#171a2b">
    <link rel="icon" href="data:,">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="flex min-h-screen flex-col bg-white text-charcoal">
    <a href="#main-content" class="sr-only focus:not-sr-only focus:absolute focus:left-4 focus:top-4 focus:z-100 focus:rounded-lg focus:bg-navy focus:px-4 focus:py-2 focus:text-white">
        {{ __('site.breadcrumb.skip') }}
    </a>

    <x-announcement-bar />
    <x-navbar />

    <main id="main-content" class="flex-1">
        {{ $slot }}
    </main>

    <x-footer />
</body>
</html>
