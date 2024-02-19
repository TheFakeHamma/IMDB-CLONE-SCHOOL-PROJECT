<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Content;
use App\Models\Person;

class ContentPeopleTableSeeder extends Seeder
{
    public function run()
    {
        // Get all content and people
        $contents = Content::all();
        $people = Person::all();

        // Attach each content item to a random person with a random role
        $contents->each(function ($content) use ($people) {
            $randomPerson = $people->random();
            $roles = ['actor', 'director']; // Define possible roles here
            $content->people()->attach($randomPerson, ['role' => $roles[array_rand($roles)]]);
        });
    }
}

