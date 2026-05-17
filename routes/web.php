<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\ArsipDokumenController;
use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\JenisSuratController;
use App\Http\Controllers\PendudukController;
use App\Http\Controllers\PengajuanController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\UserManagementController;
use Illuminate\Support\Facades\Route;

// ─── Landing Page ────────────────────────────────────────────────────────────
Route::get('/', fn() => view('landing'))->name('landing');

// ─── Authentication ───────────────────────────────────────────────────────────
Route::middleware('guest')->group(function () {
    Route::get('/login',     [AuthController::class, 'showLogin'])->name('login');
    Route::post('/login',    [AuthController::class, 'login']);
    Route::get('/register',  [AuthController::class, 'showRegister'])->name('register');
    Route::post('/register', [AuthController::class, 'register']);
});

Route::post('/logout', [AuthController::class, 'logout'])->name('logout')->middleware('auth');

// ─── ADMIN Routes ─────────────────────────────────────────────────────────────
Route::middleware(['auth', 'admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('dashboard');
    Route::resource('penduduk', PendudukController::class);
    Route::resource('jenis-surat', JenisSuratController::class)->except(['show']);

    // Pengajuan
    Route::get('/pengajuan', [PengajuanController::class, 'adminIndex'])->name('pengajuan.index');
    Route::get('/pengajuan/{pengajuan}', [PengajuanController::class, 'adminShow'])->name('pengajuan.show');
    Route::post('/pengajuan/{pengajuan}/approve', [PengajuanController::class, 'approve'])->name('pengajuan.approve');
    Route::post('/pengajuan/{pengajuan}/selesai', [PengajuanController::class, 'selesai'])->name('pengajuan.selesai');
    Route::post('/pengajuan/{pengajuan}/reject',  [PengajuanController::class, 'reject'])->name('pengajuan.reject');

    // Arsip
    Route::get('/arsip', [ArsipDokumenController::class, 'index'])->name('arsip.index');
    Route::get('/arsip/create', [ArsipDokumenController::class, 'create'])->name('arsip.create');
    Route::post('/arsip', [ArsipDokumenController::class, 'store'])->name('arsip.store');
    Route::get('/arsip/{arsip}/download', [ArsipDokumenController::class, 'download'])->name('arsip.download');
    Route::delete('/arsip/{arsip}', [ArsipDokumenController::class, 'destroy'])->name('arsip.destroy');

    // Users
    Route::resource('users', UserManagementController::class)->except(['show']);
    Route::post('/users/{user}/toggle-active', [UserManagementController::class, 'toggleActive'])->name('users.toggle-active');
});

// ─── MASYARAKAT Routes ────────────────────────────────────────────────────────
Route::middleware(['auth', 'masyarakat'])->prefix('user')->name('user.')->group(function () {
    Route::get('/dashboard', [UserController::class, 'dashboard'])->name('dashboard');
    Route::get('/profile',   [UserController::class, 'profile'])->name('profile');
    Route::put('/profile',   [UserController::class, 'updateProfile'])->name('profile.update');

    Route::get('/pengajuan', [PengajuanController::class, 'userIndex'])->name('pengajuan.index');
    Route::get('/pengajuan/create', [PengajuanController::class, 'userCreate'])->name('pengajuan.create');
    Route::post('/pengajuan', [PengajuanController::class, 'userStore'])->name('pengajuan.store');
    Route::get('/pengajuan/{pengajuan}', [PengajuanController::class, 'userShow'])->name('pengajuan.show');
    Route::get('/pengajuan/{pengajuan}/edit', [PengajuanController::class, 'userEdit'])->name('pengajuan.edit');
    Route::put('/pengajuan/{pengajuan}', [PengajuanController::class, 'userUpdate'])->name('pengajuan.update');
    Route::delete('/pengajuan/{pengajuan}', [PengajuanController::class, 'userCancel'])->name('pengajuan.cancel');
});

// ─── Download Surat PDF ───────────────────────────────────────────────────────
Route::middleware('auth')
    ->get('/surat/{surat}/download', [PengajuanController::class, 'downloadSurat'])
    ->name('surat.download');

