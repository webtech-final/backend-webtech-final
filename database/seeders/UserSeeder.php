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

        $user = new User();
        $user->name =  "admin";
        $user->email = "admin@admin.com";
        $user->password = bcrypt("1234");
        $user->role = "admin";
        $user->save();

        User::factory()->count(9)->create();
    }
}
