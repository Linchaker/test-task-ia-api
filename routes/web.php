<?php

use App\Http\Controllers\ActorController;
use Illuminate\Support\Facades\Route;

Route::get('/actors', [ActorController::class, 'index'])->name('actors.index');
Route::get('/actors/create', [ActorController::class, 'create'])->name('actors.create');
Route::post('/actors', [ActorController::class, 'store'])->name('actors.store');
