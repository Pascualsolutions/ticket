<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PageController;


Route::get('/', [PageController::class,'index'])->name('index');
Route::get('/products/{id}', [PageController::class,'show'])->name('show');
Route::get('/home', function () {
    return view('home');
})->name('home');
