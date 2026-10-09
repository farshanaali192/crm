<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AccountController;
use App\Http\Controllers\ContactsController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\LeadController;


Route::get('/', function () {
  return redirect()->route('dashboard');
});
Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');


// Account Routes
Route::prefix('accounts')->name('accounts.')->group(function () {
    Route::get('/list', [AccountController::class, 'list'])->name('list');
    Route::get('/create', [AccountController::class, 'create'])->name('create');
    Route::post('/', [AccountController::class, 'store'])->name('store');
});

// Lead Routes
Route::prefix('leads')->name('leads.')->group(function () {
    Route::get('/list', [LeadController::class, 'list'])->name('list');
    Route::get('/create', [LeadController::class, 'create'])->name('create');
    Route::post('/', [LeadController::class, 'store'])->name('store');
});

// Contact Routes
Route::prefix('contacts')->name('contacts.')->group(function () {
    Route::get('/list', [ContactsController::class, 'list'])->name('list');
});
