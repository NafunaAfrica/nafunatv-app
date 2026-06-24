<?php

namespace App\Livewire;

use Livewire\Component;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Cache;

class ShowList extends Component
{
    public function render()
    {
        // Cache Directus API response for 5 minutes to keep it fast
        $categories = Cache::remember('directus_categories_shows', 300, function () {
            // Fetch from Directus API
            $categoriesResponse = Http::get('https://data.nafuna.africa/items/nafunatv_categories');
            $showsResponse = Http::get('https://data.nafuna.africa/items/nafunatv_shows');
            
            if ($categoriesResponse->failed() || $showsResponse->failed()) {
                return [];
            }
            
            $cats = $categoriesResponse->json('data') ?? [];
            $shows = collect($showsResponse->json('data') ?? []);
            
            // Map shows to their respective categories
            return collect($cats)->map(function ($cat) use ($shows) {
                $obj = (object) $cat;
                $obj->shows = $shows->where('category_id', $obj->id)->map(function ($show) {
                    return (object) $show;
                })->values()->all();
                return $obj;
            })->all();
        });

        return view('livewire.show-list', [
            'categories' => $categories
        ])->layout('components.layouts.app');
    }
}
