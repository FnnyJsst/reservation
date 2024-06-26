<?php

namespace Database\Seeders;

use App\Models\City;
use Illuminate\Database\Seeder;
use App\Models\User;
Use App\Models\Event;
use App\Models\Venue;

class DatabaseSeeder extends Seeder
{
    public function run()
    {
        $existingUser = User::where('email', 'test@example.com')->first();

        if (!$existingUser) {
            
            User::create([
                'name' => 'Test User',
                'email' => 'test@example.com',
                'password' => bcrypt('password'), // Remplacez 'password' par le mot de passe hashé souhaité
            ]);
        }

        City::factory(2)->has(Venue::factory()->count(5))->create();
        
        $this->call([
            EventSeeder::class
        ]);
    }
}