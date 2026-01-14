<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('home');
})->middleware(['auth']);

Route::view('/contacts', 'contacts')->name('contacts');
