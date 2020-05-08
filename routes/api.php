<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
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

Route::middleware(['cors'])->prefix('v1')->group(function () {
    Route::post('/login', 'Auth\AuthController@login');
    Route::post('/login/refresh', 'Auth\AuthController@refresh');
    Route::middleware(['auth:api'])->group(function () {
        //
    });
});

