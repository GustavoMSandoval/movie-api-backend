<?php

use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;


Route::middleware('auth:sanctum')->post('/',[UserController::class,'RegisterUser']);

Route::get('/teste',function() {
    return view('welcome');
});


