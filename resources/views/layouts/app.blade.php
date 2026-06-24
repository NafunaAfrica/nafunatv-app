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
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    @livewireStyles
</head>
<body>
    <header class="main-header">
        <a href="{{ url('/') }}" class="logo">
            <img src="{{ asset('images/nafunatv-logo.svg') }}" alt="NafunaTV Logo">
        </a>
        <nav class="main-nav">
            <a href="https://nafuna.africa" target="_blank" class="banner-link">Visit Nafuna Africa</a>
        </nav>
    </header>
    
    <main>
        {{ $slot }}
    </main>

    <footer>
        <div class="footer-content">
            <a href="https://nafuna.africa" target="_blank" class="footer-banner">
                <h3>Discover More from Nafuna Africa</h3>
                <p>We are a digital media agency crafting world-class animation, film, and web experiences.</p>
                <span class="banner-link" style="display: inline-block;">Go to main website</span>
            </a>
            
            <p class="copyright">&copy; {{ date('Y') }} Nafuna Africa. Exploring Creative Frontiers.</p>
        </div>
    </footer>

    @livewireScripts
</body>
</html>
