<?php

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


Route::get('/section', '\App\Http\Controllers\SectionController@tester');

Route::get('/get', '\App\Http\Controllers\TestController@tester');

Route::get('/style', '\App\Http\Controllers\copyController@style');
Route::get('/sector', '\App\Http\Controllers\SectorController@tester');

Route::get('/page', '\App\Http\Controllers\InterFaceController@userinterface');
Route::post('/convert', '\App\Http\Controllers\InterFaceController@rabie')->name('convert');


Route::get('/new', '\App\Http\Controllers\RabieController@tester');
