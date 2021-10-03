<?php

namespace Database\Factories;

use App\Models\PlayHistory;
use App\Models\User;
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
        $user_id = User::all()->random()->id;
        return [
            'user_id' => $user_id,
            'score' => $this->faker->numberBetween(0, 5000),
            'mode' => $this->faker->randomElement(['single', 'versus'])
        ];
    }
}
