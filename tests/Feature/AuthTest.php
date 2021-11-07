<?php

namespace Tests\Feature;

use App\Models\Item;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\UploadedFile;
use Tests\TestCase;

class AuthTest extends TestCase
{
    use RefreshDatabase;

    /**
     * A basic feature test example.
     *
     * @return void
     */

    public function setUp() : void
    {
        parent::setUp();

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
    }

    public function test_access_login_page_with_auth()
    {
        // Access login path
        $response = $this->get('/login');

        // HTTP status code must be 302
        $response->assertStatus(302);
    }

    public function test_access_item_page_with_auth()
    {
        // Access item's page
        $response = $this->get(route('items.index'));

        // HTTP status code must be 200
        $response->assertStatus(200);
    }

    public function test_access_create_background_page_with_auth()
    {
        $response = $this->get('items/createBackground');

        // HTTP status code must be 200
        $response->assertStatus(200);
    }

    public function test_access_point_rate_page_with_auth()
    {
        $this->post(route('rate.store'), [
            'rate' => 300,
        ]);

        $response = $this->get('rate');

        // HTTP status code must be 200
        $response->assertStatus(200);
    }

    public function test_access_change_point_rate_page_with_auth()
    {
        $this->post(route('rate.store'), [
            'rate' => 400,
        ]);

        $response = $this->get(route('rate.change'));

        // HTTP status code must be 200
        $response->assertStatus(200);
    }

    public function test_access_edit_item_page_with_auth()
    {
        $file = UploadedFile::fake()
            ->image('testBG.jpg', 1024, 1024)
            ->size(1024);

        $this->post('items/storeBackground', [
            'name' => 'testBG',
            'price' => 10,
            'backgroundImage' => $file,
        ]);

        $lastItem = Item::all()->last();
        $response = $this->get('item/background/' . $lastItem->name);

        // HTTP status code must be 200
        $response->assertStatus(200);
    }
}
