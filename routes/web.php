<?php

declare(strict_types=1);

use App\Http\Controllers\TodoController;
use Illuminate\Support\Facades\Route;

Route::get('/', [TodoController::class, 'index'])->name('todos.index');
Route::post('/', [TodoController::class, 'store'])->name('todos.store');
