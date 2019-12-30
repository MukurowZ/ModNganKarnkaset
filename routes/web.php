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

Route::get('/index', function () {
    return view('welcome');
});

Route::get('/admin/login', function () {
    return view('login/login');
});

Route::group(['prefix'=>'/event'], function ($id) {
    Route::get('/','View\EventController@index');
    Route::get('/{id}','View\EventController@show');
});

Route::group(['prefix'=>'/activity'], function ($id) {
    Route::get('/','View\EventController@index');
    Route::get('/{id}','View\EventController@show');
});

Route::group(['prefix'=>'/product'], function ($id) {
    Route::get('/','View\ProductServiceController@index');
    Route::get('/{id}','View\ProductServiceController@show');
});

Route::group(['prefix'=>'/service'], function ($id) {
    Route::get('/','View\ProductServiceController@index');
    Route::get('/{id}','View\ProductServiceController@show');
});

Route::group(['prefix'=>'/contact'], function (){
    Route::get('/','View\ContactController@contact');
    Route::get('/form','View\ContactController@form');
});

Route::group(['middleware' => ['jwt.verify']], function () {
    Route::group(['prefix'=>'/admin'], function(){
        Route::get('/contact','View\AdminController@contact');
        Route::group(['prefix'=>'/event'], function ($id) {
            Route::get('/','View\AdminController@event');
            Route::get('/{id}/edit','View\AdminController@editEvent');
            Route::get('/create','View\AdminController@createEvent');
        });

        Route::group(['prefix'=>'/activity'], function ($id) {
            Route::get('/','View\AdminController@event');
            Route::get('/{id}/edit','View\AdminController@editEvent');
            Route::get('/create','View\AdminController@createEvent');
        });
        Route::group(['prefix'=>'/product'], function ($id) {
            Route::get('/','View\AdminController@product');
            Route::get('/{id}/edit','View\AdminController@editProduct');
            Route::get('/create','View\AdminController@createProduct');
        });

        Route::group(['prefix'=>'/service'], function ($id) {
            Route::get('/','View\AdminController@product');
            Route::get('/{id}/edit','View\AdminController@editProduct');
            Route::get('/create','View\AdminController@createProduct');
        });

        Route::get('/category','View\AdminController@category');

        Route::group(['prefix'=>'/user'], function ($id) {
            Route::get('/','View\AdminController@user');
            Route::get('/{id}/edit','View\AdminController@editUser');
            Route::get('/create','View\AdminController@createUser');
        });

        Route::group(['prefix'=>'/department'], function ($id) {
            Route::get('/','View\AdminController@department');
        });
    });

});

// FOR TESTING PURPOSE
// Route::get('/product/test', function () {
//     return view('product_service/test');
// });
