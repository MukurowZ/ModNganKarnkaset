<?php

namespace App\Http\Controllers;

use App\Model\Activity;
use App\Http\Requests\ActivityRequest;
use App\Model\Content;

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
        $x = Content::create([
            'owner_id' => $validated['owner_id'],
            'type' => 'activity'
        ]);
        $validated['id'] = $x['id'];
        Activity::create($validated);
        return redirect()->view('../event');
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
        if($activity->delete()){
            Content::find($activity['id'])->delete();
        }
        return back(response('', 204));
    }

    // GET FIRST 3
    public function getThree(){ return Activity::orderBy('id', 'desc')->take(3)->get();}

}
