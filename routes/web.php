<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\BeritaController;
use App\Http\Controllers\SubscriptionController;
use App\Livewire\Chat;
use Livewire\Volt\Volt;

Route::get('/', fn() => redirect()->route('home'));

Route::get('/app/{category?}', [HomeController::class, 'index'])->name('home');

Route::get('/berita/{berita}', [BeritaController::class, 'show'])->name('berita.show');

Route::middleware('auth:web')->group(function () {
    Route::get('/subscribe/{category?}', [SubscriptionController::class, 'create'])->name('subscribe.create');
    Route::get('/premium/berita/{berita}', [BeritaController::class, 'showSubscribe'])->name('berita.show.subscribe');
    
    Route::get('/profile', fn() => redirect()->route('profile.edit'))->name('profile');
    Volt::route('/profile/edit', 'user.settings.profile')->name('profile.edit');
});

Route::get('/wartawan', fn() => view('welcome'))->name('wartawan.index');

Route::middleware('auth:wartawan')->group(function () {
    Route::view('/wartawan/dashboard', 'dashboard')->name('dashboard');
    Volt::route('/wartawan/settings/profile', 'settings.profile')->name('settings.profile');
    Volt::route('/wartawan/settings/password', 'settings.password')->name('settings.password');
    Volt::route('/wartawan/settings/appearance', 'settings.appearance')->name('settings.appearance');
    Route::get("/wartawan/chat", Chat::class)->name("chat");
});

require __DIR__.'/auth.php';