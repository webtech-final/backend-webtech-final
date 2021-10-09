<?php

namespace Database\Seeders;

use App\Models\Texture;
use Illuminate\Database\Seeder;

class TextureSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Texture::factory()->count(10)->create();
    }
}
