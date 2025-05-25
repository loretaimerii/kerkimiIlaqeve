<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\IlaqetController;
use App\Models\Ilaqet;

Route::get('/', function () {
    return view('home');
})->name('home');

Route::get('/login', function(){
    return view('login');
})->name('login');
Route::post('/login',[UserController::class,'login']);
Route::post('/logout',[UserController::class,'logout']);

Route::get('/register',function(){
    return view('register');
})->name('register');
Route::post('/register',[UserController::class,'register']);

Route::get('/search',[IlaqetController::class,'search'])->name('search');
Route::get('/download',[IlaqetController::class,'downloadToCsv'])->name('dowload.csv');
Route::get('/allCodes',[IlaqetController::class,'index'])->name('allCodes');
Route::delete('/deleteCode/{ilaq}',[IlaqetController::class,'delete']);