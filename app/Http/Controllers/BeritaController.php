<?php

namespace App\Http\Controllers;

use App\Models\Berita;
use App\Models\Categories;
use Illuminate\Http\Request;

class BeritaController extends Controller
{
    /**
     * Menampilkan halaman detail berita untuk PENGGUNA UMUM.
     */
    public function show(Berita $berita)
    {
        // 1. Ambil semua kategori untuk Navbar
        $lists = Categories::all();

        // 2. Ambil berita terkait
        $beritaTerkait = Berita::where('kategori_id', $berita->kategori_id)
                                ->where('id', '!=', $berita->id)
                                ->latest()
                                ->take(4)
                                ->get();

        // 3. Kirim semua data ke view
        return view('user.berita_detail', [
            'berita' => $berita,
            'beritaTerkait' => $beritaTerkait,
            'lists' => $lists // <-- Variabel $lists sekarang dikirim
        ]);
    }

    /**
     * Menampilkan halaman detail berita untuk PENGGUNA PREMIUM.
     */
    public function showSubscribe(Berita $berita)
    {
        // 1. Ambil semua kategori untuk Navbar
        $lists = Categories::all();

        // 2. Ambil berita terkait
        $beritaTerkait = Berita::where('kategori_id', $berita->kategori_id)
                                ->where('id', '!=', $berita->id)
                                ->latest()
                                ->take(4)
                                ->get();
        
        // 3. Kirim semua data ke view premium
        return view('user.berita_detail_subscribe', [
            'berita' => $berita,
            'beritaTerkait' => $beritaTerkait,
            'lists' => $lists // <-- Variabel $lists sekarang dikirim
        ]);
    }
}
