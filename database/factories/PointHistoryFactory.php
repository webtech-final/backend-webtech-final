<?php

namespace Database\Factories;

use App\Models\PointHistory;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class PointHistoryFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = PointHistory::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $user_id = User::all()->random()->id;
        return [
            "user_id" => $user_id,
            "point" => $this->faker->numberBetween(3, 100),
            "type" => $this->faker->randomElement(["use", "get"])
        ];
    }
}
