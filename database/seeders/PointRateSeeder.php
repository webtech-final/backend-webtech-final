<?php

namespace Database\Seeders;

use App\Models\PointRate;
use Illuminate\Database\Seeder;

class PointRateSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        PointRate::factory()->count(10)->create();
    }
}
