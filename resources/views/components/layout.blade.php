@props([
    'title' => 'NIT Nusa Indo Technology | IT Management Consultant',
    'description' => __('site.hero.subheadline'),
    'keywords' => 'Konsultan IT Surabaya, Konsultan TI Indonesia, IT Governance, IT Audit, Enterprise Architecture, Transformasi Digital Pemerintah',
    'author' => 'Nusa Indo Technology',
])
<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="scroll-smooth">
<head>
    <meta charset="utf-8">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="keywords" content="{{ $keywords }}">
    <title>{{ $title }} | NIT Nusa Indo Technology</title>
    <meta name="description" content="{{ $description }}">
    <meta name="author" content="{{ $author }}">
    <link rel="canonical" href="{{ url()->current() }}">
    <meta property="og:type" content="website">
    <meta property="og:site_name" content="NIT Nusa Indo Technology">
    <meta property="og:title" content="{{ $title }} | NIT Nusa Indo Technology">
    <meta property="og:description" content="{{ $description }}">
    <meta property="og:url" content="{{ url()->current() }}">
    <meta name="twitter:card" content="summary">
    <meta name="twitter:title" content="{{ $title }} | NIT Nusa Indo Technology">
    <meta name="twitter:description" content="{{ $description }}">
    <meta name="theme-color" content="#171a2b">
    <link rel="icon" href="data:,">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @if (request()->routeIs('home'))
        @php
            $organizationSchema = [
                '@context' => 'https://schema.org',
                '@type' => 'ProfessionalService',
                'name' => 'Nusa Indo Technology',
                'url' => url('/'),
                'description' => $description,
                'areaServed' => 'Indonesia',
                'serviceType' => ['IT consulting', 'Digital transformation', 'Public sector technology'],
                'audience' => ['Government organizations', 'Public sector institutions'],
                'email' => 'info@nusaindotech.com',
                'telephone' => '+62 878 5246 1990',
            ];
        @endphp
        <script type="application/ld+json">
            {!! json_encode($organizationSchema, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE) !!}
        </script>
    @endif
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
    <x-consultation-chat />
</body>
</html>
