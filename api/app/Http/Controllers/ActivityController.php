<?php

namespace App\Http\Controllers;

use App\Model\Activity;
use App\Http\Requests\ActivityRequest;
use App\Model\Contents;

class ActivityController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Activity::all();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ActivityRequest $request)
    {
        $validated = $request->validated();
        $x = Content::created([
            'owner_id' => $validated['owner_id'],
            'type' => 'Activity'
        ]);
        $validated['id'] = $x['id'];
        return Activity::create($validated);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Model\Activity  $activity
     * @return \Illuminate\Http\Response
     */
    public function show(Activity $activity)
    {
        return $activity;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Model\Activity  $activity
     * @return \Illuminate\Http\Response
     */
    public function update(ActivityRequest $request, Activity $activity)
    {
        $validated = $request->validated();
        $activity->update($validated);
        return $activity;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Model\Activity  $activity
     * @return \Illuminate\Http\Response
     */
    public function destroy(Activity $activity)
    {
        $activity->delete();
        return response('', 204);
    }
}
