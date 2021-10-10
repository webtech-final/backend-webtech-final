<?php

namespace App\Http\Controllers;

use App\Models\Item;
use App\Models\ItemDetail;
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
        $item = Item::orderBy('id')->get();
        $details = ItemDetail::get();
        return view('items.index', ['items' => $item, 'details' => $details]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $list = Item::pluck('type')->unique();
        return view('items.create', ['list' => $list]);
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
        $myrequest = new UploadController();
        if (count($request->file('selectedImage')) > 1) {
            $response = $myrequest->uploadBlock($request, $item);
        } else {
            // call upload API 
            $response = $myrequest->upload($request);
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

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Item  $item
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $item = Item::findOrFail($id);
        return view('items.edit', ['item' => $item]);
    }

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
