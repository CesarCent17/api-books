<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
// use App\Http\Controller\BookController;


/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

// Route::get('/book', [BookController::class, 'get']);
Route::get('/book', 'BookController@get');
Route::get('/book/{id}', 'BookController@getById');
Route::post('/book', 'BookController@save');
Route::put('/book/{id}', 'BookController@update');
Route::delete('book/{id}', 'BookController@delete');

Route::post('/author', 'AuthorController@save');
Route::get('/author/{id}', 'AuthorController@getById');


