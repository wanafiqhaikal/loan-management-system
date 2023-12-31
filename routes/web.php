<?php

use App\Http\Controllers\LoanController;
use Illuminate\Support\Facades\Route;

Route::get('/', [LoanController::class, 'index'])->name('home');
Route::get('/loans', [LoanController::class, 'index'])->name('loans.index');
Route::get('/loans/create', [LoanController::class, 'create'])->name('loans.create');
Route::post('/loans', [LoanController::class, 'store'])->name('loans.store');
Route::get('/loans/{loan}', [LoanController::class, 'show'])->name('loans.show');
Route::get('/loans/{loan}/edit', [LoanController::class, 'edit'])->name('loans.edit');
Route::put('/loans/{loan}', [LoanController::class, 'update'])->name('loans.update');
Route::delete('/loans/{loan}', [LoanController::class, 'destroy'])->name('loans.destroy');
Route::get('/download/{file}', [LoanController::class, 'download'])->name('loans.download');
