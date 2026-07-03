<?php

use App\Http\Controllers\DatabaseController;
use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Route;

Route::get('/', [HomeController::class, 'index']);

Route::get('/home', [HomeController::class, 'index'])->name('home');

Route::get('/database', [DatabaseController::class, 'index'])->name('database');

Route::get('/database/{series:slug}', [DatabaseController::class, 'show'])->name('database.show');
