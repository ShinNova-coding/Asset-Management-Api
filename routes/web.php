<?php

use App\Http\Controllers\LoginController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/login',[LoginController::class,'create'])->name('login')->middleware('guest');

Route::post('/login',[LoginController::class,'store'])->middleware('guest');

Route::post('/logout',[LoginController::class,'destroy'])->middleware('auth');

Route::middleware('auth')->group(function(){
    Route::get('/dashboard',function(){
        return view('dashboard');
    });

    Route::get('/asset',function(){
        return view('asset');
    });
});

