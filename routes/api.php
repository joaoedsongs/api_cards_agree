<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Api\V1\CardController;
use App\Http\Controllers\Api\V1\ExpansionController;
use App\Http\Controllers\Api\V1\RarityController;
use App\Http\Controllers\Api\V1\TypeController;
use App\Http\Controllers\Api\V1\AuthController;

Route::group(['prefix' => 'v1'], function () {

    Route::post('login', [AuthController::class, 'login']);

    Route::middleware(['auth:sanctum'])->group(function () {
        Route::resource('cards', CardController::class);
        Route::resource('expansions', ExpansionController::class);
        Route::resource('rarities', RarityController::class);
        Route::resource('types', TypeController::class);
    });

});


Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});


