<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::redirect('dashboard', 'project-manager')->middleware(['auth', 'verified'])->name('dashboard');

require __DIR__.'/auth.php';
