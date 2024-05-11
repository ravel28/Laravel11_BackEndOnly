<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

// Home
Route::post('/users/create', [UserController::class, 'createUser']);
Route::post('/users/login', [UserController::class, 'checkUserAccount']);
Route::get('/users/{take}', [UserController::class,'index']);
Route::get('/users/finding/{id}', [UserController::class, 'checkUserAccountById']);
Route::put('/users/update/{id}', [UserController::class, 'updateUser']);
Route::delete('/users/delete/{id}', [UserController::class, 'deleteUser']);
