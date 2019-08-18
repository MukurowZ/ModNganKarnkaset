<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});


Route::apiResource('content','ContentController');
Route::apiResource('event','EventController');
Route::apiResource('activity','ActivityController');
Route::apiResource('user','UserController');
Route::apiResource('department','DepartmentController');
Route::apiResource('category','CategoryController');
Route::get('/categorhy','CategoryController@headIndex');
Route::apiResource('contact','Contact_logController');
Route::apiResource('img_set','Img_setController');
Route::get('/img/set/{id}','ImgController@get_OneImg');
Route::get('/img/all/{id}','ImgController@get_Img');
Route::post('/img/upload','ImgController@post_upload');
Route::apiResource('img','ImgController');
Route::apiResource('partner','PartnerController');
Route::apiResource('product','ProductController');
Route::apiResource('service','ServiceController');
