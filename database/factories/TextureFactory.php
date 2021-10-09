<?php

namespace Database\Factories;

use App\Models\Texture;
use Illuminate\Database\Eloquent\Factories\Factory;

class TextureFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Texture::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name' => $this->faker->word(),
            'uri' => $this->faker->regexify('image\/[A-Z0-9._%+-]+[A-Z0-9.-]+\.[A-Z]{2,4}'),
        ];
    }
}
