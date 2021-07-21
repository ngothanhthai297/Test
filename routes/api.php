<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use app\Http\Controllers\Login;
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

// Route::middleware('auth:api')->get('/user', function (Request $request) {
//     return $request->user();
// });
Route::apiResource("user", "Login");
Route::post('login', 'Login@checkLogin');
//Catelory
Route::group(['prefix' => 'catelory','middleware' => ['checktoken']], function () {
    Route::get("show", "CategoryController@showCatelory");
    Route::post("add", "CategoryController@addCatelory");
    Route::delete("delete/{id}", "CategoryController@deleteCatelory");
    Route::put("update/{id}", "CategoryController@updateCatelory");
});
