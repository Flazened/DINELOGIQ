<?php

use Illuminate\Support\Facades\Route;
//Route Buat Welcome
Route::get('/welcome' , function() {
    return view('welcome');
})->name('welcome');

// Route untuk Home
Route::get('/home', function () {
    return view('Landing.home');
})->name('home');

// Route untuk Menu (INI YANG BELUM ADA)
Route::get('/menu', function () {
    return view('Landing.menu');
})->name('menu');

// Route untuk Location
Route::get('/location', function () {
    return view('Landing.location');
})->name('location');

// Route untuk Contact
Route::get('/contact', function () {
    return view('Landing.contact');
})->name('contact');

// Route untuk About
Route::get('/about', function () {
    return view('Landing.about');
})->name('about');