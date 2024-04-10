<?php

use App\Http\Controllers\CommentController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/comment', [CommentController::class, 'index'])->name('comment');
Route::get('/reload-captcha',[CommentController::class, 'reloadCaptcha']);
Route::post('/commentPost', [CommentController::class, 'captchaPost'])->name('post');
