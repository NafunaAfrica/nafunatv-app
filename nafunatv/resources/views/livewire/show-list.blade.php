<div class="glass-panel">
    @foreach($categories as $category)
        <section class="category-section">
            <header class="category-header">
                <h2 class="category-title">{{ $category->name }}</h2>
                <p class="category-desc">{{ $category->description }}</p>
            </header>
            
            <div class="shows-grid">
                @foreach($category->shows as $show)
                    <a href="{{ route('show.detail', $show->slug) }}" class="show-card">
                        <div class="show-thumbnail">
                        </div>
                        <div class="show-info">
                            <h3 class="show-title">{{ $show->title }}</h3>
                            <p class="show-desc">{{ Str::limit($show->description, 100) }}</p>
                            <span class="watch-btn">Watch Now</span>
                        </div>
                    </a>
                @endforeach
            </div>
        </section>
    @endforeach
</div>
