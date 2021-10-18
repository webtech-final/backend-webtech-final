<?php

namespace App\Http\Controllers;

use App\Http\Requests\BackgroundEditRequest;
use App\Http\Requests\BackgroundRequest;
use App\Http\Requests\ItemEditRequest;
use App\Http\Requests\ItemRequest;
use App\Models\Item;
use App\Models\ItemDetail;
use Illuminate\Auth\Events\Validated;
use Illuminate\Http\Request;
use Symfony\Component\Console\Input\Input;

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
        // get block
        $items = Item::orderBy('id')->where('type', 'block')->with('itemDetails')->get();
        // get background
        $bg = Item::orderBy('id')->where('type', 'background')->with('itemDetails')->get();
        return view('items.index', ['items' => $items, 'bg' => $bg]);
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

    public function storeBackground(BackgroundRequest $request)
    {
        $validated = $request->validated();
        $item = new Item();
        $item->name = $request->input('name');
        $item->type = 'background';
        $item->point = $request->input('price');
        $item->save();
        $myrequest = new UploadController();
        $response = $myrequest->uploadBlock($request,  'backgroundImage', $item->id);
        $detail = new ItemDetail();
        $detail->item_id = $item->id;
        $detail->name = $response->getData()->image_name;
        $detail->image_path = $response->getData()->data;
        $detail->save();

        session()->flash('message', $item->name . ' succesfully created');
        return redirect()->route('items.index');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ItemRequest $request)
    {
        $validated = $request->validated();
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
            $response = $myrequest->uploadBlock($request, $blockName, $item->id);
            $detail = new ItemDetail();
            $detail->item_id = $item->id;
            $detail->name = $response->getData()->image_name;
            $detail->image_path = $response->getData()->data;
            $detail->save();
        }
        session()->flash('message', $item->name . ' succesfully created');
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
    public function showBySlug($type, $slug)
    {
        $items = Item::whereName($slug)->where('type', $type)->firstOrFail();
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
        if ($items->type === 'block') {
            return view('items.edit', ['items' => $items]);
        }
        return view('items.editBackground', ['items' => $items]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Item  $item
     * @return \Illuminate\Http\Response
     */
    public function updateBackground(BackgroundEditRequest $request, $id)
    {
        //
        $validated = $request->validated();
        $item = Item::findOrFail($id);
        $item->name = $request->input('name');
        $item->point = $request->input('price');
        $item->save();
        foreach ($request->files as $key => $value) {
            # code...
            $upload = new UploadController();
            $res = $upload->uploadBlock($request, $key, $id);
            foreach ($item->itemDetails as $k => $v) {
                # code...
                if ($v->name === $key) {
                    $v->image_path = $res->getData()->data;
                    $v->save();
                    break;
                }
            }
        }
        session()->flash('message', $item->name . ' succesfully updated');
        return redirect()->route('items.index');
    }
    public function update(ItemEditRequest $request, $id)
    {
        //
        $validated = $request->validated();
        $item = Item::findOrFail($id);
        $item->name = $request->input('name');
        $item->point = $request->input('price');
        $item->save();
        foreach ($request->files as $key => $value) {
            # code...
            $upload = new UploadController();
            $res = $upload->uploadBlock($request, $key, $id);
            foreach ($item->itemDetails as $k => $v) {
                # code...
                if ($v->name === $key) {
                    $v->image_path = $res->getData()->data;
                    $v->save();
                    break;
                }
            }
        }
        session()->flash('message', $item->name . ' succesfully updated');
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
            $detail = ItemDetail::where('item_id', $id);
            $detail->delete();
            $item->delete();
            session()->flash('message', $item->name . ' succesfully deleted');
        }
        return redirect()->route('items.index');
    }
}
