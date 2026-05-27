<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\GameController;

Route::get('/', function () {
    return redirect()->route('login');
});

Route::get('/inicio', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::middleware(['auth'])->group(function () {
    Route::get('/inicio', [UserController::class, 'index'])->name('dashboard');
});

Route::get('/estadisticas', [App\Http\Controllers\StatsController::class, 'index'])
    ->name('estadisticas')
    ->middleware('auth');

Route::get('/ranking', [App\Http\Controllers\RankingController::class, 'index'])
    ->name('ranking')
    ->middleware('auth');

Route::get('/juegos/wordle', [GameController::class, 'wordle'])->name('juegos.wordle')->middleware('auth');
Route::post('/juegos/save-score', [GameController::class, 'saveScore'])->middleware('auth');
Route::get('/juegos/typespeed', [GameController::class, 'typeSpeed'])->name('juegos.typespeed')->middleware('auth');
Route::get('/juegos/bombparty', [GameController::class, 'bombParty'])->name('juegos.bombparty')->middleware('auth');

Route::get('/tienda', [App\Http\Controllers\ShopController::class, 'index'])
    ->name('tienda')
    ->middleware('auth');


Route::post('/tienda/comprar/{id}', [App\Http\Controllers\ShopController::class, 'buyFrame'])
    ->name('tienda.comprar')
    ->middleware('auth');

require __DIR__ . '/auth.php';
