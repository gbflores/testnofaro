<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Pets;

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

// Route::get('/pets', 'PetsController@index');
// Route::post('/pets', 'PetsController@store');
// Route::put('/pets', 'PetsController@update');
// Route::delete('/pets', 'PetsController@destroy');

Route::resource('pets', 'PetsController');
Route::resource('attendances', 'AttendancesController');
Route::resource('species', 'SpeciesController');


Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});
