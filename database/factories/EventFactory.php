<?php

namespace Database\Factories;

use App\Models\Category;
use App\Models\City;
use App\Models\Event;
use App\Models\Venue;
use Illuminate\Database\Eloquent\Factories\Factory;


class EventFactory extends Factory
{
    protected $model = Event::class;

    public function definition() 

    {
        return [
            'title' => $this->faker->sentence(4),
            'artists' => $this->faker->name(),
            'description' => $this->faker->paragraph(),
            'city_id' => City::factory(),//$this->faker->numberBetween(1, 10),
            'venue_id' => Venue::factory(),
            'date' => $this->faker->dateTimeBetween('+1 week', '+1 year'),
        ];
    }
}
