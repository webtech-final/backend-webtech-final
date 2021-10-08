<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\PointRate;
use Illuminate\Http\Request;

class PointRateController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    public function lastRate()
    {
        $pointRate = PointRate::get()->last();
        return $pointRate;
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
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\PointRate  $pointRate
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, PointRate $pointRate)
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
