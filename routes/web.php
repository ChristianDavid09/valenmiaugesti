<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\CologneController;
use App\Http\Controllers\FelineController;
use App\Http\Controllers\AdopterController;
use App\Http\Controllers\AdvertisementController;
use App\Http\Controllers\MessageController;


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


Route::post('create/adver', [AdvertisementController::class, 'store'])->name('advertisement.store');
Route::get('index/advers', [AdvertisementController::class, 'index'])->name('advertisement.index');
Route::get('edit/adver/{adver}', [AdvertisementController::class, 'edit'])->name('advertisement.edit');
Route::get('show/adver/{adver}', [AdvertisementController::class, 'show'])->name('advertisement.show');
Route::put('update/adver/{adver}', [AdvertisementController::class, 'update'])->name('advertisement.update');
Route::delete('delete/adver/{adver}', [AdvertisementController::class, 'destroy'])->name('advertisement.destroy');
Route::get('create/adver/{id}', [AdvertisementController::class, 'create'])->name('advertisement.create');


Route::resource('messages', MessageController::class);
Route::resource('felines', FelineController::class);
Route::resource('colognes', CologneController::class)->middleware('auth');
/* Route::get('index/felinos', [FelinoController::class, 'index'])->name('felinos.index');
Route::get('create/felinos', [FelinoController::class, 'create'])->name('felinos.create');
Route::post('create', [FelinoController::class, 'store'])->name('felinos.store'); */

