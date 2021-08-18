<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\CvController;
use App\Http\Controllers\WeblogController;
use App\Http\Controllers\BiographyController;
use App\Http\Controllers\ContactController;
 

Route::get('/', [BiographyController::class, 'show'])->name('about');


Route::get('weblog', [WeblogController::class, "weblog"])->name("weblog");


Route::get('resume', [CvController::class, 'getResume'])->name('cv');


Route::get('contact', [ContactController::class, 'show'])->name('contact');


Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');


require __DIR__.'/auth.php';
