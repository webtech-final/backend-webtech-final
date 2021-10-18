<?php

namespace App\Http\Controllers;

use App\Models\PointHistory;
use App\Models\PointRate;
use Illuminate\Http\Request;
use Illuminate\Queue\RedisQueue;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\View;
use PhpParser\Node\Expr\FuncCall;

class PointRateController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function __construct()
    {
        $this->middleware('auth:web');
    }
    public function index()
    {
        $rate = PointRate::orderByDesc('created_at')->limit(10)->get();
        $last = PointRate::orderBy('id')->get()->last();
        $pointlog = PointHistory::orderByDesc('created_at')->where('type', 'get')->with('user')->limit(10)->get();

        return view('rates.index', ['rate' => $rate, 'last' => $last, 'pointLog' => $pointlog]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $last = PointRate::orderBy('id')->get()->last();
        return view('rates.create', ['last' => $last]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(),  [
            'rate' => 'required|regex:/^[1-9]+[0-9]*/'
        ], $messages = [
            'regex' => 'เรทต้องเป็นจำนวนเต็มบวก ex. 1, 2, 10, 20 ',
            'required' => 'กรุณาใส่เรทที่จะเปลี่ยน'
        ])->validate();

        $pointrate = new PointRate();
        $pointrate->rate = $request->input('rate');
        $pointrate->save();
        session()->flash('ratestatus',  'Point Rate succesfully changed');
        return $this->index();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\PointRate  $pointRate
     * @return \Illuminate\Http\Response
     */
    public function show(PointRate $pointRate)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\PointRate  $pointRate
     * @return \Illuminate\Http\Response
     */
    public function change()
    {
        $last = PointRate::orderBy('id')->get()->last();
        $rate = PointRate::orderByDesc('created_at')->limit(10)->get();
        $pointlog = PointHistory::orderByDesc('created_at')->where('type', 'get')->with('user')->limit(10)->get();

        return view('rates.change', ['rate' => $rate, 'last' => $last, 'pointLog' => $pointlog]);
    }
    public function edit($id)
    {
        $last = PointRate::orderBy('id')->get()->last();
        return view('rates.edit', ['last' => $last]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\PointRate  $pointRate
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\PointRate  $pointRate
     * @return \Illuminate\Http\Response
     */
    public function destroy(PointRate $pointRate)
    {
        //
    }
}
