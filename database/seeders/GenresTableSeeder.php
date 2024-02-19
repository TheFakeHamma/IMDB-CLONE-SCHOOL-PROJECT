<?php

namespace Database\Seeders;

use App\Models\Genre;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class GenresTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $genres = [
            'Action', 'Comedy', 'Drama', 'Fantasy', 'Horror', 
            'Mystery', 'Romance', 'Thriller', 'Sci-Fi', 'Documentary'
        ];

        foreach ($genres as $genre) {
            Genre::create(['name' => $genre]);
        }
    }
}
