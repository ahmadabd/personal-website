<?php

use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\Auth\RegisteredUserController;
use Illuminate\Support\Facades\Route;

Route::middleware(["LogUserAuthentication"])->group(function(){
    Route::get('/register', [RegisteredUserController::class, 'create'])
                ->middleware('guest')
                ->name('register');

    Route::post('/register', [RegisteredUserController::class, 'store'])
                ->middleware('guest')
                ->name('postRegister');

    Route::get('/login', [AuthenticatedSessionController::class, 'create'])
                    ->middleware('guest')
                    ->name('login');

    Route::post('/login', [AuthenticatedSessionController::class, 'store'])
                    ->middleware('guest')
                    ->name("postLogin");

});


Route::get('/logout', [AuthenticatedSessionController::class, 'destroy'])
                ->middleware('auth')
                ->name('logout');
