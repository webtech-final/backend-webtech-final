<?php

namespace App\Http\Controllers;

use App\Models\Texture;
use Illuminate\Http\Request;
use App\Http\Controllers\UploadController;

class TextureController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $texture = Texture::orderBy('id')->get();
        return view('textures.index', ['textures' => $texture]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('textures.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $texture = new Texture();
        $texture->name = $request->input('name');

        // call upload API 
        $response = new UploadController();
        $response = $response->upload($request);

        $texture->uri = $response->getData()->data;
        $texture->save();

        return redirect()->route('textures.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Texture  $texture
     * @return \Illuminate\Http\Response
     */
    public function show(Texture $texture)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Texture  $texture
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $texture = Texture::findOrFail($id);
        return view('textures.edit', ['texture' => $texture]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Texture  $texture
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Texture $texture)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Texture  $texture
     * @return \Illuminate\Http\Response
     */
    public function destroy(Texture $texture)
    {
        //
    }
}
