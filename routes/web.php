<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\BukuController;
use App\Http\Controllers\AdminCOntroller;
use App\Http\Controllers\PeminjamController;

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

Route::middleware(['guest'])->group(function(){
    Route::get('/',[LoginController::class,'index'])->name('login');
    Route::post('/',[LoginController::class,'login']);
});
Route::get('/home',function () {
    return redirect('/admin');
});

Route::middleware(['auth'])->group(function(){
    Route::get('/admin', [AdminController::class, 'index']);
    Route::get('/admin/admin', [AdminController::class, 'admin']);
    Route::get('/admin/petugas', [AdminController::class, 'petugas']);
    Route::get('/admin/peminjam', [AdminController::class, 'peminjam']);
    Route::get('/logout',[LoginController::class, 'logout']);
});

//admin
Route::resource('buku', BukuController::class);

//user
Route::resource('peminjam', PeminjamController::class);