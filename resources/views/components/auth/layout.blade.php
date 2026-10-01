@props(['title' => 'Sign In'])
<!DOCTYPE html>
<html lang="en" class="scroll-smooth">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ $title }} | NIT Nusa Indo Technology Management</title>
    <meta name="robots" content="noindex, nofollow">
    <meta name="theme-color" content="#171a2b">
    <link rel="icon" href="data:,">
    @vite(['resources/css/admin.css', 'resources/js/admin.js'])
</head>
<body class="bg-navy text-charcoal antialiased">

    <div class="flex min-h-screen flex-col items-center justify-center px-6 py-12">

        <a href="{{ route('home') }}" class="mb-8 inline-flex rounded bg-white p-3">
            <img src="{{ app(\App\Support\SiteBrand::class)->logoUrl() }}" alt="NIT Nusa Indo Technology" class="w-64">
        </a>

        <div class="w-full max-w-md rounded-2xl bg-white p-8 shadow-2xl">
            {{ $slot }}
        </div>

        <p class="mt-6 text-xs text-white/40">&copy; {{ date('Y') }} NUSA INDO TECHNOLOGY. All rights reserved.</p>
    </div>

</body>
</html>
