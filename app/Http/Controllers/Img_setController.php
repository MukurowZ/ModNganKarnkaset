<?php

namespace App\Http\Controllers;

use App\Model\Img_set;
use App\Http\Requests\Img_setRequest;

class Img_setController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Img_set::all();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Img_setRequest $request)
    {
        $validated = $request->validated();
        return Img_set::create($validated);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Model\Img_set  $img_set
     * @return \Illuminate\Http\Response
     */
    public function show(Img_set $img_set)
    {
        return $img_set;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Model\Img_set  $img_set
     * @return \Illuminate\Http\Response
     */
    public function update(Img_setRequest $request, Img_set $img_set)
    {
        $validated = $request->validated();
        $img_set->update($validated);
        return $img_set;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Model\Img_set  $img_set
     * @return \Illuminate\Http\Response
     */
    public function destroy(Img_set $img_set)
    {
        $img_set->delete();
        return response('', 204);//
    }
}
