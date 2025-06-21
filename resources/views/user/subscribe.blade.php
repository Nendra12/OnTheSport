<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Langganan Premium - On The Sport</title>
    <script src="https://cdn.tailwindcss.com"></script> 
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <style>
        .card { width: fit-content; height: fit-content; display: flex; align-items: center; justify-content: center; gap: 20px; box-shadow: 0px 0px 20px rgba(0, 0, 0, 0.055); }
        .socialContainer { width: 40px; height: 38px; background-color: #fff; display: flex; align-items: center; justify-content: center; overflow: hidden; transition-duration: 0.3s; border: 1px solid #1A1A1A; padding: 5px; }
        .containerInstagram:hover { background-color: #d62976; }
        .containerTwitter:hover { background-color: #000000; }
        .news-grid { display: grid; grid-template-columns: 1fr 1fr; gap: 20px; }
        .news-card { display: flex; flex-direction: column; height: 100%; }
        .image-container { position: relative; width: 100%; padding-bottom: 56.25%; overflow: hidden; border-radius: 4px; }
        .image-container img { position: absolute; top: 0; left: 0; width: 100%; height: 100%; object-fit: cover; transition: transform 0.3s ease; }
        .news-card:hover .image-container img { transform: scale(1.03); }
        .news-content { padding: 12px 0; flex-grow: 1; }
        .featured-news { grid-column: 1 / -1; background-color: #f5f5f5; padding: 20px; margin: 20px 0; }
        .featured-image-container { position: relative; width: 100%; padding-bottom: 40%; overflow: hidden; }
        .featured-image-container img { position: absolute; top: 0; left: 0; width: 100%; height: 100%; object-fit: cover; }
        .dropdown { position: relative; display: inline-block; }
        .dropdown-content { display: none; position: absolute; background-color: #f9f9f9; min-width: 200px; box-shadow: 0px 8px 16px 0px rgba(0,0,0,0.2); z-index: 50; border-radius: 4px; }
        .dropdown-content a { color: black; padding: 12px 16px; text-decoration: none; display: block; border-bottom: 1px solid #ddd; }
        .dropdown-content a:last-child { border-bottom: none; }
        .dropdown-content a:hover { background-color: #f1f1f1; }
        .show { display: block; }
    </style>
</head>
<body class="font-[arial] font-semibold bg-[#FFAFA]">
    <nav class="flex mx-4 flex-col bg-white" x-data>
        <div class="flex w-full justify-between items-center border-b border-[#d6dbdf] py-4">
            
            <div class="w-[100%]">
                <div class="relative" x-data="{ open: false }" @click.outside="open = false">
                    <button @click="open = !open" class="group flex items-center justify-center relative z-10 [transition:all_0.5s_ease] rounded-[0.375rem] p-[5px] cursor-pointer border border-[#999] outline-none focus-visible:outline-0">
                        <svg fill="currentColor" stroke="none" stroke-width="0" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg" class="w-7 h-7 overflow-visible [transition:transform_.35s_ease] group-hover:[transition-delay:.25s] [&_path]:[transition:transform_.35s_ease] group-hover:rotate-45">
                            <path d="m3.45,8.83c-.39,0-.76-.23-.92-.62-.21-.51.03-1.1.54-1.31L14.71,2.08c.51-.21,1.1.03,1.31.54.21.51-.03,1.1-.54,1.31L3.84,8.75c-.13.05-.25.08-.38.08Z"></path>
                            <path d="m2.02,17.13c-.39,0-.76-.23-.92-.62-.21-.51.03-1.1.54-1.31L21.6,6.94c.51-.21,1.1.03,1.31.54.21.51-.03,1.1-.54,1.31L2.4,17.06c-.13.05-.25.08-.38.08Z"></path>
                            <path d="m8.91,21.99c-.39,0-.76-.23-.92-.62-.21-.51.03-1.1.54-1.31l11.64-4.82c.51-.21,1.1.03,1.31.54.21.51-.03,1.1-.54,1.31l-11.64,4.82c-.13.05-.25.08-.38.08Z"></path>
                        </svg>
                    </button>
                    <div x-show="open" x-transition style="display: none;" class="absolute left-0 mt-2 w-56 bg-white rounded-md shadow-lg py-1 z-50 border border-gray-200">
                        <a href="{{ route('subscribe.create') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">Home</a>
                        @foreach ($lists as $list)
                            <a href="{{ route('subscribe.create', ['category' => $list->id]) }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">{{ $list->nama }}</a>
                        @endforeach
                    </div>
                </div>
            </div>
            
            <div class="w-[100%] flex justify-center">
                <a href="{{ route('home') }}"><img src="{{ asset('storage/logo/logo.png') }}" alt="On The Sport" width="200px"></a>
            </div>

            <div class="w-[100%] flex justify-end items-center">
                <span class="text-[#BB1919] mr-4 font-medium">Premium Member</span>
                @auth('web')
                    <div x-data="{ open: false }" @click.outside="open = false" class="relative">
                        <button @click="open = !open" class="flex items-center space-x-2 px-3 py-2 rounded-md hover:bg-gray-100 focus:outline-none transition">
                            <span class="font-medium text-sm text-gray-700">Halo, {{ Auth::user()->name }}</span>
                            <svg class="w-4 h-4 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path></svg>
                        </button>
                        <div x-show="open" x-transition style="display: none;" class="absolute right-0 mt-2 w-56 bg-white rounded-md shadow-lg py-1 z-50 border border-gray-200">
                            <div class="px-4 py-3 border-b">
                                <p class="text-sm font-semibold text-gray-900">Signed in as</p>
                                <p class="text-sm text-gray-600 truncate">{{ Auth::user()->email }}</p>
                            </div>
                            <div class="border-t border-gray-100"></div>
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <button type="submit" class="flex items-center w-full text-left px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">Logout</button>
                            </form>
                        </div>
                    </div>
                @endauth
            </div>
        </div>
        
        <div class="flex justify-center border-b border-[#d6dbdf] p-4">
            <div class="flex flex-wrap justify-center gap-4 text-gray-700">
                <a href="{{ route('subscribe.create') }}" class="pr-4 border-r border-gray-300 hover:text-black">Home</a>
                @foreach ($lists as $list)
                    <a href="{{ route('subscribe.create', ['category' => $list->id]) }}" class="pr-4 border-r border-gray-300 hover:text-black last:border-r-0">{{ $list->nama }}</a>
                @endforeach
            </div>
        </div>
    </nav>
    
    <div class="mx-4 my-6 p-4 bg-blue-50 rounded-lg border-l-4 border-red-500 shadow">
        <div class="flex items-center">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-red-600 mr-3" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
            </svg>
            <h3 class="text-lg font-bold text-gray-800">Premium Membership Active</h3>
        </div>
        <p class="mt-2 text-gray-700 font-normal pl-9">Terima kasih telah berlangganan! Anda sekarang memiliki akses penuh ke semua konten premium.</p>
        <div class="mt-4 pl-9 flex justify-between items-center">
            <div>
                <p class="text-sm text-gray-700 font-normal">Paket: <span class="font-bold">Premium Bulanan</span></p>
                <p class="text-sm text-gray-700 font-normal">Diperbarui pada: <span class="font-bold">25 Juli 2025</span></p>
            </div>
            <button class="px-4 py-2 bg-red-800 text-white rounded-md hover:bg-red-700 text-sm font-medium">Kelola Langganan</button>
        </div>
    </div>
    
    <article class="mx-4 font-sans mt-8">
        @if($posts->count() > 0)
            <div class="news-grid">
            @foreach ($posts as $index => $post)
                @if (($index + 1) % 3 != 0)
                    <a class="news-card group" href="{{ route('berita.show.subscribe', $post) }}">
                        <div class="image-container">
                            <img src="{{ asset('storage/' . $post->gambar) }}" alt="{{ $post->judul }}" class="group-hover:opacity-90">
                        </div>
                        <div class="news-content">
                            <h4 class="mb-2 text-lg font-medium group-hover:underline">{{ $post->judul }}</h4>
                            <p class="text-gray-700 font-normal line-clamp-2">{{ Str::limit(strip_tags($post->isi), 120) }}</p>
                            <div class="mt-3 text-xs text-gray-500 font-normal">
                                <p>{{ \Carbon\Carbon::parse($post->created_at)->format('d M Y, H:i') }}</p>
                            </div>
                        </div>
                    </a>
                @else
                    </div>
                    <hr class="border-t border-[#1A1A1A] my-4 mx-4">
                    <div class="featured-news group">
                        <a href="{{ route('berita.show.subscribe', $post) }}" class="flex flex-col md:flex-row gap-6 items-center">
                            <div class="featured-image-container w-full md:w-1/2">
                                <img src="{{ asset('storage/' . $post->gambar) }}" alt="{{ $post->judul }}" class="group-hover:opacity-85">
                            </div>
                            <div class="w-full md:w-1/2">
                                <h3 class="text-2xl font-bold mb-4 group-hover:underline">{{ $post->judul }}</h3>
                                <p class="text-gray-700 mb-4 font-normal">{{ Str::limit(strip_tags($post->isi), 200) }}</p>
                                <div class="text-sm text-gray-500 font-normal">
                                    <p>{{ \Carbon\Carbon::parse($post->created_at)->format('d M Y, H:i') }}</p>
                                </div>
                            </div>
                        </a>
                    </div>
                    <hr class="border-t border-[#1A1A1A] my-4 mx-4">
                    <div class="news-grid">
                @endif
            @endforeach
            </div>
        @else
            <div class="text-center py-16">
                <h2 class="text-2xl font-bold text-gray-700">Tidak Ada Berita</h2>
            </div>
        @endif
    </article>

    <hr class="border-t-1 border-[#1A1A1A] my-4 mx-4">
    
    <div class="bg-[#1A1A1A] text-white py-8 px-4 mx-4 mb-8">
        <div class="max-w-4xl mx-auto text-center">
            <h3 class="text-2xl font-bold mb-4">Nikmati Akses Premium Anda?</h3>
            <p class="mb-6">Ajak teman bergabung dan dapatkan 1 bulan gratis untuk setiap 3 teman yang berhasil mendaftar!</p>
            <button class="px-6 py-3 bg-[#BB1919] hover:bg-[#991515] rounded-sm font-medium flex items-center gap-2 mx-auto">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11.049 2.927c.3-.921 1.603-.921 1.902 0l1.519 4.674a1 1 0 00.95.69h4.915c.969 0 1.371 1.24.588 1.81l-3.976 2.888a1 1 0 00-.363 1.118l1.518 4.674c.3.922-.755 1.688-1.538 1.118l-3.976-2.888a1 1 0 00-1.176 0l-3.976 2.888c-.783.57-1.838-.197-1.538-1.118l1.518-4.674a1 1 0 00-.363-1.118l-3.976-2.888c-.784-.57-.38-1.81.588-1.81h4.914a1 1 0 00.951-.69l1.519-4.674z" />
                </svg>
                Ajak Teman
            </button>
        </div>
    </div>

    <hr class="border-t-1 border-[#1A1A1A] my-4 mx-4">

    <footer class="flex mx-4 flex-col mb-10">
        <div class="flex flex-col gap-7">
            <img src="{{ asset('storage/logo/logo.png') }}" alt="" width="200px">
            <div class="flex flex-wrap gap-x-4 gap-y-2">
                <a href="{{ route('subscribe.create') }}" class="pr-4 border-r border-gray-300 hover:text-black hover:opacity-85">All</a>
                @foreach ($lists as $list)
                    <a href="{{ route('subscribe.create', ['category' => $list->id]) }}" class="pr-4 border-r border-gray-300 hover:text-black hover:opacity-85 last:border-r-0">{{ $list->nama }}</a>
                @endforeach
            </div>
            <hr class="border-t border-[#b8b7b7] w-[50%]">
            <div class="card">
                <p>Follow On The Sport on : </p>
                <a href="#" class="socialContainer containerInstagram"><svg class="socialSvg" xmlns="http://www.w3.org/2000/svg" x="0px" y="0px" width="100" height="100" viewBox="0 0 50 50"><path d="M 16 3 C 8.8324839 3 3 8.8324839 3 16 L 3 34 C 3 41.167516 8.8324839 47 16 47 L 34 47 C 41.167516 47 47 41.167516 47 34 L 47 16 C 47 8.8324839 41.167516 3 34 3 L 16 3 z M 16 5 L 34 5 C 40.086484 5 45 9.9135161 45 16 L 45 34 C 45 40.086484 40.086484 45 34 45 L 16 45 C 9.9135161 45 5 40.086484 5 34 L 5 16 C 5 9.9135161 9.9135161 5 16 5 z M 37 11 A 2 2 0 0 0 35 13 A 2 2 0 0 0 37 15 A 2 2 0 0 0 39 13 A 2 2 0 0 0 37 11 z M 25 14 C 18.936712 14 14 18.936712 14 25 C 14 31.063288 18.936712 36 25 36 C 31.063288 36 36 31.063288 36 25 C 36 18.936712 31.063288 14 25 14 z M 25 16 C 29.982407 16 34 20.017593 34 25 C 34 29.982407 29.982407 34 25 34 C 20.017593 34 16 29.982407 16 25 C 16 20.017593 20.017593 16 25 16 z"></path></svg></a>
                <a href="#" class="socialContainer containerTwitter"><svg class="socialSvg" xmlns="http://www.w3.org/2000/svg" x="0px" y="0px" width="100" height="100" viewBox="0 0 50 50"><path d="M 5.9199219 6 L 20.582031 27.375 L 6.2304688 44 L 9.4101562 44 L 21.986328 29.421875 L 31.986328 44 L 44 44 L 28.681641 21.669922 L 42.199219 6 L 39.029297 6 L 27.275391 19.617188 L 17.933594 6 L 5.9199219 6 z M 9.7167969 8 L 16.880859 8 L 40.203125 42 L 33.039062 42 L 9.7167969 8 z"></path></svg></a>
                <a href="#" class="socialContainer containerFacebook"><svg class="socialSvg" xmlns="http://www.w3.org/2000/svg" x="0px" y="0px" width="100" height="100" viewBox="0 0 50 50"><path d="M 25 3 C 12.861562 3 3 12.861562 3 25 C 3 36.019135 11.127533 45.138355 21.712891 46.728516 L 22.861328 46.902344 L 22.861328 29.566406 L 17.664062 29.566406 L 17.664062 26.046875 L 22.861328 26.046875 L 22.861328 21.373047 C 22.861328 18.494965 23.551973 16.599417 24.695312 15.410156 C 25.838652 14.220896 27.528004 13.621094 29.878906 13.621094 C 31.758714 13.621094 32.490022 13.734993 33.185547 13.820312 L 33.185547 16.701172 L 30.738281 16.701172 C 29.349697 16.701172 28.210449 17.475903 27.619141 18.507812 C 27.027832 19.539724 26.84375 20.771816 26.84375 22.027344 L 26.84375 26.044922 L 32.966797 26.044922 L 32.421875 29.564453 L 26.84375 29.564453 L 26.84375 46.929688 L 27.978516 46.775391 C 38.71434 45.319366 47 36.126845 47 25 C 47 12.861562 37.138438 3 25 3 z M 25 5 C 36.057562 5 45 13.942438 45 25 C 45 34.729791 38.035799 42.731796 28.84375 44.533203 L 28.84375 31.564453 L 34.136719 31.564453 L 35.298828 24.044922 L 28.84375 24.044922 L 28.84375 22.027344 C 28.84375 20.989871 29.033574 20.060293 29.353516 19.501953 C 29.673457 18.943614 29.981865 18.701172 30.738281 18.701172 L 35.185547 18.701172 L 35.185547 12.009766 L 34.318359 11.892578 C 33.718567 11.811418 32.349197 11.621094 29.878906 11.621094 C 27.175808 11.621094 24.855567 12.357448 23.253906 14.023438 C 21.652246 15.689426 20.861328 18.170128 20.861328 21.373047 L 20.861328 24.046875 L 15.664062 24.046875 L 15.664062 31.566406 L 20.861328 31.566406 L 20.861328 44.470703 C 11.816995 42.554813 5 34.624447 5 25 C 5 13.942438 13.942438 5 25 5 z"></path></svg></a>
                <a href="#" class="socialContainer containerTiktok"><svg class="socialSvg" xmlns="http://www.w3.org/2000/svg" x="0px" y="0px" width="100" height="100" viewBox="0 0 50 50"><path d="M 9 4 C 6.2495759 4 4 6.2495759 4 9 L 4 41 C 4 43.750424 6.2495759 46 9 46 L 41 46 C 43.750424 46 46 43.750424 46 41 L 46 9 C 46 6.2495759 43.750424 4 41 4 L 9 4 z M 9 6 L 41 6 C 42.671576 6 44 7.3284241 44 9 L 44 41 C 44 42.671576 42.671576 44 41 44 L 9 44 C 7.3284241 44 6 42.671576 6 41 L 6 9 C 6 7.3284241 7.3284241 6 9 6 z M 26.042969 10 A 1.0001 1.0001 0 0 0 25.042969 10.998047 C 25.042969 10.998047 25.031984 15.873262 25.021484 20.759766 C 25.016184 23.203017 25.009799 25.64879 25.005859 27.490234 C 25.001922 29.331679 25 30.496833 25 30.59375 C 25 32.409009 23.351421 33.892578 21.472656 33.892578 C 19.608867 33.892578 18.121094 32.402853 18.121094 30.539062 C 18.121094 28.675273 19.608867 27.1875 21.472656 27.1875 C 21.535796 27.1875 21.663054 27.208245 21.880859 27.234375 A 1.0001 1.0001 0 0 0 23 26.240234 L 23 22.039062 A 1.0001 1.0001 0 0 0 22.0625 21.041016 C 21.906673 21.031216 21.710581 21.011719 21.472656 21.011719 C 16.223131 21.011719 11.945313 25.289537 11.945312 30.539062 C 11.945312 35.788589 16.223131 40.066406 21.472656 40.066406 C 26.72204 40.066409 31 35.788588 31 30.539062 L 31 21.490234 C 32.454611 22.653646 34.267517 23.390625 36.269531 23.390625 C 36.542588 23.390625 36.802305 23.374442 37.050781 23.351562 A 1.0001 1.0001 0 0 0 37.958984 22.355469 L 37.958984 17.685547 A 1.0001 1.0001 0 0 0 37.03125 16.6875 C 33.886609 16.461891 31.379838 14.012216 31.052734 10.896484 A 1.0001 1.0001 0 0 0 30.058594 10 L 26.042969 10 z M 27.041016 12 L 29.322266 12 C 30.049047 15.2987 32.626734 17.814404 35.958984 18.445312 L 35.958984 21.310547 C 33.820114 21.201935 31.941489 20.134948 30.835938 18.453125 A 1.0001 1.0001 0 0 0 29 19.003906 L 29 30.539062 C 29 34.707538 25.641273 38.066406 21.472656 38.066406 C 17.304181 38.066406 13.945312 34.707538 13.945312 30.539062 C 13.945312 26.538539 17.066083 23.363182 21 23.107422 L 21 25.283203 C 18.286416 25.535721 16.121094 27.762246 16.121094 30.539062 C 16.121094 33.483274 18.528445 35.892578 21.472656 35.892578 C 24.401892 35.892578 27 33.586491 27 30.59375 C 27 30.64267 27.001859 29.335571 27.005859 27.494141 C 27.009759 25.65271 27.016224 23.20692 27.021484 20.763672 C 27.030884 16.376775 27.039186 12.849206 27.041016 12 z"></path></svg></a>
                <a href="#" class="socialContainer containerYoutube"><svg class="socialSvg" xmlns="http://www.w3.org/2000/svg" x="0px" y="0px" width="100" height="100" viewBox="0 0 50 50"><path d="M 24.402344 9 C 17.800781 9 11.601563 9.5 8.300781 10.199219 C 6.101563 10.699219 4.199219 12.199219 3.800781 14.5 C 3.402344 16.898438 3 20.5 3 25 C 3 29.5 3.398438 33 3.898438 35.5 C 4.300781 37.699219 6.199219 39.300781 8.398438 39.800781 C 11.902344 40.5 17.898438 41 24.5 41 C 31.101563 41 37.097656 40.5 40.597656 39.800781 C 42.800781 39.300781 44.699219 37.800781 45.097656 35.5 C 45.5 33 46 29.402344 46.097656 24.902344 C 46.097656 20.402344 45.597656 16.800781 45.097656 14.300781 C 44.699219 12.101563 42.800781 10.5 40.597656 10 C 37.097656 9.5 31 9 24.402344 9 Z M 24.402344 11 C 31.601563 11 37.398438 11.597656 40.199219 12.097656 C 41.699219 12.5 42.898438 13.5 43.097656 14.800781 C 43.699219 18 44.097656 21.402344 44.097656 24.902344 C 44 29.199219 43.5 32.699219 43.097656 35.199219 C 42.800781 37.097656 40.800781 37.699219 40.199219 37.902344 C 36.597656 38.601563 30.597656 39.097656 24.597656 39.097656 C 18.597656 39.097656 12.5 38.699219 9 37.902344 C 7.5 37.5 6.300781 36.5 6.101563 35.199219 C 5.300781 32.398438 5 28.699219 5 25 C 5 20.398438 5.402344 17 5.800781 14.902344 C 6.101563 13 8.199219 12.398438 8.699219 12.199219 C 12 11.5 18.101563 11 24.402344 11 Z M 19 17 L 19 33 L 33 25 Z M 21 20.402344 L 29 25 L 21 29.597656 Z"></path></svg></a>
            </div>
            <div class="flex font-medium gap-5">
                <a href="#" class="hover:underline text-xs">Terms of Use</a> 
                <a href="#" class="hover:underline text-xs">About the On The Sport</a> 
                <a href="#" class="hover:underline text-xs">Privacy Policy</a> 
                <a href="#" class="hover:underline text-xs">Cookies</a> 
                <a href="#" class="hover:underline text-xs">Accessibility Help</a> 
                <a href="#" class="hover:underline text-xs">Contact the On The Sport</a> 
                <a href="#" class="hover:underline text-xs">Do not share or sell my info</a> 
            </div>
            <p class="font-medium text-xs">Copyright {{ date('Y') }} On The Sport. Hak cipta {{ date('Y') }} On The Sport. Semua hak dilindungi undang-undang.<i> On The Sport tidak bertanggung jawab atas konten situs eksternal.</i></p>
        </div>
    </footer>
    <script>
        function toggleDropdown() {
            document.getElementById("myDropdown").classList.toggle("show");
        }
        window.onclick = function(event) {
            if (!event.target.matches('.group, .group *')) {
                var dropdowns = document.getElementsByClassName("dropdown-content");
                for (var i = 0; i < dropdowns.length; i++) {
                    var openDropdown = dropdowns[i];
                    if (openDropdown.classList.contains('show')) {
                        openDropdown.classList.remove('show');
                    }
                }
            }
        }
    </script>
</body>
</html>