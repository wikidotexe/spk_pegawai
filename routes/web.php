<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\KriteriaController;
use App\Http\Controllers\AlternatifController;
use App\Http\Controllers\CripsController;

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();  // Authentication routes
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

// Protect routes with auth middleware
Route::middleware(['auth'])->group(function () {
    Route::resource('kriteria', KriteriaController::class)->except(['create']);
    Route::resource('alternatif', AlternatifController::class)->except(['create', 'show']);
    Route::resource('crips', CripsController::class)->except(['index', 'create', 'show']);
});
