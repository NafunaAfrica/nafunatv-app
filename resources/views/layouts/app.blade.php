<!DOCTYPE html>
<html lang="en" class="dark">
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
<body class="min-h-screen bg-zinc-950 text-zinc-100 antialiased">
    <flux:header class="bg-zinc-950/80 backdrop-blur-md border-b border-zinc-900 sticky top-0 z-50 px-4 sm:px-6 lg:px-8">
        <a href="{{ url('/') }}" class="flex items-center">
            <img src="{{ asset('images/nafunatv-logo.svg') }}" alt="NafunaTV" class="h-8 w-auto">
        </a>

        <flux:spacer />

        <flux:navbar class="-mb-px gap-4 md:gap-6">
            <flux:navbar.item href="{{ url('/') }}" class="text-zinc-300 hover:text-white font-medium text-sm">Home</flux:navbar.item>
            <flux:navbar.item href="{{ url('/#web-series') }}" class="text-zinc-400 hover:text-white font-medium text-sm hidden sm:inline-flex">Web Series</flux:navbar.item>
            <flux:navbar.item href="{{ url('/#talk-discussion') }}" class="text-zinc-400 hover:text-white font-medium text-sm hidden sm:inline-flex">Talk Shows</flux:navbar.item>
            <flux:navbar.item href="{{ url('/#animation-tech') }}" class="text-zinc-400 hover:text-white font-medium text-sm hidden sm:inline-flex">Animations</flux:navbar.item>
            <flux:navbar.item href="https://nafuna.africa" target="_blank" class="text-zinc-400 hover:text-white font-medium text-sm">Visit Nafuna Africa</flux:navbar.item>
        </flux:navbar>
    </flux:header>

    <flux:main>
        {{ $slot }}
    </flux:main>

    <flux:footer class="py-12 border-t border-zinc-900 mt-20 text-center text-sm text-zinc-500">
        &copy; {{ date('Y') }} Nafuna Africa. Exploring Creative Frontiers.
    </flux:footer>

    @fluxScripts
    @livewireScripts
</body>
</html>
