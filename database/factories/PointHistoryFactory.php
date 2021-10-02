<?php

namespace Database\Factories;

use App\Models\PointHistory;
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
        return [
            "point" => $this->faker->numberBetween(3,100),
            "user_id"=> 1,
            "type" => $this->faker->randomElement(["use","get"])
        ];
    }
}
