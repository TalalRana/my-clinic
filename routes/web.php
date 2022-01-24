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
Route::view('list-medicines', 'medicines.form');

Route::view('list-books', 'books.form');

// Body Parts
Route::get('get-body-parts','App\Http\Controllers\BodyPartController@index');

Route::get('create-body-part','App\Http\Controllers\BodyPartController@create');

Route::post('store-body-part','App\Http\Controllers\BodyPartController@store');

Route::post('update-body-part','App\Http\Controllers\BodyPartController@update');

Route::view('list-parts', 'body-part.list');

Route::get('view-body-part/{id}', 'App\Http\Controllers\BodyPartController@show');

