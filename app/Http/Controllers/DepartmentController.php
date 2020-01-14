<?php

namespace App\Http\Controllers;

use App\Model\Department;
use App\Http\Requests\DepartmentRequest;

class DepartmentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Department::all();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(DepartmentRequest $request)
    {
        $validated = $request->validated();
        Department::create($validated);
        response('', 200);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Model\Department  $departments
     * @return \Illuminate\Http\Response
     */
    public function show(Department $department)
    {
        return $department;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Model\Department  $departments
     * @return \Illuminate\Http\Response
     */
    public function update(DepartmentRequest $request, Department $department)
    {
        $validated = $request->validated();
        $department->update($validated);
        return $department;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Model\Department  $departments
     * @return \Illuminate\Http\Response
     */
    public function destroy(Department $department)
    {
        $department->delete();
        response('', 204);//
        return view('/');
    }
}
