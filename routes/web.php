<?php

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

Route::get('/', function () {
    return view('welcome');
});
Route::get('/index', [App\Http\Controllers\PasteController::class, 'index'])->name('index');
Route::post('/create', [App\Http\Controllers\PasteController::class, 'create'])->name('create');
Route::get('/link/{link}', [App\Http\Controllers\PasteController::class, 'getLink'])->name('getLink');

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/show', [App\Http\Controllers\PasteController::class, 'show'])->name('show');
