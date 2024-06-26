<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Event;
use Faker\Factory as Faker;

class EventSeeder extends Seeder
{
    public function run()
    {
/*         $faker = Faker::create();

        for ($i = 0; $i < 10; $i++) {
            Event::create([
                'title' => $faker->sentence(4),
                'description' => $faker->paragraph(),
                'city_id' => $faker->numberBetween(1, 10),
                'venue_id' => $faker->numberBetween(1, 5),
                'date' => $faker->dateTimeBetween('+1 week', '+1 year'),
            ]);
        } */
        Event::factory()->count(10)->create();
    }
}

