<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LocaleController;
use App\Http\Controllers\PostController;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();
Route::post('set-locale', [LocaleController::class, 'setLocale'])->name('setLocale');
Route::get('posts/data', [PostController::class, 'getData'])->name('posts.data');
Route::resource('posts', PostController::class);

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
