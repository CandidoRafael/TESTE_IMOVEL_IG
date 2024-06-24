<?php

use App\Http\Controllers\CorretorController;
use Illuminate\Support\Facades\Route;

Route::get('/', [CorretorController::class, "index"]);
Route::post('/corretores', [CorretorController::class, "store"]);
Route::get('/corretores/edit/{id}', [CorretorController::class, "edit"]);
Route::put('/corretores/update/{id}', [CorretorController::class, "update"]);
Route::delete('/corretores/{id}', [CorretorController::class, "destroy"]);