<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TodoController;

Route::get('/xtpo', function () {
    return view('welcome');
});
Route::get('/todos', [TodoController::class, 'index'])->name('todos.index');
Route::post('/todos', [TodoController::class, 'add'])->name('todos.store');
Route::post('/todos/{id}/complete', [TodoController::class, 'complete'])->name('todos.complete');
Route::delete('/todos/{id}', [TodoController::class, 'delete'])->name('todos.destroy');
