<?php

namespace Database\Seeders;

use App\Models\Content;
use App\Models\Genre;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AttachGenresToContentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $genres = Genre::all(); // Get all genres
        $contents = Content::all(); // Get all content items

        foreach ($contents as $content) {
            // For each content, attach a single random genre
            $randomGenre = $genres->random()->id;
            $content->genres()->sync([$randomGenre]); // Using sync to ensure only one genre per content
        }
    }
}
