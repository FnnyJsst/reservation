<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\City;
use Illuminate\Database\Seeder;
use App\Models\Event;
use App\Models\Tag;
use App\Models\Venue;
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
        $tags = collect();
        foreach(['Humour', 'Fantastique', 'Contemporain', 'Classique'] as $tag) {
            $tags->push(Tag::create([
                'name' => $tag
            ]));
        }

        $cities = City::factory(10)->has(Venue::factory()->count(5))->create();
        
        Event::factory()
            ->count(10)
            ->recycle($cities)
            ->create()
            ->each(function (Event $event) use ($tags) {
                $event->tags()->attach($tags->random(2)->pluck('id'));
            })
        ;
    }
}

