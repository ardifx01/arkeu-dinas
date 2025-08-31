<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LaporanController;
use  App\Http\Controllers\AdminController;
Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::get('/laporan', [LaporanController::class,'index'])->name('laporan.index');
    Route::post('/laporan', [LaporanController::class,'store'])->name('laporan.store');
    Route::delete('/laporan/{id}', [LaporanController::class,'destroy'])->name('laporan.destroy');


    
});
// admin only
Route::middleware(['auth', 'role:admin'])->group(function () {
    Route::resource('pengguna', AdminController::class);
    Route::get('/pengguna', [AdminController::class,'index'])->name('pengguna');
});
require __DIR__.'/auth.php';
