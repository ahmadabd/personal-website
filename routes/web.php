<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CvController;
use App\Http\Controllers\WeblogController;


Route::get('/', function () {
    return view('blog');
});


Route::get('weblog', [WeblogController::class, "weblog"])->name("weblog");


Route::get('cv', [CvController::class, 'resume'])->name('cv');