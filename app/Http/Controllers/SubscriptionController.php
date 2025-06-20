<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Berita;
use App\Models\Categories; 

class SubscriptionController extends Controller
{
    /**
     * Menampilkan halaman subscribe dengan berita yang sudah difilter atau semua berita.
     * @param \App\Models\Categories|null $category
     */
    public function create(Categories $category = null)
    {
        $lists = Categories::all();

        if ($category) {
            $posts = $category->beritas()->latest()->get();
        } else {
            $posts = Berita::latest()->get();
        }
        
        return view('user.subscribe', [
            'lists' => $lists,
            'posts' => $posts
        ]);
    }

    public function store(Request $request)
    {

    }
}