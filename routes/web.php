
<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\BorrowingController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\EquipmentController;
use Illuminate\Support\Facades\Route;

// Halaman awal
Route::get('/', function () {
    return auth()->check()
        ? redirect()->route('dashboard')
        : redirect()->route('login');
});

// Register dan login hanya untuk user yang belum login
Route::middleware('guest')->group(function () {
    Route::get('/register', [AuthController::class, 'showRegister'])
        ->name('register');

    Route::post('/register', [AuthController::class, 'register']);

    Route::get('/login', [AuthController::class, 'showLogin'])
        ->name('login');

    Route::post('/login', [AuthController::class, 'login']);
});

// Semua fitur yang membutuhkan login
Route::middleware('auth')->group(function () {

    Route::post('/logout', [AuthController::class, 'logout'])
        ->name('logout');

    // Dashboard untuk semua user yang login
    Route::get('/dashboard', [DashboardController::class, 'index'])
        ->name('dashboard');

    // Semua user yang login bisa melihat equipment
    Route::get('/equipment', [EquipmentController::class, 'index'])
        ->name('equipment.index');

    Route::get('/equipment/{equipment}', [EquipmentController::class, 'show'])
        ->whereNumber('equipment')
        ->name('equipment.show');

    // Fitur khusus admin
    Route::middleware('admin')->group(function () {

        // CRUD kategori
        Route::resource('categories', CategoryController::class);

        // Menambah equipment
        Route::get('/equipment/create', [EquipmentController::class, 'create'])
            ->name('equipment.create');

        Route::post('/equipment', [EquipmentController::class, 'store'])
            ->name('equipment.store');

        // Mengedit equipment
        Route::get('/equipment/{equipment}/edit', [EquipmentController::class, 'edit'])
            ->whereNumber('equipment')
            ->name('equipment.edit');

        Route::put('/equipment/{equipment}', [EquipmentController::class, 'update'])
            ->whereNumber('equipment')
            ->name('equipment.update');

        Route::patch('/equipment/{equipment}', [EquipmentController::class, 'update'])
            ->whereNumber('equipment');

        // Menghapus equipment
        Route::delete('/equipment/{equipment}', [EquipmentController::class, 'destroy'])
            ->whereNumber('equipment')
            ->name('equipment.destroy');
    });

    // Semua user yang login bisa melihat riwayat peminjaman
    Route::get('/borrowings', [BorrowingController::class, 'index'])
        ->name('borrowings.index');

    // Membuat peminjaman
    Route::get('/borrowings/create', [BorrowingController::class, 'create'])
        ->name('borrowings.create');

    Route::post('/borrowings', [BorrowingController::class, 'store'])
        ->name('borrowings.store');

    // Melihat detail peminjaman
    Route::get('/borrowings/{borrowing}', [BorrowingController::class, 'show'])
        ->whereNumber('borrowing')
        ->name('borrowings.show');

    // Athlete mengajukan return, admin menyetujui return
    Route::put('/borrowings/{borrowing}', [BorrowingController::class, 'update'])
        ->whereNumber('borrowing')
        ->name('borrowings.update');
});
