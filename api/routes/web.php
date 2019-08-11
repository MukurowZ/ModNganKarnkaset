<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});


Route::get('/event', function () {
    return view('event');
});

Route::get('/event/create', function () {
    return view('create-event');
});

Route::get('/event/{id}/edit', function ($id) {
    return view('edit-event',compact('id'));
});

