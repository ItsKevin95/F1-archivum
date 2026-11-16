<?php

use App\Http\Controllers\AdatbazisController;
use App\Http\Controllers\DiagramController;
use App\Http\Controllers\FooldalController;
use App\Http\Controllers\KapcsolatController;
use App\Http\Controllers\PilotaController;
use App\Http\Controllers\UzenetController;
use App\Http\Middleware\AdminOnly;
use Illuminate\Support\Facades\Route;

// Látogató (mindenki)
Route::get('/', [FooldalController::class, 'index'])->name('home');
Route::get('adatbazis', [AdatbazisController::class, 'index'])->name('adatbazis');
Route::get('kapcsolat', [KapcsolatController::class, 'create'])->name('kapcsolat');
Route::post('kapcsolat', [KapcsolatController::class, 'store'])->name('kapcsolat.kuld');
Route::get('diagram', [DiagramController::class, 'index'])->name('diagram');

// Regisztrált látogató (bejelentkezett)
Route::middleware('auth')->group(function () {
    Route::get('uzenetek', [UzenetController::class, 'index'])->name('uzenetek');

    // A starter kit bejelentkezés után ide irányít, innen a főoldalra küldjük tovább
    Route::get('dashboard', fn () => redirect()->route('home'))->name('dashboard');
});

// Admin
Route::middleware(['auth', AdminOnly::class])->group(function () {
    Route::resource('crud', PilotaController::class)
        ->parameters(['crud' => 'pilota'])
        ->except('show');
});

require __DIR__.'/settings.php';
