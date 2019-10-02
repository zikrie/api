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


// hus info sco
Route::post('/mcinfo','Scheme\HusInfoController@post');

Route::get('/mcinfoo','Scheme\HusInfoController@show');


//preparer info sco
Route::get('/preparerInfo','Scheme\PreparerInfoController@show');

//recommendation sco
Route::post('/recommend','Scheme\Recommendation@post');
Route::get('/recommendd','Scheme\Recommendation@show');
