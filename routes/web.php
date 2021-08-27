<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\CvController;
use App\Http\Controllers\WeblogController;
use App\Http\Controllers\BiographyController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\ProfileController;

Route::get('/', [BiographyController::class, 'show_biography_to_client'])->name('show_biography');


Route::get('weblog', [WeblogController::class, "show_weblog_to_client"])->name("show_weblog");


Route::get('resume', [CvController::class, 'show_resume_to_client'])->name('show_cv');


Route::get('contact', [ContactController::class, 'show_contactMe_to_client'])->name('show_contactMe');


Route::middleware(["auth"])->group(function() {
    Route::get('/dashboard', [BiographyController::class, 'show_biography_editPage'])
        ->name('edit_biography');
    Route::post('/dashboard', [BiographyController::class, 'store_biography'])
        ->name('store_biography');

    Route::get('/profileName', [ProfileController::class, 'show_profileName_editPage'])
        ->name('change_profileName');
    Route::post('/profileName', [ProfileController::class, 'store_new_profileName'])->
        name('store_profileName');

    Route::get('/profilePic', [ProfileController::class, 'show_profilePic_editPage'])
        ->name('change_profilePic');
    Route::post('/profilePic', [ProfileController::class, 'store_new_profilePic'])
        ->name('store_profilePic');

    Route::get('resume_edit', [CvController::class, 'show_resume_editPage'])
        ->name('resume_editPage');
    Route::post('resume_edit', [CvController::class, 'store_new_resume'])
        ->name('store_resume');

    Route::get('weblog_edit', [WeblogController::class, 'show_weblog_editPage'])
        ->name('weblog_edit');
    Route::post('weblog_edit', [WeblogController::class, 'store_weblog_url'])
        ->name('store_weblog');
});


require __DIR__.'/auth.php';
