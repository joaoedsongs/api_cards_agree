<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Api\V1\CardController;
use App\Http\Controllers\Api\V1\ExpansionController;
use App\Http\Controllers\Api\V1\RarityController;
use App\Http\Controllers\Api\V1\TypeController;

Route::group(['prefix' => 'v1'], function () {

    Route::resource('cards', CardController::class);
    // Route::get('cards', [CardController::class, 'index']);
    // Route::post('cards', [CardController::class, 'store']);
    // Route::put('cards/{card}', [CardController::class, 'update']);
    // Route::put('/cards/{cards}/update',  [ CardController::class, 'updateCard' ]);

    Route::resource('expansions', ExpansionController::class);

    Route::resource('rarities', RarityController::class);

    Route::resource('types', TypeController::class);

});


Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});


