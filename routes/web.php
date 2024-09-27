<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\KriteriaController;
use App\Http\Controllers\AlternatifController;
use Illuminate\Support\Facades\Auth;

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();  // Authentication routes

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

// Protect routes with auth middleware
Route::middleware(['auth'])->group(function () {
    Route::resource('kriteria', KriteriaController::class);
    Route::resource('alternatif', AlternatifController::class);
});
