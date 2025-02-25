<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TracksController;


Route::get('/', function () {
    return view('welcome');
});

Route::get('/tracks', [TracksController::class, 'index'])->name('tracks.index');
Route::get('/tracks/new', [TracksController::class, 'create'])->name('tracks.create');
Route::post('/tracks', [TracksController::class, 'store'])->name('tracks.store');