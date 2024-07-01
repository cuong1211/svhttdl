<?php

use App\Http\Controllers\Admin\Album\VideoController;
use App\Http\Controllers\Web\DocumentController;
use App\Http\Controllers\Web\CategoryController;
use App\Http\Controllers\Web\EmployeeController;
use App\Http\Controllers\Web\HomeController;
use App\Http\Controllers\Web\ImageController;
use App\Http\Controllers\Web\NewsController;
use App\Models\Document\Document;
use App\Http\Controllers\Web\NotificationController;
use App\Http\Controllers\Web\VideoController as WebVideoController;
use Illuminate\Support\Facades\Route;

Route::get('/', HomeController::class)->name('home');

Route::get('/tin-tuc/{post:slug}', [NewsController::class, 'show'])->name('news.show');
route::get('/danh-muc/gioi-thieu/thong-tin-chung', fn () => view('web.about'))->name('about');
route::get('/danh-muc/gioi-thieu/co-cau-to-chuc', [EmployeeController::class, 'index'])->name('employee.index');
route::get('/nhan-vien/{employee:id}', [EmployeeController::class, 'show'])->name('employee.show');
route::get('/van-ban-qppl', [DocumentController::class,'index'])->name('document.index');
Route::get('/lien-he', fn () => view('web.contact'))->name('contact');
Route::get('/gioi-thieu', fn () => view('web.about'))->name('about');
route::get('/thong-bao', [NotificationController::class,'index'])->name('noti.index');
route::get('/thong-bao/{Announcement:id}', [NotificationController::class,'show'])->name('noti.show');
route::get('/video', [WebVideoController::class,'index'])->name('video.index');
route::get('/video/{video:id}', [WebVideoController::class,'index'])->name('video.show');
route::get('/image', [ImageController::class,'index'])->name('image.index');
Route::get('/danh-muc/{category:slug}', [NewsController::class, 'index'])->name('news.index');
Route::get('/danh-muc/{parentSlug}/{slug}', [NewsController::class, 'getChild'])->name('news.child');

require __DIR__.'/admin.php';
