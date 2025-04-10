<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;

Route::get('/', function () {
    return view('index');
})->name('index');

Route::get('signUpForm', [LoginController::class, 'signUpForm'])->name('signUp');
Route::post('signUp', [LoginController::class, 'registerCologne'])->name('signUpCologne');
