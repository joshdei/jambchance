<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\WaitlistController;

// Home/Landing page
Route::get('/', [WaitlistController::class, 'index'])->name('home');

// Waitlist submission (POST)
Route::post('/waitlist/submit', [WaitlistController::class, 'store'])->name('waitlist.submit');

// Success page after signup
Route::get('/waitlist/success', [WaitlistController::class, 'success'])->name('waitlist.success');

// Optional: Check if email exists (useful for real-time validation)
Route::get('/waitlist/check-email', [WaitlistController::class, 'checkEmail'])->name('waitlist.check');

// Include settings routes
require __DIR__.'/settings.php';