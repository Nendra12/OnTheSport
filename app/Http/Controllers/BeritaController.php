<?php

namespace App\Http\Controllers;

use App\Models\Berita;
use App\Models\Categories;
use Illuminate\Http\Request;

class BeritaController extends Controller
{
    /**
     * @param  \App\Models\Berita  $berita
     * @return \Illuminate\View\View
     */
    public function show(Berita $berita)
    {
        $lists = Categories::all();

        $beritaTerkait = Berita::where('kategori_id', $berita->kategori_id)
                                ->where('id', '!=', $berita->id)
                                ->latest()
                                ->take(4)
                                ->get();

        return view('user.berita_detail', [
            'berita' => $berita,
            'beritaTerkait' => $beritaTerkait,
            'lists' => $lists
        ]);
    }

    public function showSubscribe(Berita $berita)
    {
        $lists = Categories::all();
        $beritaTerkait = Berita::where('kategori_id', $berita->kategori_id)
                                ->where('id', '!=', $berita->id)
                                ->latest()
                                ->take(4)
                                ->get();
        
        return view('user.berita_detail_subscribe', [
            'berita' => $berita,
            'beritaTerkait' => $beritaTerkait,
            'lists' => $lists
        ]);
    }
}