<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BarangController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SewaController;
use App\Http\Controllers\UserController;

/*
|-------------------------------------------------------------------------- 
| Landing Page (Public)
|-------------------------------------------------------------------------- 
*/
Route::get('/', function () {
    return view('welcome');
});

/*
|-------------------------------------------------------------------------- 
| Routes untuk user login
|-------------------------------------------------------------------------- 
*/
Route::middleware(['auth'])->group(function () {

    Route::view('/faq', 'faq')->name('faq');

    // Barang
    Route::resource('barang', BarangController::class)->except(['show']);

    // Sewa
    Route::get('/sewa/{barang}/form', [SewaController::class, 'create'])->name('sewa.create');
    Route::post('/sewa/{barang}', [SewaController::class, 'store'])->name('sewa.store');
    Route::post('/sewa/{sewa}/approve', [SewaController::class, 'approve'])->name('sewa.approve');
    Route::post('/sewa/{sewa}/reject', [SewaController::class, 'reject'])->name('sewa.reject');
    Route::post('/sewa/{sewa}/complete', [SewaController::class, 'complete'])->name('sewa.complete');
    Route::get('/sewa', [SewaController::class, 'index'])->name('sewa.index');

    // Dashboard
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::get('/dashboard/export', [DashboardController::class, 'export'])
        ->middleware('role:admin')
        ->name('dashboard.export');

    // Profile
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

/*
|-------------------------------------------------------------------------- 
| KATEGORI (ADMIN ONLY)
|-------------------------------------------------------------------------- 
*/
Route::middleware(['auth', 'role:admin'])
    ->prefix('kategori')
    ->name('category.')
    ->controller(CategoryController::class)
    ->group(function () {
        Route::get('/', 'index')->name('index');           // Daftar kategori
        Route::get('/create', 'create')->name('create');   // Form tambah kategori
        Route::post('/', 'store')->name('store');          // Simpan kategori baru
        Route::put('/{category}', 'update')->name('update');   // Update kategori
        Route::delete('/{category}', 'destroy')->name('destroy'); // Hapus kategori
    });

/*
|-------------------------------------------------------------------------- 
| USER MANAGEMENT (ADMIN ONLY)
|-------------------------------------------------------------------------- 
*/
Route::middleware(['auth', 'role:admin'])
    ->prefix('users')
    ->name('user.')
    ->controller(UserController::class)
    ->group(function () {
        Route::get('/', 'index')->name('index');
        Route::get('/{user}', 'show')->name('show');
        Route::get('/{user}/edit', 'edit')->name('edit');
        Route::put('/{user}', 'update')->name('update');
        Route::delete('/{user}', 'destroy')->name('destroy');
    });

// Auth Routes
require __DIR__ . '/auth.php';
