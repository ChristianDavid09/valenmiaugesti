<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\CologneController;
use App\Http\Controllers\FelineController;
use App\Http\Controllers\AdopterController;
use App\Http\Controllers\AdvertisementController;
use App\Http\Controllers\MessageController;
use App\Http\Controllers\PublicationController;
use App\Http\Controllers\ResponseController;


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
Route::put('update', [LoginController::class, 'updateColony'])->name('updateColony');

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


Route::resource('adopters', AdopterController::class);
Route::resource('responses', ResponseController::class);
Route::get('/messages/{message}/responses', [ResponseController::class, 'showForMessage'])->name('responses.forMessage');
Route::get('/publications/mypub', [PublicationController::class, 'myPub'])->name('publications.myPub');
Route::resource('publications', PublicationController::class);
Route::resource('messages', MessageController::class);
Route::patch('/messages/{message}/status', [MessageController::class, 'updateStatus'])->name('messages.updateStatus');
Route::patch('/felines/{feline}/desactivate', [FelineController::class, 'inactive'])->name('felines.desactivate');
Route::get('/messages/create/{feline}/for/{cologne}', [MessageController::class, 'createForCologne'])->name('messages.create.for');
Route::resource('felines', FelineController::class);
Route::resource('colognes', CologneController::class)->middleware('auth');




