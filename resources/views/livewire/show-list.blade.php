<div>
    <section class="hero-section">
        <img src="{{ asset('images/hero_banner.png') }}" alt="NafunaTV Hero" class="hero-bg">
        <div class="hero-overlay"></div>
        <div class="hero-content">
            <h1 class="hero-title">Discover African Creativity</h1>
            <p class="hero-subtitle">Stream the best original web series, talk shows, and documentaries from Nafuna Africa.</p>
        </div>
    </section>

    <div class="glass-panel">
        @foreach($categories as $category)
            <section class="category-section">
                <header class="category-header">
                    <h2 class="category-title">{{ $category->name }}</h2>
                    <p class="category-desc">{{ $category->description }}</p>
                </header>
                
                <div class="shows-grid">
                    @foreach($category->shows as $show)
                        @php
                            // Extract YouTube ID from URL
                            $ytId = null;
                            if (preg_match('/embed\/([a-zA-Z0-9_-]+)/', $show->youtube_url, $matches)) {
                                $ytId = $matches[1];
                            } elseif (preg_match('/watch\?v=([a-zA-Z0-9_-]+)/', $show->youtube_url, $matches)) {
                                $ytId = $matches[1];
                            }
                            $thumbnailUrl = $ytId ? "https://img.youtube.com/vi/{$ytId}/maxresdefault.jpg" : asset('images/hero_banner.png');
                        @endphp
                        
                        <a href="{{ route('show.detail', $show->slug) }}" class="show-card">
                            <div class="show-thumbnail">
                                <img src="{{ $thumbnailUrl }}" alt="{{ $show->title }} Thumbnail">
                                <div class="play-overlay">
                                    <div class="play-icon">&#9658;</div>
                                </div>
                            </div>
                            <div class="show-info">
                                <h3 class="show-title">{{ $show->title }}</h3>
                                <p class="show-desc">{{ Str::limit($show->description, 110) }}</p>
                            </div>
                        </a>
                    @endforeach
                </div>
            </section>
        @endforeach
    </div>
</div>
