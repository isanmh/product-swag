<?php

use App\Http\Controllers\API\AuthController;
use App\Http\Controllers\API\ProductApiController;
use App\Http\Controllers\SignatureController;
use App\Http\Controllers\SignatureTransactionController;
use App\Http\Controllers\TokenApiController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;


// Login and Register
Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);

// Route::get('/test', [ProductApiController::class, 'test'])->middleware('snap-bi');
Route::get('/test', [ProductApiController::class, 'test']);

// middleware
Route::middleware('auth:sanctum')->group(function () {
    Route::get('/user', [AuthController::class, 'user']);
    Route::post('/logout', [AuthController::class, 'logout']);
});

// /api/products
Route::get('/products', [ProductApiController::class, 'index']);
Route::get('/products/{id}', [ProductApiController::class, 'show']);
Route::post('/products', [ProductApiController::class, 'store']);
Route::put('/products/{id}', [ProductApiController::class, 'update']);
Route::delete('/products/{id}', [ProductApiController::class, 'destroy']);

Route::post('/search', [ProductApiController::class, 'search']);


// SNAP BI
Route::get('/generate-signature', [SignatureController::class, 'generateSignature']);
Route::post('/send-request', [TokenApiController::class, 'sendRequest']);
Route::get('/generate-signature-transaction', [SignatureTransactionController::class, 'generateSignature']);
