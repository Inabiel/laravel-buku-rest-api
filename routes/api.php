<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Buku;


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


Route::prefix('/buku')->group(function () {
    Route::get('/',[Buku::class, 'readAll']);
    Route::post('/add', [Buku::class, 'store']);
    Route::get('/{id}', [Buku::class, 'readFromId']);
    Route::delete('delete/{id}', [Buku::class, 'delete']);
    Route::put('/edit/{id}', [Buku::class, 'updateFromId']);
   });
