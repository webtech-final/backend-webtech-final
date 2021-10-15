<?php

namespace Database\Seeders;

use App\Models\Item;
use App\Models\ItemDetail;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

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
        $item->name =  "Default Block";
        $item->type =  "block";
        $item->point =  0;
        $item->save();

        $detail = new ItemDetail();
        $detail->item_id = $item->id;
        $detail->name = $item->name;
        $detail->image_path = 'storage/default/theme-default.jpg';
        $detail->save();

        $item = new Item();
        $item->name =  "Default Background";
        $item->type =  "background";
        $item->point =  0;
        $item->save();

        $detail = new ItemDetail();
        $detail->item_id = $item->id;
        $detail->name = $item->name;
        $detail->image_path = 'storage/default/background-default.jpg';
        $detail->save();
    }
}
