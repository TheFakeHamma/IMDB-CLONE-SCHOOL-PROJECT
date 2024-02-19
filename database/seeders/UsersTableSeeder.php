<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;

class UsersTableSeeder extends Seeder
{
    public function run()
    {
        // Create 10 users with the role of 'user'
        User::factory()->count(10)->create();

        // Optionally, create a specific number of admin users
        User::factory()->count(2)->state([
            'role' => 'admin',
        ])->create();
    }
}
