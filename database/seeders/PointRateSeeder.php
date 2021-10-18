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
        $newRate = new PointRate;
        $newRate->rate = 100;
        $newRate->save();
        // PointRate::factory()->count(10)->create();
    }
}
