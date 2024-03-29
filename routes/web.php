<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CustomAuthController;
use App\Http\Controllers\AdminDashboardController;
use App\Http\Controllers\PendudukController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\KepalaKeluargaController;

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
Route::get('login', [CustomAuthController::class, 'index'])->name('login');
Route::post('custom-login', [CustomAuthController::class, 'customLogin'])->name('login.custom'); 
Route::get('signout', [CustomAuthController::class, 'signOut'])->name('signout');


Route::get('/',[AdminDashboardController::class,'index'])->name('admin.dashboard');
Route::resource('penduduk',PendudukController::class);
Route::resource('user',UserController::class);
Route::resource('kepalakeluarga',KepalaKeluargaController::class);
Route::post('kepalakeluarga-store-anggota/{id}',[KepalaKeluargaController::class,'store_anggota'])->name('kepalakeluarga.store-anggota');
Route::get('logs', [\Rap2hpoutre\LaravelLogViewer\LogViewerController::class, 'index']);
