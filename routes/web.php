<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;

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

Route::get('/', [App\Http\Controllers\Auth\LoginController::class, 'showLoginForm']);
Route::post('/login', [App\Http\Controllers\Auth\LoginController::class, 'login'])->name('login');
Route::get('/logout', [App\Http\Controllers\Auth\LoginController::class, 'logout'])->name('logout');

Route::group(['middleware' => 'auth'], function(){
    Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

    Route::get('/guru', [HomeController::class,'indexGuru'])->name('guru');
    Route::get('/siswa', [HomeController::class,'indexSiswa'])->name('siswa');

    Route::get('/detail/{id}/{id_detail}', [HomeController::class,'detail']);
    Route::get('/add/{id}', [HomeController::class,'add']);
    Route::post('/insert/{id}', [HomeController::class,'insert']);
    Route::get('/edit/{id}/{id_edit}', [HomeController::class,'edit']);
    Route::post('/update/{id}/{id_update}', [HomeController::class,'update']);
    Route::get('/delete/{id}/{id_delete}', [HomeController::class,'delete']);
});