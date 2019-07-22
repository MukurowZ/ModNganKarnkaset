<?php

namespace App\Http\Controllers;

use App\Model\Activities;
use App\Http\Requests\ActivitiesRequest;
use App\Model\Contents;

class ActivitiesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Activities::all();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ActivitiesRequest $request)
    {
        $validated = $request->validated();
        $x = Contents::created([
            'owner_id' => $validated['owner_id'],
            'type' => 'Activity'
        ]);
        $validated['id'] = $x['id'];
        return Activities::create($validated);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Model\Activities  $activities
     * @return \Illuminate\Http\Response
     */
    public function show(Activities $activities)
    {
        return $activities;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Model\Activities  $activities
     * @return \Illuminate\Http\Response
     */
    public function update(ActivitiesRequest $request, Activities $activities)
    {
        $validated = $request->validated();
        $activities->update($validated);
        return $activities;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Model\Activities  $activities
     * @return \Illuminate\Http\Response
     */
    public function destroy(Activities $activities)
    {
        $activities->delete();
        return response('', 204);
    }
}
