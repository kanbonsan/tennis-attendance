<?php

use Inertia\Inertia;
use Illuminate\Support\Facades\Route;

Route::get('/', fn() => Inertia::render('Home'))->name('home');

Route::middleware(['auth:sanctum'])->group(function () {
    Route::get('/dashboard', fn() => Inertia::render('Home'))->name('dashboard');
});
