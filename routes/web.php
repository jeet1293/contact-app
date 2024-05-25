<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ContactController;

Route::get('/', [ContactController::class, 'home'])->name('home');

Route::prefix('contact')->name('contact.')->group(function(){
    Route::get('/', [ContactController::class, 'index'])->name('index');
    Route::get('create', [ContactController::class, 'create'])->name('create');
    Route::post('store', [ContactController::class, 'store'])->name('store');
    Route::get('export', [ContactController::class, 'export'])->name('export');
});