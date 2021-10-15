<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Item;
use App\Models\User;
use Illuminate\Http\Request;

class ItemController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $items = Item::with('itemDetails')->get();
        return $items;
    }

    public function inventory_block($id)
    {
        $items = Item::whereHas('users', function ($q) use ($id) {
            $q->where('user_id', $id);
        })->where('type', 'block')->get();
        return $items;
    }
    public function inventory_background($id)
    {
        $items = Item::whereHas('users', function ($q) use ($id) {
            $q->where('user_id', $id);
        })->where('type', 'background')->get();
        return $items;
    }

    //get equipped block
    public function equipped_block($id)
    {
        $item = Item::whereHas('users', function ($q) use ($id) {
            $q->where('user_id', $id)->where('equipped', true);
        })->where('type', 'block')->get();
        return $item;
    }
    //get equipped background
    public function equipped_background($id)
    {
        $item = Item::whereHas('users', function ($q) use ($id) {
            $q->where('user_id', $id)->where('equipped', true);
        })->where('type', 'background')->get();
        return $item;
    }
    //change equipped item
    public function equip_item(Request $request, $id)
    {
        $user = User::with('items')->find($id);
        $user->items()->updateExistingPivot($request->input('equipped_id'), ['equipped' => false]);
        $user->items()->updateExistingPivot($request->input('equip_id'), ['equipped' => true]);
        $user->save();
        $user = User::with('items')->find($id);
        return $user;
    }


    public function shop_block($id)
    {

        $items = Item::where('type', 'block')->get();
        $haveitems = Item::whereHas('users', function ($q) use ($id) {
            $q->where('user_id', $id);
        })->where('type', 'block')->with('itemDetails')->get();

        $key = 0;
        foreach ($items as $item) {
            foreach ($haveitems as $haveitem) {
                if ($item == $haveitem) {
                    unset($items[$key]);
                }
            }
            $key++;
        }
        return $items;
    }
    public function shop_background($id)
    {

        $items = Item::where('type', 'background')->get();
        $haveitems = Item::whereHas('users', function ($q) use ($id) {
            $q->where('user_id', $id);
        })->where('type', 'background')->get();
        $key = 0;
        foreach ($items as $item) {
            foreach ($haveitems as $haveitem) {
                if ($item == $haveitem) {
                    unset($items[$key]);
                }
            }
            $key++;
        }
        return $items;
    }
    public function buy_item(Request $request, $id)
    {
        $user = User::find($id);
        $user->items()->attach($request->input('item_id'));
        $user->save();
        $user = User::with('items')->find($id);
        return $user;
    }



    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $item = new Item();
        $item->name = $request->input('name');
        $item->type = $request->input('type');
        $item->point = $request->input('point');
        $item->save();
        return $item;
    }

    public function shop()
    {
        $item = Item::with('itemDetails')->get();
        return $item;
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Item  $item
     * @return \Illuminate\Http\Response
     */
    public function show(Item $item)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Item  $item
     * @return \Illuminate\Http\Response
     */

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Item  $item
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Item $item)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Item  $item
     * @return \Illuminate\Http\Response
     */
    public function destroy(Item $item)
    {
        //
    }
}
