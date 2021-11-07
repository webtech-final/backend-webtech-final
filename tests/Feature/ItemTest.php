<?php

namespace Tests\Feature;

use App\Models\Item;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\UploadedFile;
use Tests\TestCase;

class ItemTest extends TestCase
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

    public function test_create_background_success()
    {
        // Mockup image size 1024 KB
        $file = UploadedFile::fake()
            ->image('testBG.jpg', 1024, 1024)
            ->size(1024);

        // Upload mockup image as background
        $response = $this->post('items/storeBackground', [
            'name' => 'testBG',
            'price' => 10,
            'backgroundImage' => $file,
        ]);

        // Must redirect to item's page
        $response->assertRedirect('/items');

        // Item's table must have mockup image
        $this->assertDatabaseHas('items', [
            'name' => 'testBG',
            'type' => 'background',
            'point' => 10,
        ]);

        // Item_detail's table must have mockup image detail
        $this->assertDatabaseHas('item_details', [
            'name' => 'backgroundImage',
        ]);
    }

    public function test_create_background_fail()
    {
        // Mockup image size 2100 MB
        $file = UploadedFile::fake()
            ->image('testBG.jpg', 1024, 1024)
            ->size(2150400);

        // Upload mockup image as background
        $response = $this->post('items/storeBackground', [
            'name' => 'testBG',
            'price' => 10,
            'backgroundImage' => $file,
        ]);

        // HTTP status code must be 302
        $response->assertStatus(302);
    }

    public function test_edit_background()
    {
        // Mockup image size 1024 KB
        $file = UploadedFile::fake()
            ->image('testBG.jpg', 1024, 1024)
            ->size(1024);

        // Upload mockup image as background
        $this->post('items/storeBackground', [
            'name' => 'testBG',
            'price' => 10,
            'backgroundImage' => $file,
        ]);

        $lastItem = Item::all()->last();

        $this->put('item/updatebg/' . $lastItem->id, [
            'name' => 'testBG_edited',
            'price' => 20,
            'backgroundImage' => $file,
        ]);

        $this->assertDatabaseHas('items', [
            'name' => 'testBG_edited',
            'type' => 'background',
            'point' => 20,
        ]);

        $this->assertDatabaseHas('item_details', [
            'name' => 'backgroundImage',
        ]);
    }

    public function test_delete_background()
    {
        // Mockup image size 1024 KB
        $file = UploadedFile::fake()
            ->image('testBG.jpg', 1024, 1024)
            ->size(1024);

        // Upload mockup image as background
        $this->post('items/storeBackground', [
            'name' => 'testBG',
            'price' => 10,
            'backgroundImage' => $file,
        ]);

        $lastItem = Item::all()->last();
        $this->delete('items/' . $lastItem->id);
        $lastItem = Item::onlyTrashed()->get()->last();
        $this->assertTrue($lastItem->deleted_at != null);
    }

    public function test_create_block_success()
    {
        // Upload mockup image as block set
        $response = $this->post(route('items.store'), [
            'name' => 'testBlock',
            'point' => 30,
            'blockS' => UploadedFile::fake()->image('testBlock1.jpg', 10, 10)->size(10),
            'blockZ' => UploadedFile::fake()->image('testBlock2.jpg', 10, 10)->size(10),
            'blockL' => UploadedFile::fake()->image('testBlock3.jpg', 10, 10)->size(10),
            'blockJ' => UploadedFile::fake()->image('testBlock4.jpg', 10, 10)->size(10),
            'blockT' => UploadedFile::fake()->image('testBlock5.jpg', 10, 10)->size(10),
            'blockO' => UploadedFile::fake()->image('testBlock6.jpg', 10, 10)->size(10),
            'blockI' => UploadedFile::fake()->image('testBlock7.jpg', 10, 10)->size(10),
        ]);

        // Must redirect to item's page
        $response->assertRedirect('/items');

        // Item's table must have mockup block set
        $this->assertDatabaseHas('items', [
            'name' => 'testBlock',
            'type' => 'block',
            'point' => 30,
        ]);

        // Item_detail's table must have each block name
        $this->assertDatabaseHas('item_details', [
            'name' => 'blockS',
        ]);
        $this->assertDatabaseHas('item_details', [
            'name' => 'blockZ',
        ]);
        $this->assertDatabaseHas('item_details', [
            'name' => 'blockL',
        ]);
        $this->assertDatabaseHas('item_details', [
            'name' => 'blockJ',
        ]);
        $this->assertDatabaseHas('item_details', [
            'name' => 'blockT',
        ]);
        $this->assertDatabaseHas('item_details', [
            'name' => 'blockO',
        ]);
        $this->assertDatabaseHas('item_details', [
            'name' => 'blockI',
        ]);
    }

    public function test_create_block_fail()
    {
        // Upload mockup image as block set
        $response = $this->post(route('items.store'), [
            'name' => 'testBlock',
            'point' => 30,
            'blockS' => UploadedFile::fake()->image('testBlock1.jpg', 10, 10)->size(101),
            'blockZ' => UploadedFile::fake()->image('testBlock2.jpg', 10, 10)->size(101),
            'blockL' => UploadedFile::fake()->image('testBlock3.jpg', 10, 10)->size(101),
            'blockJ' => UploadedFile::fake()->image('testBlock4.jpg', 10, 10)->size(101),
            'blockT' => UploadedFile::fake()->image('testBlock5.jpg', 10, 10)->size(101),
            'blockO' => UploadedFile::fake()->image('testBlock6.jpg', 10, 10)->size(101),
            'blockI' => UploadedFile::fake()->image('testBlock7.jpg', 10, 10)->size(101),
        ]);

        // HTTP status code must be 302
        $response->assertStatus(302);
    }

    public function test_edit_block() {
        // Upload mockup image as block set
        $this->post(route('items.store'), [
            'name' => 'testBlock',
            'point' => 30,
            'blockS' => UploadedFile::fake()->image('testBlock1.jpg', 10, 10)->size(10),
            'blockZ' => UploadedFile::fake()->image('testBlock2.jpg', 10, 10)->size(10),
            'blockL' => UploadedFile::fake()->image('testBlock3.jpg', 10, 10)->size(10),
            'blockJ' => UploadedFile::fake()->image('testBlock4.jpg', 10, 10)->size(10),
            'blockT' => UploadedFile::fake()->image('testBlock5.jpg', 10, 10)->size(10),
            'blockO' => UploadedFile::fake()->image('testBlock6.jpg', 10, 10)->size(10),
            'blockI' => UploadedFile::fake()->image('testBlock7.jpg', 10, 10)->size(10),
        ]);

        $lastItem = Item::all()->last();

        $this->put(route('items.update', $lastItem->id), [
            'name' => 'testBlock_edited',
            'price' => 300,
            'blockS' => UploadedFile::fake()->image('testBlock1.jpg', 10, 10)->size(10),
            'blockZ' => UploadedFile::fake()->image('testBlock2.jpg', 10, 10)->size(10),
            'blockL' => UploadedFile::fake()->image('testBlock3.jpg', 10, 10)->size(10),
            'blockJ' => UploadedFile::fake()->image('testBlock4.jpg', 10, 10)->size(10),
            'blockT' => UploadedFile::fake()->image('testBlock5.jpg', 10, 10)->size(10),
            'blockO' => UploadedFile::fake()->image('testBlock6.jpg', 10, 10)->size(10),
            'blockI' => UploadedFile::fake()->image('testBlock7.jpg', 10, 10)->size(10),
        ]);

        // Item's table must have mockup block set
        $this->assertDatabaseHas('items', [
            'name' => 'testBlock_edited',
            'type' => 'block',
            'point' => 300,
        ]);

        // Item_detail's table must have each block name
        $this->assertDatabaseHas('item_details', [
            'name' => 'blockS',
        ]);
        $this->assertDatabaseHas('item_details', [
            'name' => 'blockZ',
        ]);
        $this->assertDatabaseHas('item_details', [
            'name' => 'blockL',
        ]);
        $this->assertDatabaseHas('item_details', [
            'name' => 'blockJ',
        ]);
        $this->assertDatabaseHas('item_details', [
            'name' => 'blockT',
        ]);
        $this->assertDatabaseHas('item_details', [
            'name' => 'blockO',
        ]);
        $this->assertDatabaseHas('item_details', [
            'name' => 'blockI',
        ]);
    }

    public function test_delete_block()
    {
        // Upload mockup image as block set
        $this->post(route('items.store'), [
            'name' => 'testBlock',
            'point' => 30,
            'blockS' => UploadedFile::fake()->image('testBlock1.jpg', 10, 10)->size(10),
            'blockZ' => UploadedFile::fake()->image('testBlock2.jpg', 10, 10)->size(10),
            'blockL' => UploadedFile::fake()->image('testBlock3.jpg', 10, 10)->size(10),
            'blockJ' => UploadedFile::fake()->image('testBlock4.jpg', 10, 10)->size(10),
            'blockT' => UploadedFile::fake()->image('testBlock5.jpg', 10, 10)->size(10),
            'blockO' => UploadedFile::fake()->image('testBlock6.jpg', 10, 10)->size(10),
            'blockI' => UploadedFile::fake()->image('testBlock7.jpg', 10, 10)->size(10),
        ]);

        $lastItem = Item::all()->last();
        $this->delete('items/' . $lastItem->id);
        $lastItem = Item::onlyTrashed()->get()->last();
        $this->assertTrue($lastItem->deleted_at != null);
    }
}
