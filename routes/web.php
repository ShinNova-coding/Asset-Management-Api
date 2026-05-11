<?php

use App\Http\Controllers\LoginController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\CategoryController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('/login');
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


    Route::get('/manage-users', function() { 
        return view('manageuser'); })->name('users.manage');

    Route::get('/manage-categories', 
    function() { return view('managecategory'); })->name('categories.manage');

});



