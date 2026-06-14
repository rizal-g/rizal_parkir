<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LocationController;
use App\Http\Controllers\VehicleTypeController;
use App\Http\Controllers\TransactionController;

Route::redirect('/', '/location');

Route::get('/location', [LocationController::class, 'index'])->name('location.index');
Route::get('/location/create', [LocationController::class, 'create'])->name('location.create');
Route::post('/location', [LocationController::class, 'store'])->name('location.store');
Route::get('/vehicle-type', [VehicleTypeController::class, 'index'])->name('vehicletype.index');
Route::get('/vehicle-type/create', [VehicleTypeController::class, 'create'])->name('vehicletype.create');
Route::post('/vehicle-type', [VehicleTypeController::class, 'store'])->name('vehicletype.store');
Route::get('/transaction', [TransactionController::class, 'index'])->name('transaction.index');
Route::post('/transactions/enter', [TransactionController::class, 'storeEnter'])->name('transaction.storeEnter');
Route::post('/transactions/exit', [TransactionController::class, 'processExit'])->name('transaction.exit');
Route::get('/transactions/ticket/{id}', [TransactionController::class, 'downloadTicket'])->name('transaction.ticket.pdf');
Route::get('/transactions/list', [TransactionController::class, 'list'])->name('transaction.list');