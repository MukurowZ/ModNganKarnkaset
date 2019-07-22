<?php

namespace App\Http\Controllers;

use App\Model\Events;
use App\Http\Requests\EventsRequest;

class EventsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Events::all();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(EventsRequest $request)
    {
        $validated = $request->validated();
        $x = Contents::created([
            'owner_id' => $validated['owner_id'],
            'type' => 'Event'
        ]);
        $validated['id'] = $x['id'];
        return Activities::create($validated);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Model\Events  $events
     * @return \Illuminate\Http\Response
     */
    public function show(Events $events)
    {
        return $events;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Model\Events  $events
     * @return \Illuminate\Http\Response
     */
    public function update(EventsRequest $request, Events $events)
    {
        $validated = $request->validated();
        $events->update($validated);
        return $events;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Model\Events  $events
     * @return \Illuminate\Http\Response
     */
    public function destroy(Events $events)
    {
        $events->delete();
        return response('', 204);//
    }
}
