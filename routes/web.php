<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\WaitlistController;

// Home/Landing page
Route::get('/', function () {
    return view(view: 'landing'); // Make sure your landing page is named landing.blade.php
})->name('home');

// Waitlist submission (POST)
Route::post('/waitlist/submit', [WaitlistController::class, 'store'])->name('waitlist.submit');

// Optional: Check if email exists (useful for real-time validation)
Route::get('/waitlist/check-email', [WaitlistController::class, 'checkEmail'])->name('waitlist.check');

// Optional: Success page after signup
Route::get('/waitlist/success', function () {
    return view('success');
})->name('waitlist.success');

// Include settings routes
require __DIR__.'/settings.php';