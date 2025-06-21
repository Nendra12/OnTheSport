
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pengaturan Akun - On The Sport</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <style> body { background-color: #f9fafb; font-family: 'arial', sans-serif; } </style>
</head>
<body class="font-semibold">
    
    {{-- Memanggil Navbar yang sudah kita buat --}}
    @include('layouts.navbar')

    <main class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <header class="mb-6">
                <h2 class="text-2xl font-bold text-gray-900">
                    Pengaturan Akun
                </h2>
                <p class="mt-1 text-sm text-gray-600">
                    Perbarui informasi profil dan keamanan akun Anda di sini.
                </p>
            </header>

            <div class="grid grid-cols-1 md:grid-cols-4 gap-10">
                
                {{-- Kolom Navigasi Samping --}}
                <div class="md:col-span-1">
                    <div class="px-4 sm:px-0">
                        <nav class="space-y-1">
                            <a href="{{ route('profile.edit') }}" class="block px-3 py-2 text-sm font-medium rounded-md {{ request()->routeIs('profile.edit') ? 'bg-gray-200 text-gray-900' : 'text-gray-600 hover:bg-gray-50' }}">Profil</a>
                            <a href="{{ route('profile.password') }}" class="block px-3 py-2 text-sm font-medium rounded-md {{ request()->routeIs('profile.password') ? 'bg-gray-200 text-gray-900' : 'text-gray-600 hover:bg-gray-50' }}">Ganti Password</a>
                            <a href="{{ route('profile.appearance') }}" class="block px-3 py-2 text-sm font-medium rounded-md {{ request()->routeIs('profile.appearance') ? 'bg-gray-200 text-gray-900' : 'text-gray-600 hover:bg-gray-50' }}">Tampilan</a>
                        </nav>
                    </div>
                </div>

                {{-- Kolom Konten Utama (Slot untuk Volt) --}}
                <div class="mt-5 md:mt-0 md:col-span-3">
                    <div class="bg-white shadow-md sm:rounded-lg">
                        <div class="px-4 py-5 sm:p-8">
                            {{ $slot }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>

    {{-- Anda bisa @include footer di sini jika ada --}}
</body>
</html>