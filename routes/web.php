<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\ColoniaController;
use App\Http\Controllers\FelinoController;
use App\Http\Controllers\AdoptanteController;
use App\Http\Controllers\AnuncioController;

Route::get('/', function () {
    return view('index');
})->name('index');

//Gestión de los registros de usuarios en la aplicación
Route::get('signUpForm', [LoginController::class, 'signUpForm'])->name('signUp');
Route::post('signUpC', [LoginController::class, 'registerColonia'])->name('signUpColonia');
Route::post('signUp', [LoginController::class, 'registerAdoptante'])->name('signUpAdoptante');
Route::get('login', [LoginController::class, 'loginForm'])->name('loginForm');
Route::post('login', [LoginController::class, 'login'])->name('login');
Route::get('logout', [LoginController::class, 'logout'])->name('logout');

Route::get('account', [LoginController::class, 'account'])->name('account');

Route::get('create/anuncio', [AnuncioController::class, 'create'])->name('adven.create');
Route::post('create/anuncio', [AnuncioController::class, 'store'])->name('adven.store');
Route::get('anuncios', [AnuncioController::class, 'index'])->name('adven.index');

Route::get('index', [FelinoController::class, 'index'])->name('felinos.index');
Route::get('create', [FelinoController::class, 'create'])->name('felinos.create');
Route::post('create', [FelinoController::class, 'store'])->name('felinos.store');

