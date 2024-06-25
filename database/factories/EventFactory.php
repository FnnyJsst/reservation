<?php

namespace Database\Factories;

use App\Models\Event;
use Illuminate\Database\Eloquent\Factories\Factory;

class EventFactory extends Factory
{
    protected $model = Event::class;

    public function definition() 
    
    {
        return [
            'title' => $this->faker->sentence(4),
            'description' => $this->faker->paragraph(),
            'city_id' => $this->faker->numberBetween(1, 10),
            'venue_id' => $this->faker->numberBetween(1, 5),
            'date' => $this->faker->dateTimeBetween('+1 week', '+1 year'),
        ];
    }
}
