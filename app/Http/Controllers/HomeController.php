<?php
// NAMA FILE: app/Http/Controllers/HomeController.php

namespace App\Http\Controllers;

use App\Models\Berita;
use App\Models\Categories;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index(Categories $category = null)
    {
        $lists = Categories::all();

        if ($category) {
            $posts = $category->beritas()->latest()->get();
        } else {
            $posts = Berita::latest()->get();
        }

        return view('user/home', compact('posts', 'lists'));
    }
}