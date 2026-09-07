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
use App\Http\Controllers\ContactController;
use App\Http\Controllers\PolitytermsController;


Route::get('/', function () {
    return view('index');
})->name('index');


// Rutas públicas
Route::controller(LoginController::class)->group(function () {
    Route::get('signUpForm', 'signUpForm')->name('signUp');
    Route::post('signUpC', 'registerColonia')->name('signUpColonia');
    Route::post('signUp', 'registerAdoptante')->name('signUpAdoptante');
    Route::get('login', 'loginForm')->name('loginForm');
    Route::post('login', 'login')->name('login');
    Route::get('logout', 'logout')->name('logout');
});

// Rutas protegidas con middleware 'auth'
Route::middleware('auth')->group(function () {

    //  Cuenta de usuario
    Route::controller(LoginController::class)->group(function () {
        Route::get('account', 'account')->name('account');
        Route::get('account/edit/{user}', 'edit')->name('account.edit');
        Route::put('account/update/{user}', 'update')->name('account.update');
        Route::put('update', 'updateColony')->name('updateColony');
    });

    // Anuncios
    Route::controller(AdvertisementController::class)->group(function () {
        Route::post('create/adver', 'store')->name('advertisement.store');
        Route::get('index/advers', 'index')->name('advertisement.index');
        Route::get('edit/adver/{adver}', 'edit')->name('advertisement.edit');
        Route::get('show/adver/{adver}', 'show')->name('advertisement.show');
        Route::put('update/adver/{adver}', 'update')->name('advertisement.update');
        Route::delete('delete/adver/{adver}', 'destroy')->name('advertisement.destroy');
        Route::get('create/adver/{id}', 'create')->name('advertisement.create');
    });

    //  Felinos
    Route::patch('/felines/{feline}/desactivate', [FelineController::class, 'inactive'])->name('felines.desactivate');
    Route::resource('felines', FelineController::class);

    //  Adoptantes y colonias
    Route::resource('adopters', AdopterController::class);
    Route::resource('colognes', CologneController::class);

    // Mensajes y respuestas
    Route::resource('messages', MessageController::class);
    Route::patch('/messages/{message}/status', [MessageController::class, 'updateStatus'])->name('messages.updateStatus');
    Route::get('/messages/create/{feline}/for/{cologne}', [MessageController::class, 'createForCologne'])->name('messages.create.for');
    Route::resource('responses', ResponseController::class);
    Route::get('/messages/{message}/responses', [ResponseController::class, 'showForMessage'])->name('responses.forMessage');

    // Publicaciones
    Route::get('/publications/mypub', [PublicationController::class, 'myPub'])->name('publications.myPub');
    Route::get('/publications/process', [PublicationController::class, 'process'])->name('publications.process');
    Route::resource('publications', PublicationController::class);
    
    Route::get('/contactUs', [ContactController::class, 'index'])->name('contactUs');
    Route::post('/contactUs/send', [ContactController::class, 'send'])->name('contact.send');

    Route::get('/privacy-policy', [PolitytermsController::class, 'index'])->name('privacyPolicy');
    Route::get('/terms-of-service', [PolitytermsController::class, 'show'])->name('termsOfService');

});





