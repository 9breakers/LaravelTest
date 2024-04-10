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

Route::get('/comments', [CommentController::class, 'index'])->name('comments.index');
Route::post('/comments', [CommentController::class, 'store'])->name('comments.store');
Route::get('/comments/{comment}/reply', [CommentController::class, 'showReplyForm'])->name('reply.form');
Route::post('/comments/{comment}/reply', [CommentController::class, 'createReply'])->name('comments.reply');
Route::get('/reload-captcha',[CommentController::class, 'reloadCaptcha']);
