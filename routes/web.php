<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CvController;
use App\Http\Controllers\WeblogController;
use App\Http\Controllers\BiographyController;


Route::get('/', [BiographyController::class, 'show'])->name('aboutMe');


Route::get('weblog', [WeblogController::class, "weblog"])->name("weblog");


Route::get('cv', [CvController::class, 'getResume'])->name('cv');