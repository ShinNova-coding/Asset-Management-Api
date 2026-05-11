<?php

use App\Http\Controllers\LoginController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\CategoryController;
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
    
        // User CRUD အတွက် UI ရော API ရော
    Route::get('/users', [UserController::class, 'index'])->name('users.index');
    Route::post('/api/users', [UserController::class, 'store']);
    Route::put('/api/users/{user}', [UserController::class, 'update']);
    Route::delete('/api/users/{id}', [UserController::class, 'destroy']);

    // Category CRUD အတွက် UI ရော API ရော
    Route::get('/categories', [CategoryController::class, 'index'])->name('categories.index');
    Route::post('/api/categories', [CategoryController::class, 'store']);
    Route::put('/api/categories/{category}', [CategoryController::class, 'update']);
    Route::delete('/api/categories/{id}', [CategoryController::class, 'destroy']);

});

