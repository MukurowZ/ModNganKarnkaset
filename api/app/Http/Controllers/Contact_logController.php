<?php

namespace App\Http\Controllers;

use App\Model\Contact_log;
use App\Http\Requests\Contact_logRequest;

class Contact_logController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Contact_log::all();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Contact_logRequest $request)
    {
        $validated = $request->validated();
        return Contact_log::create($validated);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Model\Contact_log  $contact_log
     * @return \Illuminate\Http\Response
     */
    public function show(Contact_log $contact_log)
    {
        return $contact_log;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Model\Contact_log  $contact_log
     * @return \Illuminate\Http\Response
     */
    public function update(Contact_logRequest $request, Contact_log $contact_log)
    {
        $validated = $request->validated();
        $contact_log->update($validated);
        return $contact_log;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Model\Contact_log  $contact_log
     * @return \Illuminate\Http\Response
     */
    public function destroy(Contact_log $contact_log)
    {
        $contact_log->delete();
        return response('', 204);//
    }
}
