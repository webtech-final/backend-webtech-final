<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\PointHistory;
use Illuminate\Http\Request;

class PointHistoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function __construct()
    {
        $this->middleware('auth:api', [
            'only' => ['store']
        ]);
    }

    public function index()
    {
        $pointHistories = PointHistory::get();
        return $pointHistories;
    }

    public function use_index()
    {
        $pointHistories = PointHistory::with('user')->where('type', 'use')->get();
        return $pointHistories;
    }

    public function get_index()
    {
        $pointHistories = PointHistory::with('user')->where('type', 'get')->get();
        return $pointHistories;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $pointHistory = new PointHistory();
        $pointHistory->point = $request->input('point');
        $pointHistory->type = $request->input('type');
        $pointHistory->user_id = $request->input('user_id');
        $pointHistory->save();
        return $pointHistory;
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\PointHistory  $pointHistory
     * @return \Illuminate\Http\Response
     */
    public function show(PointHistory $pointHistory)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\PointHistory  $pointHistory
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, PointHistory $pointHistory)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\PointHistory  $pointHistory
     * @return \Illuminate\Http\Response
     */
    public function destroy(PointHistory $pointHistory)
    {
        //
    }
}
