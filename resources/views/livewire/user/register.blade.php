<?php

use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Livewire\Attributes\Layout;
use Livewire\Volt\Component;

new #[Layout('layouts.guest')] class extends Component {
    public $name = ''; 
    public $email = ''; 
    public $password = ''; 
    public $password_confirmation = ''; 

    /**
     * Menangani permintaan registrasi yang masuk.
     */
    public function register(): void
    {
        $validated = $this->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:'.User::class],
            'password' => ['required', 'string', 'confirmed', \Illuminate\Validation\Rules\Password::defaults()],
        ]);

        $validated['password'] = Hash::make($validated['password']);

        $validated['role'] = 'user';
        
        event(new Registered($user = User::create($validated)));

        Auth::login($user);

        $this->redirect(route('home'), navigate: true);
    }
}; ?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register - On The Sport</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500;700&display=swap" rel="stylesheet">
    <style> body { font-family: 'Roboto', sans-serif; } </style>
</head>
<body class="bg-gray-100">
    <div class="flex items-center justify-center min-h-screen p-4">
        <div class="w-full max-w-md">

            <div class="text-center mb-6">
                <a href="{{ route('home') }}" wire:navigate>
                    <img src="{{ asset('storage/logo/logo.png') }}" alt="On The Sport" class="mx-auto" width="200">
                </a>
            </div>

            <div class="bg-white p-8 rounded-lg shadow-lg">
                <h2 class="text-2xl font-bold text-center text-gray-800 mb-1">Buat Akun Baru</h2>
                <p class="text-center text-gray-500 mb-6">Gratis dan hanya butuh beberapa detik.</p>

                <form wire:submit="register">
                    <div class="mb-4">
                        <label for="name" class="block text-sm font-medium text-gray-700">Nama</label>
                        <input wire:model="name" id="name" type="text" name="name" required autofocus autocomplete="name"
                               class="mt-1 block w-full px-3 py-2 bg-white border border-gray-300 rounded-md shadow-sm placeholder-gray-400 focus:outline-none focus:ring-blue-500 focus:border-blue-500">
                        @error('name') <span class="text-red-500 text-xs mt-1">{{ $message }}</span> @enderror
                    </div>

                    <div class="mb-4">
                        <label for="email" class="block text-sm font-medium text-gray-700">Email</label>
                        <input wire:model="email" id="email" type="email" name="email" required autocomplete="username"
                               class="mt-1 block w-full px-3 py-2 bg-white border border-gray-300 rounded-md shadow-sm placeholder-gray-400 focus:outline-none focus:ring-blue-500 focus:border-blue-500">
                        @error('email') <span class="text-red-500 text-xs mt-1">{{ $message }}</span> @enderror
                    </div>

                    <div class="mb-4">
                        <label for="password" class="block text-sm font-medium text-gray-700">Password</label>
                        <input wire:model="password" id="password" type="password" name="password" required autocomplete="new-password"
                               class="mt-1 block w-full px-3 py-2 bg-white border border-gray-300 rounded-md shadow-sm placeholder-gray-400 focus:outline-none focus:ring-blue-500 focus:border-blue-500">
                        @error('password') <span class="text-red-500 text-xs mt-1">{{ $message }}</span> @enderror
                    </div>
                    
                    <div class="mb-6">
                        <label for="password_confirmation" class="block text-sm font-medium text-gray-700">Konfirmasi Password</label>
                        <input wire:model="password_confirmation" id="password_confirmation" type="password" name="password_confirmation" required autocomplete="new-password"
                               class="mt-1 block w-full px-3 py-2 bg-white border border-gray-300 rounded-md shadow-sm placeholder-gray-400 focus:outline-none focus:ring-blue-500 focus:border-blue-500">
                        @error('password_confirmation') <span class="text-red-500 text-xs mt-1">{{ $message }}</span> @enderror
                    </div>

                    <div>
                        <button type="submit"
                                class="w-full flex justify-center py-3 px-4 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-gray-800 hover:bg-gray-900 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-700">
                            <span wire:loading.remove>Register</span>
                            <span wire:loading>Processing...</span>
                        </button>
                    </div>
                </form>

                <p class="mt-6 text-center text-sm text-gray-600">
                    Sudah punya akun?
                    <a href="{{ route('login') }}" wire:navigate class="font-medium text-blue-600 hover:underline">
                        Sign in
                    </a>
                </p>
            </div>
        </div>
    </div>
</body>
</html>