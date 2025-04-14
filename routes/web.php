<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;

Route::get('/', function () {
    return view('index');
})->name('index');

//Gestión de los registros de usuarios en la aplicación
Route::get('signUpForm', [LoginController::class, 'signUpForm'])->name('signUp');
Route::post('signUpC', [LoginController::class, 'registerColonia'])->name('signUpColonia');
Route::post('signUp', [LoginController::class, 'registerAdoptante'])->name('signUpAdoptante');
