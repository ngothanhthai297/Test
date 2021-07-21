<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

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

Route::get('/login', 'Login@userLogin')->name('user.login');
Route::post('/login', 'Login@userLoginSubmit')->name('user.login.submit');

Route::get('/register', 'Login@userRegister')->name('user.register');
Route::post('/register', 'Login@userRegisterSubmit')->name('user.register.submit');

Route::get('/logout', 'Login@userLogout')->name('user.logout');
//Catelory 
Route::resource('catelory', 'CategoryController')->middleware('checklogin');;

