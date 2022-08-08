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

Route::get('/', '\App\Http\Controllers\EmployeeController@index');

Route::post('/employees', '\App\Http\Controllers\EmployeeController@store');

Route::get('/employees/create', '\App\Http\Controllers\EmployeeController@create');

Route::get('/employees/{id}', '\App\Http\Controllers\EmployeeController@show');

Route::post('/employees/{id}', '\App\Http\Controllers\EmployeeController@update');

Route::delete('/employees/{id}', '\App\Http\Controllers\EmployeeController@destroy');

Route::get('/employees/{id}/edit', '\App\Http\Controllers\EmployeeController@edit');
