<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $title ?? 'NafunaTV | Premium African Streaming' }}</title>
    @if(isset($metaDescription))
        <meta name="description" content="{{ $metaDescription }}">
    @else
        <meta name="description" content="NafunaTV is the premier platform for web series, animation, and creative digital content by Nafuna Africa.">
    @endif
    
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;700;800&display=swap" rel="stylesheet">
    @vite(['resources/css/app.css'])
    @fluxAppearance
    @livewireStyles
</head>
<body class="min-h-screen bg-white dark:bg-zinc-800">
    <flux:header container class="bg-zinc-50 dark:bg-zinc-900 border-b border-zinc-200 dark:border-zinc-700">
        <a href="{{ url('/') }}" class="flex items-center gap-2">
            <img src="{{ asset('images/nafunatv-logo.svg') }}" alt="NafunaTV" class="h-8 w-auto">
            <span class="font-bold text-xl tracking-tight dark:text-white text-zinc-900">Nafuna<span class="text-indigo-500">TV</span></span>
        </a>

        <flux:spacer />

        <flux:navbar class="-mb-px">
            <flux:navbar.item href="https://nafuna.africa" target="_blank">Visit Nafuna Africa</flux:navbar.item>
        </flux:navbar>
    </flux:header>

    <flux:main>
        {{ $slot }}
    </flux:main>

    <flux:footer container class="mt-16 text-center text-sm text-zinc-500 dark:text-zinc-400">
        &copy; {{ date('Y') }} Nafuna Africa. Exploring Creative Frontiers.
    </flux:footer>

    @fluxScripts
    @livewireScripts
</body>
</html>
