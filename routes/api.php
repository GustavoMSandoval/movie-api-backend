<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;

Route::get('/', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::post('/submit', [UserController::class,'RegisterUser']);