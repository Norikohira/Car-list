<?php

use App\Http\Controllers\CarController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/create', [CarController::class, 'create'])->name('car.create');
Route::get('/add', [CarController::class, 'add'])->name('car.add');
Route::post('/list/save', [CarController::class, 'store'])->name('car.store');
Route::get('/list/edit/{id}', [CarController::class, 'edit'])->name('car.edit');
Route::patch('/list/update/{id}', [CarController::class, 'update'])->name('car.update');
Route::delete('/destroy/{id}', [CarController::class, 'destroy'])->name('car.destroy');
