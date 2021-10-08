<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\PlayHistory;
use Illuminate\Http\Request;

class PlayHistoryController extends Controller
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
        $playHistories = PlayHistory::get();
        return $playHistories;
    }

    public function single_log($id)
    {
        $playHistories = PlayHistory::where('user_id', $id)->where('mode', 'single')->orderby('created_at', 'DESC')->get();
        return $playHistories;
    }

    public function versus_log($id)
    {
        $playHistories = PlayHistory::where('user_id', $id)->where('mode', 'versus')->orderby('created_at', 'DESC')->get();
        return $playHistories;
    }

    public function single_index()
    {
        $playHistories = PlayHistory::with('user')->where('mode', 'single')->get();
        return $playHistories;
    }

    public function versus_index()
    {
        $playHistories = PlayHistory::with('user')->where('mode', 'versus')->get();
        return $playHistories;
    }

    public function top10_single_index()
    {
        $playHistories = PlayHistory::with('user')->where('mode', 'single')->orderby('score', 'DESC')->limit(10)->get();
        return $playHistories;
    }

    public function top10_versus_index()
    {
        $playHistories = PlayHistory::with('user')->where('mode', 'versus')->orderby('score', 'DESC')->limit(10)->get();
        return $playHistories;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $playHistory = new PlayHistory();
        $playHistory->score = $request->input('score');
        $playHistory->mode = $request->input('mode');
        $playHistory->user_id = $request->input('user_id');
        $playHistory->opponent = $request->input('opponent');
        $playHistory->result = $request->input("result");
        $playHistory->save();
        return $playHistory;
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\PlayHistory  $playHistory
     * @return \Illuminate\Http\Response
     */
    public function show(PlayHistory $playHistory)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\PlayHistory  $playHistory
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, PlayHistory $playHistory)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\PlayHistory  $playHistory
     * @return \Illuminate\Http\Response
     */
    public function destroy(PlayHistory $playHistory)
    {
        //
    }
}
