<?php

use Illuminate\Support\Facades\Route;

Route::group(['prefix' => 'v1'], function () {
    Route::group(['prefix' => 'actors'], function () {
        Route::get('/prompt-validation', [\App\Http\Controllers\Api\V1\ActorController::class, 'getPrompt']);
        Route::post('/', [\App\Http\Controllers\Api\V1\ActorController::class, 'store']);
    });
});

