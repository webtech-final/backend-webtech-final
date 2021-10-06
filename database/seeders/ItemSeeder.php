<?php

namespace Database\Seeders;

use App\Models\Item;
use Illuminate\Database\Seeder;

class ItemSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $item = new Item();
        $item->name =  "Default";
        $item->type =  "block";
        $item->point =  0;
        $item->save();

        $item = new Item();
        $item->name =  "Default";
        $item->type =  "background";
        $item->point =  0;
        $item->save();
    }
}
