<div class="show-detail-content glass-panel">
    <div class="show-detail-meta">
        <a href="{{ route('home') }}" class="badge" style="text-decoration:none;">&larr; Back to Shows</a>
        <span class="badge">{{ $show->category->name }}</span>
    </div>
    
    <h1 class="show-detail-title">{{ $show->title }}</h1>
    
    <div class="video-container">
        @if($show->youtube_url)
            <iframe src="{{ $show->youtube_url }}" title="{{ $show->title }}" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
        @else
            <div style="display: flex; align-items: center; justify-content: center; height: 100%; color: var(--text-muted);">
                Video coming soon
            </div>
        @endif
    </div>
    
    <div class="show-detail-desc">
        {!! nl2br(e($show->description)) !!}
    </div>
</div>
