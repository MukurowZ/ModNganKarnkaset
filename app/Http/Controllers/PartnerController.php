<?php

namespace App\Http\Controllers;

use App\Model\Partner;
use App\Http\Requests\PartnerRequest;

class PartnerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Partner::all();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(PartnerRequest $request)
    {
        $validated = $request->validated();
        return Partner::create($validated);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Model\Partner  $partner
     * @return \Illuminate\Http\Response
     */
    public function show(Partner $partner)
    {
        return $partner;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Model\Partner  $partner
     * @return \Illuminate\Http\Response
     */
    public function update(PartnerRequest $request, Partner $partner)
    {
        $validated = $request->validated();
        $partner->update($validated);
        return $partner;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Model\Partner  $partner
     * @return \Illuminate\Http\Response
     */
    public function destroy(Partner $partner)
    {
        $partner->delete();
        return response('', 204);
    }
}
