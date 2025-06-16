<?php

namespace App\Http\Controllers;

use App\Models\Berita;
use App\Models\Categories;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        // Ambil semua data post dari database
        $posts = Berita::all();
        $lists = Categories::all();

        // Kirim data ke view 'home'
        return view('user/home', compact('posts', 'lists'));
    }
}
