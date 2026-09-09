<?php

namespace App\Http\Controllers\Guest;

use App\Http\Controllers\Controller;

class HomeController extends Controller
{
    public function index()
    {
        // Cuma return view, tanpa ngirim data apapun
        return view('landing.home');
    }
}