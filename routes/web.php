<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\CvController;
use App\Http\Controllers\WeblogController;
use App\Http\Controllers\BiographyController;
use App\Http\Controllers\BookController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\ProfileController;
use App\Models\Book;

/* Routes for show bio, weblog, resume and contactMe to client */
Route::get('/', [BiographyController::class, 'show_biography_to_client'])->name('show_biography');
Route::get('/weblog', [WeblogController::class, "show_weblog_to_client"])->name("show_weblog");
Route::get('/resume', [CvController::class, 'show_resume_to_client'])->name('show_cv');
Route::get('/contact', [ContactController::class, 'show_contactMe_to_client'])->name('show_contactMe');
Route::get('/book', [BookController::class, 'show_books_to_client'])->name('show_books');


Route::group(["middleware" => "auth", "prefix" => "/admin"], function() {
    /* Routes for add or edit Biography */
    Route::get('/dashboard', [BiographyController::class, 'show_biography_editPage'])
        ->name('edit_biography');
    Route::post('/dashboard', [BiographyController::class, 'store_biography'])
        ->name('store_biography');

    /* Routes for add or edit user profile name */
    Route::get('/profileName', [ProfileController::class, 'show_profileName_editPage'])
        ->name('change_profileName');
    Route::post('/profileName', [ProfileController::class, 'store_new_profileName'])->
        name('store_profileName');

    /* Routes for add or edit user profile picture */
    Route::get('/profilePic', [ProfileController::class, 'show_profilePic_editPage'])
        ->name('change_profilePic');
    Route::post('/profilePic', [ProfileController::class, 'store_new_profilePic'])
        ->name('store_profilePic');

    /* Routes for add or edit resume pdf file */
    Route::get('/resume_edit', [CvController::class, 'show_resume_editPage'])
        ->name('resume_editPage');
    Route::post('/resume_edit', [CvController::class, 'store_new_resume'])
        ->name('store_resume');
    Route::delete('/delete_resume', [CvController::class, 'delete_old_resume'])
        ->name('delete_resume');

    /* Routes for add or edit weblog url address */
    Route::get('/weblog_edit', [WeblogController::class, 'show_weblog_editPage'])
        ->name('weblog_edit');
    Route::post('/weblog_edit', [WeblogController::class, 'store_weblog_url'])
        ->name('store_weblog');

    /* Routes for add or edit contactMe links */
    Route::get('/contact_edit', [ContactController::class, 'show_contactMe_edit'])
        ->name('show_contactMe_edit');
    Route::post('/contact_edit', [ContactController::class, 'store_contactMe'])
        ->name('store_contactMe');

    /* Routes for add, delete or edit Books */
    Route::get('/book_edit', [BookController::class, 'show_book_editPage'])
        ->name('book_editPage');
    Route::post('/book_store', [BookController::class, 'store_books'])
        ->name('store_book');
    Route::put('/book_update/{id}', [BookController::class, 'update_books'])
        ->name('update_book');
    Route::delete('/book_delete/{id}', [BookController::class, 'delete_books'])
        ->name('delete_book');
});


require __DIR__.'/auth.php';
