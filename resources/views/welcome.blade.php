<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>On The Sport - Portal Wartawan</title>
        <link rel="icon" href="/favicon.ico" sizes="any">
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600" rel="stylesheet" />
        <script src="https://cdn.tailwindcss.com"></script>
    </head>
    <body class="bg-white dark:bg-zinc-900">
        <div class="relative min-h-screen flex flex-col items-center justify-center">
            <header class="w-full max-w-7xl px-6 lg:px-8">
                <div class="py-10">
                    <nav class="flex flex-1 justify-end">
                        
                        @auth('wartawan')
                            <a
                                href="{{ route('dashboard') }}"
                                class="rounded-md px-3 py-2 text-black ring-1 ring-transparent transition hover:text-black/70 focus:outline-none focus-visible:ring-[#FF2D20] dark:text-white dark:hover:text-white/80 dark:focus-visible:ring-white"
                            >
                                Dashboard
                            </a>
                        @else
                            <a
                                href="{{ route('wartawan.login') }}"
                                class="rounded-md px-3 py-2 text-black ring-1 ring-transparent transition hover:text-black/70 focus:outline-none focus-visible:ring-[#FF2D20] dark:text-white dark:hover:text-white/80 dark:focus-visible:ring-white"
                            >
                                Log in
                            </a>

                            @if (Route::has('wartawan.register'))
                                <a
                                    href="{{ route('wartawan.register') }}"
                                    class="rounded-md px-3 py-2 text-black ring-1 ring-transparent transition hover:text-black/70 focus:outline-none focus-visible:ring-[#FF2D20] dark:text-white dark:hover:text-white/80 dark:focus-visible:ring-white"
                                >
                                    Register
                                </a>
                            @endif
                        @endauth
                    </nav>
                </div>
            </header>

            <main class="w-full max-w-7xl px-6 lg:px-8 flex-grow flex items-center justify-center">
                <div class="text-center">
                    <div class="flex justify-center mb-6">
                         <img src="{{ asset('storage/logo/logo.png') }}" alt="On The Sport" class="h-24 w-auto">
                    </div>
                    <h1 class="text-4xl font-bold text-gray-800 dark:text-white">Portal Wartawan</h1>
                    <p class="mt-2 text-gray-600 dark:text-gray-400">Silakan login atau mendaftar untuk melanjutkan.</p>
                </div>
            </main>

            <footer class="py-16 text-center text-sm text-black dark:text-white/70">
                On The Sport &copy; {{ date('Y') }}
            </footer>
        </div>
    </body>
</html>