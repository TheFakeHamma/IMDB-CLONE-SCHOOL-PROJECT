<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run()
    {
        // Seed the genres first, as they don't depend on anything else
        $this->call(GenresTableSeeder::class);
        
        // Seed the people next, as they might be needed for the content_people table
        $this->call(PeopleTableSeeder::class);
        
        // Seed the users and content afterwards
        $this->call([
            UsersTableSeeder::class,
            ContentTableSeeder::class,
        ]);
        
        // Link the genres to the content and the people to the content
        $this->call([
            AttachGenresToContentSeeder::class,
            ContentPeopleTableSeeder::class,
        ]);
    }
}

