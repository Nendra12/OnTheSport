<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class Redaksi extends Controller
{
    public function index() 
    {
        return view("redaksi/dashboard");
    }
}
