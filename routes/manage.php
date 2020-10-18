<?php

use Illuminate\Support\Facades\Route;

Route::view('/', 'manage.dashboard')->name('manage.dashboard');
Route::crud(\RServices\User::class);
Route::profile();