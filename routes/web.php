<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\FinanceController;

Route::get('/login', [LoginController::class,'index']);
Route::post('/login', [LoginController::class,'login']);

Route::get('/finance', [FinanceController::class,'index'])->middleware('auth');
Route::post('/finance', [FinanceController::class,'store'])->middleware('auth');