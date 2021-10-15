<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();
        $this->call(ItemSeeder::class);
        $this->call(UserSeeder::class);
        $this->call(PlayHistorySeeder::class);
        $this->call(PointRateSeeder::class);
        $this->call(PointHistorySeeder::class);
        
    }
}
