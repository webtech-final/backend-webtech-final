<?php

namespace Database\Factories;

use App\Models\PlayHistory;
use Illuminate\Database\Eloquent\Factories\Factory;

class PlayHistoryFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = PlayHistory::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'user_id' => 1,
            'score' => $this->faker->numberBetween(0,2000000),
            'mode' => $this->faker->randomElement(['single','versus'])
        ];
    }
}
