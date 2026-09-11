<?php

namespace App\Http\Controllers\Guest;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class LocationController extends Controller
{
    public function index()
    //Hanya Return View Tanpa data apapun
    {
        return view('landing.location');
    }
}
