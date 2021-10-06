<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = new User();
        $user->name =  "AUI2488";
        $user->email = "aui2488@aui.com";
        $user->password = bcrypt("Aui2488");
        $user->role = "user";
        $user->save();

        User::factory()->count(9)->create();
    }
}
