<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\Attributes\Layout;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Cache;

#[Layout('layouts.app')]
class ShowList extends Component
{
    public function render()
    {
        // Cache raw arrays to avoid PHP incomplete class serialization errors
        $categoriesData = Cache::remember('directus_categories_shows_array', 300, function () {
            // Fetch from Directus API
            $categoriesResponse = Http::get('https://data.nafuna.africa/items/nafunatv_categories');
            $showsResponse = Http::get('https://data.nafuna.africa/items/nafunatv_shows');
            
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
                return (object) $show;
            })->all();
            return $obj;
        })->all();

        return view('livewire.show-list', [
            'categories' => $categories
        ]);
    }
}
