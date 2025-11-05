<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\FormController;
use App\Http\Controllers\PageController;
use Illuminate\Support\Facades\Route;

// Form Routes
Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
Route::get('/forms', [FormController::class, 'index'])->name('forms');
Route::get('/forms/create', [FormController::class, 'create'])->name('forms.create');
Route::post('/forms', [FormController::class, 'store'])->name('forms.store');

// Form Edit Routes
Route::get('/forms/{id}/edit', [FormController::class, 'edit'])->name('forms.edit');
Route::post('/forms/{id}/update', [FormController::class, 'update'])->name('forms.update');

// Page Routes
Route::get('/pages', [PageController::class, 'index'])->name('pages');
Route::get('/pages/create', [PageController::class, 'create'])->name('pages.create');
Route::post('/pages/store', [PageController::class, 'store'])->name('pages.store');
Route::get('/pages/{slug}', [PageController::class, 'show'])->name('pages.show');

// Page Edit Routes
Route::get('/pages/{id}/edit', [PageController::class, 'edit'])->name('pages.edit');
Route::put('pages/{id}', [PageController::class, 'update'])->name('pages.update');
Route::post('/logout', [App\Http\Controllers\Auth\LoginController::class, 'logout'])->name('logout');

Route::get('/content/create', [ContentController::class, 'create'])->name('content.create');
Route::post('/content/store', [ContentController::class, 'store'])->name('content.store');
Route::get('/content/{slug}', [ContentController::class, 'show'])->name('content.show');

Route::view('register', 'shortcodes/register')->name('register');
