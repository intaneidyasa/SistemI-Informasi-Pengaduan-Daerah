<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\PengaduanController;
use App\Http\Controllers\AdminUserController;
use App\Http\Controllers\DashboardController;
use Illuminate\Support\Facades\Route;

// Halaman Utama / Beranda
Route::get('/', function () {
    return view('welcome');
});

Route::get('/tentang', function () {
    return view('tentang');
});

Route::get('/cara_pengaduan', function () {
    return view('cara_pengaduan');
});

Route::get('/kontak', function () {
    return view('kontak');
});

// Dashboard User
Route::get('/dashboard', [PengaduanController::class, 'index'])->middleware(['auth', 'verified'])->name('dashboard');

// Pengaduan (User)
Route::get('/pengaduan/buat', [PengaduanController::class, 'create'])->middleware(['auth', 'verified'])->name('pengaduan.create'); 
Route::post('/pengaduan/simpan', [PengaduanController::class, 'store'])->middleware(['auth', 'verified'])->name('pengaduan.store');
Route::get('/pengaduan/riwayat', [PengaduanController::class, 'riwayat'])->middleware(['auth', 'verified'])->name('pengaduan.riwayat');
Route::get('/pengaduan/detail/{id}', [PengaduanController::class, 'show'])->middleware(['auth', 'verified'])->name('pengaduan.show');
Route::get('/pengaduan/edit/{id}', [PengaduanController::class, 'edit'])->middleware(['auth', 'verified'])->name('pengaduan.edit');
Route::put('/pengaduan/update/{id}', [PengaduanController::class, 'update'])->middleware(['auth', 'verified'])->name('pengaduan.update');
Route::get('/pengaduan/file/{filename}', [PengaduanController::class, 'viewFile'])->middleware(['auth', 'verified'])->name('pengaduan.file');

// Rute Khusus Admin
Route::group([
    'middleware' => [
        'auth', 
        'verified', 
        function ($request, $next) {
            if (auth()->user()->role !== 'admin') {
                abort(403, 'Akses ditolak! Halaman ini hanya untuk Admin.');
            }
            return $next($request);
        }
    ]
], function () {
    
    // Dashboard Admin
Route::get('/admin/dashboard', [DashboardController::class, 'index'])->name('admin.dashboard_admin');
    
    // Pengaduan Management (Admin)
    Route::get('/admin/pengaduan', [PengaduanController::class, 'adminIndex'])->name('admin.pengaduan');
    Route::get('/admin/pengaduan/{id}/edit', [PengaduanController::class, 'adminEdit'])->name('admin.pengaduan.edit');
    
    // Rute update yang digunakan oleh formulir admin
    Route::put('/admin/pengaduan/update/{id}', [PengaduanController::class, 'adminUpdate'])->name('admin.pengaduan.update');
    
    Route::delete('/admin/pengaduan/{id}', [PengaduanController::class, 'adminDestroyPengaduan'])->name('admin.pengaduan.destroy');
    
    // User Management (Admin)
    Route::get('/admin/users', [AdminUserController::class, 'index'])->name('admin.users.index');
    Route::get('/admin/users/create', [AdminUserController::class, 'create'])->name('admin.users.create');
    Route::post('/admin/users/store', [AdminUserController::class, 'store'])->name('admin.users.store');
    Route::get('/admin/users/{id}/edit', [AdminUserController::class, 'edit'])->name('admin.users.edit');
    Route::put('/admin/users/{id}', [AdminUserController::class, 'update'])->name('admin.users.update');
    Route::delete('/admin/users/{id}', [AdminUserController::class, 'destroy'])->name('admin.users.destroy');
});

// Profil
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';