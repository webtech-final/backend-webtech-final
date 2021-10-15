<?php

namespace App\Http\Controllers;

use App\Http\Requests\ItemRequest;
use App\Models\Item;
use App\Models\ItemDetail;
use Illuminate\Auth\Events\Validated;
use Illuminate\Http\Request;

class ItemController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function index()
    {
        //
        $items = Item::orderBy('id')->with('itemDetails')->get();
        return view('items.index', ['items' => $items,]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('items.create');
    }

    public function createBackground()
    {
        return view('items.createBackground');
    }

    public function storeBackground(ItemRequest $request)
    {
        $validated = $request->validated();
        ddd($validated);
        if ($validated) {
            ddd("success");
        }
        $item = new Item();
        $item->name = $request->input('name');
        $item->type = 'background';
        $item->point = $request->input('point');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ItemRequest $request)
    {
        // $validated = $request->validated();
        // if (!$validated) {
        // ddd("success", $validated['name']);
        // }
        $item = new Item();
        $item->name = $request->input('name');
        $item->type = 'block';
        $item->point = $request->input('point');
        $lists = [
            'blockS',
            'blockZ',
            'blockL',
            'blockJ',
            'blockT',
            'blockO',
            'blockI'
        ];

        $item->save();
        // call upload API 
        foreach ($lists as  $blockName) {
            # code...
            $myrequest = new UploadController();
            $response = $myrequest->uploadBlock($request, $blockName);
            $detail = new ItemDetail();
            $detail->item_id = $item->id;
            $detail->name = $response->getData()->image_name;
            $detail->image_path = $response->getData()->data;
            $detail->save();
        }
        return redirect()->route('items.index');
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
    public function showBySlug($slug)
    {
        $items = Item::whereName($slug)->firstOrFail();
        $items->itemDetails;
        if (count($items->itemDetails) > 0) {
            $itemDetail = $items->itemDetails[0];
            // ddd($itemDetail->image_path, gettype($itemDetail));
            return view('items.show', ['items' => $items, 'itemDetail' => $itemDetail]);
        }
        return view('items.show', ['items' => $items]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Item  $item
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $items = Item::findOrFail($id);
        $items->itemDetails;
        return view('items.edit', ['items' => $items]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Item  $item
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
        foreach ($request->files as $key => $value) {
            # code...
            $upload = new UploadController();
            $res = $upload->updateBlock($request, $key);
        }
        $items = Item::all();

        return redirect()->route('items.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Item  $item
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $item = Item::findOrFail($id);
        if ($item->id > 2) {
            foreach ($item->itemDetails as $key => $value) {
                # code...
                $value->delete();
            }
            $item->delete();
        }
        return redirect()->route('items.index');
    }
}
