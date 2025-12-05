<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BarangController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SewaController;

Route::get('/', function () {
    return redirect()->route('barang.index');
});

Route::middleware(['auth'])->group(function () {
    Route::view('/faq', 'faq')->name('faq');
    Route::resource('barang', BarangController::class)->except(['show']);
    Route::get('/sewa/{barang}/form', [SewaController::class, 'create'])->name('sewa.create');
    Route::post('/sewa/{barang}', [SewaController::class, 'store'])->name('sewa.store');
    Route::post('/sewa/{sewa}/approve', [SewaController::class, 'approve'])->name('sewa.approve');
    Route::post('/sewa/{sewa}/reject', [SewaController::class, 'reject'])->name('sewa.reject');
    Route::post('/sewa/{sewa}/complete', [SewaController::class, 'complete'])->name('sewa.complete');
    Route::get('/sewa', [SewaController::class, 'index'])->name('sewa.index');
    Route::get('/dashboard/export', [DashboardController::class, 'export'])->middleware('role:admin')->name('dashboard.export');
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});



Route::get('/dashboard', [DashboardController::class, 'index'])
    ->middleware(['auth'])
    ->name('dashboard');

require __DIR__.'/auth.php';
