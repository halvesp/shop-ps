<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ProductController;

Route::post('register', [AuthController::class, 'register']);
Route::post('login', [AuthController::class, 'login']);

Route::post('products', [ProductController::class, 'create']);
Route::put('products/{id}', [ProductController::class, 'update']);
Route::delete('products/{id}', [ProductController::class, 'delete']);
Route::get('products', [ProductController::class, 'index']);

Route::post('/import-products', [ProductController::class, 'importProducts']);
Route::get('/export-products', [ProductController::class, 'exportProducts']);
Route::post('/import-csv', [ProductController::class, 'importCsv']);