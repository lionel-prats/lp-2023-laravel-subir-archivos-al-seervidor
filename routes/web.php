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

Auth::routes();

// home
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

// upload de archivos
Route::post('/upload', [App\Http\Controllers\User\FilesController::class, 'store'])->name('user.files.store');

// opcion "Mis archivos"
Route::get('/files', [App\Http\Controllers\User\FilesController::class, 'index'])->name('user.files.index');
Route::get('/file/{file}', [App\Http\Controllers\User\FilesController::class, 'show'])->name('user.files.show');
