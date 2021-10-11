<?php

namespace Database\Seeders;

use App\Models\PointHistory;
use Illuminate\Database\Seeder;

class PointHistorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        PointHistory::factory()->count(60)->create();
    }
}
