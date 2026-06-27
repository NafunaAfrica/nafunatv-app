<?php

namespace App\Livewire;

use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Http;
use Livewire\Attributes\Layout;
use Livewire\Component;

#[Layout('layouts.app')]
class ShowList extends Component
{
    public function render()
    {
        // Cache raw arrays to avoid PHP incomplete class serialization errors
        $categoriesData = Cache::remember('directus_categories_shows_v3', 300, function () {
            // Fetch from Directus API
            $categoriesResponse = Http::withoutVerifying()->get('https://data.nafuna.africa/items/nafunatv_categories');
            $showsResponse = Http::withoutVerifying()->get('https://data.nafuna.africa/items/nafunatv_shows');

            if ($categoriesResponse->failed() || $showsResponse->failed()) {
                return [];
            }

            $cats = $categoriesResponse->json('data') ?? [];
            $shows = collect($showsResponse->json('data') ?? []);

            // Map shows to their respective categories as pure arrays
            return collect($cats)->map(function ($cat) use ($shows) {
                $cat['shows'] = $shows->where('category_id', $cat['id'])->values()->all();

                return $cat;
            })->all();
        });

        // Convert to objects right before passing to the view so Blade syntax ($category->name) works
        $categories = collect($categoriesData)->map(function ($cat) {
            $obj = (object) $cat;
            $obj->shows = collect($cat['shows'] ?? [])->map(function ($show) {
                $showObj = (object) $show;
                $showObj->youtube_id = $this->getYoutubeId($showObj->youtube_url);
                $showObj->thumbnail_url = $showObj->youtube_id
                    ? "https://img.youtube.com/vi/{$showObj->youtube_id}/hqdefault.jpg"
                    : asset('images/hero_banner.png');

                return $showObj;
            })->all();

            return $obj;
        })->all();

        // Select a featured show for the hero banner (prefer JBoss Dai or first available show)
        $featuredShow = null;
        foreach ($categories as $cat) {
            foreach ($cat->shows as $show) {
                if ($show->slug === 'jboss-dai-official-music-video') {
                    $featuredShow = $show;
                    break 2;
                }
            }
        }

        // Fallback to first show if no specific match
        if (! $featuredShow && ! empty($categories)) {
            foreach ($categories as $cat) {
                if (! empty($cat->shows)) {
                    $featuredShow = $cat->shows[0];
                    break;
                }
            }
        }

        return view('livewire.show-list', [
            'categories' => $categories,
            'featuredShow' => $featuredShow,
        ]);
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
}
