<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AnggotaController;
use App\Http\Controllers\Login;

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

Route::get('/', [Login::class, 'login'])->name('login');
Route::post('/', [Login::class, 'actionLogin'])->name('auth.check');
Route::get('/logout', [Login::class, 'logout'])->name('auth.logout');

Route::middleware('admin')->prefix('/anggota')->group(function() {
    Route::get('/', [AnggotaController::class, 'index'])->name('index');
    Route::post('/', [AnggotaController::class, 'saveAnggota'])->name('anggota.s');
    Route::get('/show/{id?}', [AnggotaController::class, 'getAnggota'])->name('anggota.g');
    Route::put('/{anggota}', [AnggotaController::class, 'updateAnggota'])->name('anggota.u');
    Route::delete('/{anggota}', [AnggotaController::class, 'deleteAnggota'])->name('anggota.d');
});
