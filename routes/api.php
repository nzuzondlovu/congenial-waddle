<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

Route::get('/employees', '\App\Http\Controllers\EmployeeController@index');

Route::post('/employees', '\App\Http\Controllers\EmployeeController@store');

Route::get('/employees/{id}', '\App\Http\Controllers\EmployeeController@show');

Route::post('/employees/{id}', '\App\Http\Controllers\EmployeeController@update');

Route::get('/employees/{id}/edit', '\App\Http\Controllers\EmployeeController@edit');
