<?php

namespace Tests\Feature;

use Illuminate\Support\Facades\Http;
use Tests\TestCase;

class ShowDetailTest extends TestCase
{
    public function test_all_shows_can_be_loaded_individually(): void
    {
        // Fetch all shows from Directus API directly
        $response = Http::withoutVerifying()->get('https://data.nafuna.africa/items/nafunatv_shows?limit=100');
        $this->assertTrue($response->successful());

        $shows = $response->json('data') ?? [];
        $this->assertNotEmpty($shows);

        foreach ($shows as $show) {
            $slug = $show['slug'];
            echo "\nTesting show slug: {$slug}";

            $detailResponse = $this->get("/show/{$slug}");
            $detailResponse->assertStatus(200);
        }
    }

    public function test_invalid_slug_redirects_to_home(): void
    {
        $response = $this->get('/show/invalid-non-existent-slug');
        $response->assertRedirect('/');
    }

    public function test_old_slug_redirects_to_new_slug(): void
    {
        $response = $this->get('/show/angry-mwana-the-beginning');
        $response->assertRedirect('/show/the-nafuna-devlog-s02e01-nafuna-avenues-mobile-game-and-animated-series-update');
    }
}
