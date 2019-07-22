<?php

namespace App\Http\Controllers;

use App\Model\Contents;
use Illuminate\Http\Request;
use App\Http\Requests\ContentsRequest;

class ContentsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Contents::all();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ContentsRequest $request)
    {
        $validated = $request->validated();
        return Contents::create($validated);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Model\Contents  $contents
     * @return \Illuminate\Http\Response
     */
    public function show(Contents $contents)
    {
        return $contents;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Model\Contents  $contents
     * @return \Illuminate\Http\Response
     */
    public function update(ContentsRequest $request, Contents $contents)
    {
        $validated = $request->validated();
        $contents->update($validated);
        return $contents;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Model\Contents  $contents
     * @return \Illuminate\Http\Response
     */
    public function destroy(Contents $contents)
    {
        $events->delete();
        return response('', 204);//
    }
}
