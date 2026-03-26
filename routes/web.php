<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\FinanceController;

Route::redirect('/', '/login');

Route::get('/login', [LoginController::class,'index'])->name('login');
Route::post('/login', [LoginController::class,'login']);

Route::middleware('auth')->group(function () {
    Route::get('/finance', [FinanceController::class,'index']);
    Route::post('/finance', [FinanceController::class,'store']);
    Route::put('/finance/{id}', [FinanceController::class,'update']);
    Route::delete('/finance/{id}', [FinanceController::class,'destroy']);

    Route::post('/logout', [LoginController::class,'logout'])->name('logout');
});