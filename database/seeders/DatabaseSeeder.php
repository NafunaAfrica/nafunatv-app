<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Category;
use App\Models\Show;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        User::factory()->create([
            'name' => 'Admin User',
            'email' => 'admin@nafuna.tv',
        ]);

        $catWebSeries = Category::create([
            'name' => 'Web Series & Skits',
            'slug' => Str::slug('Web Series & Skits'),
            'description' => 'Entertaining web series and hilarious comedy skits from Nafuna Africa.',
        ]);

        $catTalk = Category::create([
            'name' => 'Talk & Discussion',
            'slug' => Str::slug('Talk & Discussion'),
            'description' => 'Deep discussions on trending and sensitive social topics, featuring The Couch and Twunyaya.',
        ]);

        $catTech = Category::create([
            'name' => 'Animation & Tech',
            'slug' => Str::slug('Animation & Tech'),
            'description' => 'Behind the scenes at Nafuna, animation showcases, and Nafuna Campus digital skills courses.',
        ]);

        Show::create([
            'category_id' => $catWebSeries->id,
            'title' => 'Angry Mwana - The Beginning',
            'slug' => Str::slug('Angry Mwana - The Beginning'),
            'description' => 'The very first episode of the hit comedy series Angry Mwana. Watch as our protagonist navigates the hilarious challenges of daily life in Zimbabwe.',
            'youtube_url' => 'https://www.youtube.com/embed/dQw4w9WgXcQ', 
            'meta_title' => 'Angry Mwana Episode 1 - Nafuna TV',
            'meta_description' => 'Watch the first episode of Angry Mwana, a hilarious Zimbabwean comedy web series by Nafuna Africa.',
        ]);

        Show::create([
            'category_id' => $catWebSeries->id,
            'title' => 'Angry Mwana - City Life',
            'slug' => Str::slug('Angry Mwana - City Life'),
            'description' => 'The laughs continue in episode 2 as Angry Mwana takes on the hustle and bustle of city life.',
            'youtube_url' => 'https://www.youtube.com/embed/dQw4w9WgXcQ', 
            'meta_title' => 'Angry Mwana City Life - Nafuna TV',
            'meta_description' => 'Episode 2 of Angry Mwana web series by Nafuna Africa.',
        ]);

        Show::create([
            'category_id' => $catTalk->id,
            'title' => 'The Couch: Trending Topics',
            'slug' => Str::slug('The Couch: Trending Topics'),
            'description' => 'Join the panel on The Couch as we dive deep into the most trending topics of the week. Unfiltered and honest conversations.',
            'youtube_url' => 'https://www.youtube.com/embed/dQw4w9WgXcQ',
            'meta_title' => 'The Couch - Nafuna TV Talk Show',
            'meta_description' => 'The Couch talk show discusses trending topics in Africa.',
        ]);

        Show::create([
            'category_id' => $catTalk->id,
            'title' => 'Twunyaya: Taboo Topics',
            'slug' => Str::slug('Twunyaya: Taboo Topics'),
            'description' => 'A special episode of Twunyaya addressing the social issues that people are usually afraid to talk about.',
            'youtube_url' => 'https://www.youtube.com/embed/dQw4w9WgXcQ',
            'meta_title' => 'Twunyaya Taboo Topics - Nafuna TV',
            'meta_description' => 'Twunyaya tackles the sensitive and taboo topics in modern society.',
        ]);

        Show::create([
            'category_id' => $catTech->id,
            'title' => 'Nafuna Campus: Digital Transformation',
            'slug' => Str::slug('Nafuna Campus: Digital Transformation'),
            'description' => 'A free educational course by Nafuna Campus introducing the key concepts of digital transformation and skills for the modern creative.',
            'youtube_url' => 'https://www.youtube.com/embed/dQw4w9WgXcQ',
            'meta_title' => 'Digital Transformation Course - Nafuna Campus',
            'meta_description' => 'Learn digital transformation skills with Nafuna Campus by Nafuna Africa.',
        ]);

        Show::create([
            'category_id' => $catTech->id,
            'title' => 'Behind the Scenes: Nafuna Animation',
            'slug' => Str::slug('Behind the Scenes: Nafuna Animation'),
            'description' => 'Get a rare glimpse into the creative process at Nafuna Africa. See how our animators bring characters to life.',
            'youtube_url' => 'https://www.youtube.com/embed/dQw4w9WgXcQ',
            'meta_title' => 'Behind the Scenes Animation - Nafuna Africa',
            'meta_description' => 'A behind the scenes look at the animation and creative process at Nafuna Africa.',
        ]);
    }
}
