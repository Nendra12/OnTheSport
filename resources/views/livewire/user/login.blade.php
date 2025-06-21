<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;
use Livewire\Attributes\Layout;
use Livewire\Volt\Component;
use App\Models\User;

new #[Layout('layouts.guest')] class extends Component {
    public $email = ''; 
    public $password = ''; 
    public $remember = false; 

    public function login(): void
    {
        $this->validate([
            'email' => ['required', 'string', 'email'],
            'password' => ['required', 'string'],
        ]);

        $user = User::where('email', $this->email)->first();

        if (!$user || !Hash::check($this->password, $user->password)) {
            throw ValidationException::withMessages([
                'email' => trans('auth.failed'),
            ]);
        }

        if ($user->role !== 'user') {
            throw ValidationException::withMessages([
                'email' => 'Akses ditolak. Akun ini bukan untuk pengguna biasa.',
            ]);
        }

        Auth::login($user, $this->remember);
        session()->regenerate();
        $this->redirect(session('url.intended', route('home')), navigate: true);
    }
}; ?>

<div class="w-full max-w-md">
    <div class="text-center mb-6">
        <a href="{{ route('home') }}" wire:navigate>
            <img src="{{ asset('storage/logo/logo.png') }}" alt="On The Sport" class="mx-auto" width="200">
        </a>
    </div>

    <div class="bg-white p-8 rounded-lg shadow-lg">
        <h2 class="text-2xl font-bold text-center text-gray-800 mb-1">Sign in</h2>
        <p class="text-center text-gray-500 mb-6">Akses akun On The Sport Anda.</p>

        <form wire:submit="login" class="space-y-6">
            <div>
                <label for="email" class="block text-sm font-medium text-gray-700">Email</label>
                <input wire:model="email" id="email" type="email" name="email" required autofocus class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500">
                @error('email') <span class="text-xs text-red-600 mt-2">{{ $message }}</span> @enderror
            </div>

            <div>
                <div class="flex justify-between items-center">
                    <label for="password" class="block text-sm font-medium text-gray-700">Password</label>
                    @if(Route::has('password.request'))
                        <a href="{{ route('password.request') }}" class="text-sm text-indigo-600 hover:underline">Lupa password?</a>
                    @endif
                </div>
                <input wire:model="password" id="password" type="password" name="password" required class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm">
            </div>
            
            <div class="flex items-center justify-between">
                <label for="remember" class="flex items-center"><input wire:model="remember" id="remember" type="checkbox" class="rounded border-gray-300 text-indigo-600 shadow-sm"><span class="ml-2 text-sm text-gray-600">Ingat saya</span></label>
            </div>

            <div>
                <button type="submit" class="w-full flex justify-center py-2 px-4 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-gray-800 hover:bg-gray-900">Sign in</button>
            </div>
        </form>

        <p class="mt-6 text-sm text-center text-gray-500">
            Belum punya akun? <a href="{{ route('register') }}" wire:navigate class="font-medium text-indigo-600 hover:underline">Register</a>
        </p>
    </div>
</div>