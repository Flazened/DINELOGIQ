<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    /**
     * Tampilkan halaman login
     */
    public function showLogin()
    {
        return view('auth.login');
    }

    /**
     * Proses login
     */
    public function login(Request $request)
    {
        // Nanti diisi pas backend sudah siap
        return redirect()->route('admin.dashboard');
    }

    /**
     * Proses logout
     */
    public function logout(Request $request)
    {
        // Nanti diisi pas backend sudah siap
        return redirect()->route('home');
    }
}