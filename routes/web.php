<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\CvController;
use App\Http\Controllers\WeblogController;
use App\Http\Controllers\BiographyController;
use App\Http\Controllers\ContactController;
 

Route::get('/', [BiographyController::class, 'show_biography_to_client'])->name('show_biography');


Route::get('weblog', [WeblogController::class, "show_weblog_to_client"])->name("show_weblog");


Route::get('resume', [CvController::class, 'show_resume_to_client'])->name('show_cv');


Route::get('contact', [ContactController::class, 'show_contactMe_to_client'])->name('show_contactMe');


Route::middleware(["auth"])->group(function() {
    Route::get('/dashboard', [BiographyController::class, 'show_biography_editPage_to_admin'])->name('edit_biography');
    Route::post('/dashboard', [BiographyController::class, 'store_biography_to_database'])->name('store_biography');
});


require __DIR__.'/auth.php';
