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
Route::get('account/edit/{user}', [LoginController::class, 'edit'])->name('account.edit');
Route::put('account/update/{user}', [LoginController::class, 'update'])->name('account.update');

Route::get('create/anuncio/{id}', [AnuncioController::class, 'create'])->name('adver.create');
Route::post('create/anuncio', [AnuncioController::class, 'store'])->name('adver.store');
Route::get('index/anuncios', [AnuncioController::class, 'index'])->name('adver.index');
Route::get('edit/anuncio/{anuncio}', [AnuncioController::class, 'edit'])->name('adver.edit');
Route::put('update/anuncio/{anuncio}', [AnuncioController::class, 'update'])->name('adver.update');
Route::delete('delete/anuncio/{anuncio}', [AnuncioController::class, 'destroy'])->name('adver.destroy');


Route::resource('felinos', FelinoController::class);
Route::resource('colonias', ColoniaController::class);
/* Route::get('index/felinos', [FelinoController::class, 'index'])->name('felinos.index');
Route::get('create/felinos', [FelinoController::class, 'create'])->name('felinos.create');
Route::post('create', [FelinoController::class, 'store'])->name('felinos.store'); */

