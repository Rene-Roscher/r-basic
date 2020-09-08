<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Auth::routes();
Route::get('/logout', fn() => !Auth::logout() ? back()->withSuccess(strval('Sie haben sich erfolgreich abgemeldet.')) : abort(401))->name('logout')->middleware('auth');

Route::view('/', 'welcome');

Route::view('/home', 'home')->middleware(['web', 'auth'])->name('home');
Route::get('/data', fn() => datatables(\RServices\User::all())->make())->middleware(['web', 'auth'])->name('datatable');