<?php

use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\BukuController;
use App\Http\Controllers\KategoriController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ParallelProcessingController;
use App\Http\Controllers\ProfilController;
use App\Http\Controllers\UserController;
use App\Jobs\ProccesDataJob;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

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

// Route untuk login dan logout
Route::get('/login', [AuthController::class, 'loginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// Route unauthorized
Route::get('/unauthorized', [AuthController::class, 'unauthorized'])->name('unauthorized');

// Route untuk halaman utama
Route::get('/', [DashboardController::class, 'index'])->middleware(['auth']);

// Group route dengan middleware auth
Route::middleware(['auth'])->prefix('master-data')->name('master.data.')->group(function () {
    
    // Route untuk kategori (hanya untuk super_admin)
    Route::resource('kategori', KategoriController::class)->middleware(['role:super_admin']);

    // Route untuk buku (untuk super_admin dan admin)
    Route::middleware(['role:super_admin,admin'])->prefix('buku')->name('buku.')->group(function () {
        Route::get('/', [BukuController::class, 'index'])->name('index');
        Route::get('/create', [BukuController::class, 'create'])->name('create');
        Route::post('/', [BukuController::class, 'store'])->name('store');
        Route::get('/{buku}/edit', [BukuController::class, 'edit'])->name('edit');
        Route::put('/{buku}', [BukuController::class, 'update'])->name('update');
        Route::delete('/{buku}', [BukuController::class, 'destroy'])->name('destroy');
    });

    // Route untuk user (hanya untuk super_admin)
    Route::middleware(['role:super_admin'])->prefix('user')->name('user.')->group(function () {
        Route::get('/', [UserController::class, 'index'])->name('index');
        Route::get('/create', [UserController::class, 'create'])->name('create');
        Route::post('/', [UserController::class, 'store'])->name('store');
        Route::get('/{user}/edit', [UserController::class, 'edit'])->name('edit');
        Route::put('/{user}', [UserController::class, 'update'])->name('update');
        Route::delete('/{user}', [UserController::class, 'destroy'])->name('destroy');
    });
});

// Route untuk profil pengguna
Route::middleware(['auth'])->prefix('profil')->name('profil.')->group(function () {
    Route::get('/', [ProfilController::class, 'index'])->name('index');
    Route::put('/{user}', [ProfilController::class, 'update'])->name('update');
});

// Laravel authentication routes
Auth::routes(['reset' => true]);
Route::post('/reset-email', [UserController::class, 'resetEmail'])->name('reset-email');

// Route untuk halaman home (default Laravel)
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
