<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PersonalController;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('blog');
});


Route::get('weblog', [PersonalController::class, "weblog"])->name("weblog");


Route::get('cv', [PersonalController::class, 'resume'])->name('cv');