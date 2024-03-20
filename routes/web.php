<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\apiController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::group(['namespace' => 'Admin', 'prefix' => 'admin', 'name' => 'Admin'], function () {
    Route::get('/', [apiController::class, 'index']);
    Route::group(['prefix' => '/api'], function () {
        Route::get('/', [apiController::class, 'index']);
        Route::get('/get-api', [apiController::class, 'GetApiData']);
        Route::post('/add-api', [apiController::class, 'AddApi']);
        Route::post('/delete-api', [apiController::class, 'DeleteApi']);
    });
});

Route::get('/', function () {
    return view('welcome');
});
