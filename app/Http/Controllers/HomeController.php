<?php

namespace App\Http\Controllers;

use App\Models\Berita;
use App\Models\Categories;
use Carbon\Carbon;

class HomeController extends Controller
{
    public function index(Categories $category = null)
    {
        $lists = Categories::all();
        $postsQuery = Berita::query();

        if ($category) {
            $postsQuery->where('kategori_id', $category->id);
        }

        $delayInMinutes = 1; 

        $timeLimit = Carbon::now()->subMinutes($delayInMinutes);

        $postsQuery->where('created_at', '<=', $timeLimit);

        $posts = $postsQuery->latest()->get();

        return view('user.home', compact('posts', 'lists'));
    }
}