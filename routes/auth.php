<?php

use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\Auth\RegisteredUserController;
use Illuminate\Support\Facades\Route;

Route::middleware(["LogUserAuthentication", "guest"])->group(function(){
    Route::get('/register', [RegisteredUserController::class, 'create'])
                ->name('register');

    Route::post('/register', [RegisteredUserController::class, 'store'])
                ->name('postRegister');

    Route::get('/login', [AuthenticatedSessionController::class, 'create'])
                    ->name('login');

    Route::post('/login', [AuthenticatedSessionController::class, 'store'])
                    ->name("postLogin");

});


Route::get('/logout', [AuthenticatedSessionController::class, 'destroy'])
                ->middleware('auth')
                ->name('logout');
