<?php

use Illuminate\Support\Facades\Route;
//Route Buat Welcome
Route::get('/welcome' , function() {
    return view('welcome');
})->name('welcome');

// Route untuk Home
Route::get('/home', function () {
    return view('landing.home');
})->name('home');

// Route untuk Menu (INI YANG BELUM ADA)
Route::get('/menu', function () {
    return view('landing.menu');
})->name('menu');

// Route untuk Location
Route::get('/location', function () {
    return view('landing.location');
})->name('location');

// Route untuk Contact
Route::get('/contact', function () {
    return view('landing.contact');
})->name('contact');

// Route untuk About
Route::get('/about', function () {
    return view('landing.about');
})->name('about');


// Bagian Admin Page
Route::get('/admin/dashboard', function () {
    return view('admin.dashboard');
})->name('admin.dashboard');

Route::get('/admin/menu', function () {
    return view('admin.menu');
})->name('admin.menu');

Route::get('/admin/order', function () {
    return view('admin.order');
})->name('admin.order');