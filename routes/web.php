<?php

use App\Livewire\Chat;
use Illuminate\Support\Facades\Route;
use Livewire\Volt\Volt;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\BeritaController;
use App\Http\Controllers\SubscriptionController;

Route::get('/{category?}', [HomeController::class, 'index'])->name('home.index');

Route::get('/berita/{berita}', [BeritaController::class, 'show'])->name('berita.show');

Route::post('/subscribe', [SubscriptionController::class, 'store'])->name('subscribe.store');
Route::get('/subscribe/{category?}', [SubscriptionController::class, 'create'])->name('subscribe.create');
Route::get('/subscribe/berita/{berita}', [BeritaController::class, 'showSubscribe'])->name('berita.show.subscribe');

Route::get('/wartawan', function () {
    return view('welcome');
})->name('home');

Route::view('/wartawan/dashboard', 'dashboard')
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::middleware(['auth'])->group(function () {
    Route::redirect('settings', 'settings/profile');
    Volt::route('settings/profile', 'settings.profile')->name('settings.profile');
    Volt::route('settings/password', 'settings.password')->name('settings.password');
    Volt::route('settings/appearance', 'settings.appearance')->name('settings.appearance');
    Route::get("/wartawan/chat", Chat::class)->name("chat");
});

require __DIR__.'/auth.php';