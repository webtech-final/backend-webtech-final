<?php

namespace Tests\Feature;

use App\Models\User;
use Tests\TestCase;

class PointRateTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */

    public function test_update_point_rate()
    {
        // Mockup admin account
        $user = new User();
        $user->name = 'admin';
        $user->email = 'admin@admin.com';
        $user->password = bcrypt('1234');
        $user->role = 'admin';
        $user->save();

        // Login with admin account
        $this->post('/login', [
            'email' => 'admin@admin.com',
            'password' => '1234',
        ]);

        // Update new point rate
        $response = $this->post(route('rate.store'), [
            'rate' => 400,
        ]);

        // Value must be 400
        $this->assertDatabaseHas('point_rates', [
            'rate' => 400
        ]);

        // HTTP status code must be 200
        $response->assertStatus(200);
    }
}
