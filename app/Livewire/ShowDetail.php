<?php

namespace App\Livewire;

use Illuminate\Support\Facades\Http;
use Livewire\Attributes\Layout;
use Livewire\Component;

#[Layout('layouts.app')]
class ShowDetail extends Component
{
    public $show;

    public $relatedShows = [];

    public function mount($slug)
    {
        $redirectMap = [
            'angry-mwana-the-beginning' => 'the-nafuna-devlog-s02e01-nafuna-avenues-mobile-game-and-animated-series-update',
            'angry-mwana-city-life' => 'nafuna-africa-explainer-part-01',
            'the-couch-trending-topics' => 'the-nafuna-devlog-november-edition',
            'twunyaya-taboo-topics' => 'we-stopped-making-just-videos-heres-why-annual-report-2026',
            'nafuna-campus-digital-transformation' => 'nafuna-campus-free-digital-transformation-101-lesson-01',
            'behind-the-scenes-nafuna-animation' => 'a-style-test-rigging-in-moho-african-animation',
        ];

        if (array_key_exists($slug, $redirectMap)) {
            return redirect()->route('show.detail', ['slug' => $redirectMap[$slug]]);
        }

        // Fetch specific show from Directus API
        $response = Http::withoutVerifying()->get('https://data.nafuna.africa/items/nafunatv_shows', [
            'filter' => [
                'slug' => [
                    '_eq' => $slug,
                ],
            ],
            // Include category_id relation data (for $show->category->name)
            'fields' => ['*', 'category_id.name'],
        ]);

        $shows = $response->json('data') ?? [];

        if (empty($shows)) {
            return redirect()->route('home');
        }

        $this->show = (object) $shows[0];

        // Format YouTube URL to embed format if needed
        $ytId = $this->getYoutubeId($this->show->youtube_url);
        if ($ytId) {
            $this->show->youtube_url = "https://www.youtube.com/embed/{$ytId}?autoplay=1";
        }

        // Map category_id relation to category for Blade view
        if (isset($this->show->category_id) && is_array($this->show->category_id)) {
            $this->show->category = (object) $this->show->category_id;
            $catId = $this->show->category_id['id'] ?? null;
        } elseif (isset($this->show->category_id) && is_string($this->show->category_id)) {
            $this->show->category = (object) ['name' => 'Show Category'];
            $catId = $this->show->category_id;
        } else {
            $this->show->category = (object) ['name' => 'Uncategorized'];
            $catId = null;
        }

        // Fetch related shows in same category (excluding current)
        if ($catId) {
            $relatedResponse = Http::withoutVerifying()->get('https://data.nafuna.africa/items/nafunatv_shows', [
                'filter' => [
                    'category_id' => [
                        '_eq' => $catId,
                    ],
                    'id' => [
                        '_neq' => $this->show->id,
                    ],
                ],
                'limit' => 4,
            ]);

            $relatedData = $relatedResponse->json('data') ?? [];
            $this->relatedShows = collect($relatedData)->map(function ($show) {
                $showObj = (object) $show;
                $ytId = $this->getYoutubeId($showObj->youtube_url);
                $showObj->thumbnail_url = $ytId
                    ? "https://img.youtube.com/vi/{$ytId}/hqdefault.jpg"
                    : asset('images/hero_banner.png');

                return $showObj;
            })->all();
        }
    }

    private function getYoutubeId(?string $url): ?string
    {
        if (! $url) {
            return null;
        }

        if (preg_match('/embed\/([a-zA-Z0-9_-]+)/', $url, $matches)) {
            return $matches[1];
        }

        if (preg_match('/watch\?v=([a-zA-Z0-9_-]+)/', $url, $matches)) {
            return $matches[1];
        }

        if (preg_match('/youtu\.be\/([a-zA-Z0-9_-]+)/', $url, $matches)) {
            return $matches[1];
        }

        return null;
    }

    public function render()
    {
        return view('livewire.show-detail')
            ->layout('layouts.app', [
                'title' => $this->show->meta_title ?? $this->show->title.' | NafunaTV',
                'metaDescription' => $this->show->meta_description ?? $this->show->description,
            ]);
    }
}
