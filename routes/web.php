<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/Landing', function () {
    return view('Home');
});

Route::get('/Landing/menu', function () {
    return view("menu");
});