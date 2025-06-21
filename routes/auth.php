<?php

use App\Http\Controllers\Auth\VerifyEmailController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Livewire\Volt\Volt;

Route::middleware('guest')->group(function () {
    Volt::route('login', 'user.login')->name('login');
    Volt::route('register', 'user.register')->name('register');
    Volt::route('forgot-password', 'auth.forgot-password')->name('password.request');
    Volt::route('reset-password/{token}', 'auth.reset-password')->name('password.reset');
});

Route::prefix('wartawan')->middleware('guest')->name('wartawan.')->group(function () {
    Volt::route('login', 'auth.login')->name('login');
    Volt::route('register', 'auth.register')->name('register');
    Volt::route('forgot-password', 'auth.forgot-password')->name('password.request');
    Volt::route('reset-password/{token}', 'auth.reset-password')->name('password.reset');
});

Route::middleware('auth')->group(function () {
    Volt::route('verify-email', 'auth.verify-email')->name('verification.notice');
    Route::get('verify-email/{id}/{hash}', VerifyEmailController::class)
        ->middleware(['signed', 'throttle:6,1'])->name('verification.verify');
    Volt::route('confirm-password', 'auth.confirm-password')->name('password.confirm');
});

Route::post('logout', function (Request $request) {
    Auth::guard('web')->logout();
    $request->session()->invalidate();
    $request->session()->regenerateToken();
    return redirect('/');
})->middleware('auth:web')->name('logout');

Route::post('wartawan/logout', function (Request $request) {
    Auth::guard('wartawan')->logout();
    $request->session()->invalidate();
    $request->session()->regenerateToken();
    return redirect('/wartawan');
})->middleware('auth:wartawan')->name('wartawan.logout');
