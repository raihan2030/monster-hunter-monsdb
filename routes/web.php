<?php

use App\Http\Controllers\DatabaseController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\MonsterController;
use Illuminate\Support\Facades\Route;

Route::get('/', [HomeController::class, 'index']);

Route::get('/home', [HomeController::class, 'index'])->name('home');

Route::get('/database/{series:slug}', [DatabaseController::class, 'show'])->name('database.show');

Route::get('/monster/{monster:slug}', [MonsterController::class, 'show'])->name('monster.show');
