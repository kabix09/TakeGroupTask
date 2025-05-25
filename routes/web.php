<?php

use App\Http\Controllers\GenreController;
use App\Http\Controllers\MovieController;
use App\Http\Controllers\SeriesController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/api/movies', [MovieController::class, 'index']);
Route::get('/api/movies/{id}', [MovieController::class, 'get'])
    ->where('id', '[0-9]+')
    ->name('movies.get');

Route::get('/api/series', [SeriesController::class, 'index']);
Route::get('/api/series/{id}', [SeriesController::class, 'get'])
    ->where('id', '[0-9]+')
    ->name('series.get');

Route::get('/api/genres', [GenreController::class, 'index']);
Route::get('/api/genres/{id}', [GenreController::class, 'get'])
    ->where('id', '[0-9]+')
    ->name('genres.get');
