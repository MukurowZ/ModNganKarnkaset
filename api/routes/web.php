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

Route::get('/admin/login', function () {
    return view('login/login');
});

Route::get('/index', function () {
    return view('welcome');
});

Route::get('/event', function () {
    return view('event/show-event');
});

Route::get('/event/create', function () {
    return view('event/create-event');
});
Route::group(['middleware' => ['jwt.verify']], function () {
    Route::get('/event/{id}/edit', function ($id) {
        return view('event/edit-event', compact('id'));
    });
});

Route::group(['prefix'=>'/event/manage'], function(){
    Route::get('/','View\EventController@index');
});
// Route::get('/event', function () {
//     return view('event/event');
// });

Route::get('/product', function () {
    return view('product_service/product');
});

Route::get('/service', function () {
    return view('product_service/product');
});

// FOR TESTING PURPOSE
Route::get('/product/test', function () {
    return view('product_service/test');
});

Route::get('/product/{id}', function ($id) {
    return view('product_service/view-product', compact('id'));
});

Route::get('/product_service/create', function () {
    return view('product_service/create-product');
});

Route::get('/contact', function () {
    return view('contact/contact_form');
});

Route::get('/admin/contact', function () {
    return view('contact/contact_report');
});

Route::get('/admin/login', function () {
    return view('login/login');
});
