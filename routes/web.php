<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CountryController;

Route::get('/', [CountryController::class, 'index'])->name('countries.index');
Route::get('/country/{name}', [CountryController::class, 'show'])->name('countries.show');
Route::get('/search', [CountryController::class, 'search'])->name('countries.search');
