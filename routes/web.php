<?php

use App\Http\Controllers\Web\CategoryController;
use App\Http\Controllers\Web\HomeController;
use App\Http\Controllers\Web\NewsController;
use Illuminate\Support\Facades\Route;

Route::get('/', HomeController::class)->name('home');
// Route::get('/{category:slug}', [NewsController::class, 'index'])->name('news.index');
Route::get('/danh-muc/{category:slug}', [NewsController::class, 'index'])->name('news.index');
Route::get('/danh-muc/{parentSlug}/{slug}', [NewsController::class, 'getChild'])->name('news.child');
Route::get('/tin-tuc/{post:slug}', [NewsController::class, 'show'])->name('news.show');
Route::get('/lien-he', fn () => view('web.contact'))->name('contact');
Route::get('/gioi-thieu', fn () => view('web.about'))->name('about');

require __DIR__.'/admin.php';
