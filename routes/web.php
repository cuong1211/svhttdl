<?php

use App\Http\Controllers\Admin\Album\VideoController;
use App\Http\Controllers\Web\DocumentController;
use App\Http\Controllers\Web\CategoryController;
use App\Http\Controllers\Web\ContactController;
use App\Http\Controllers\Web\Document_OpinionController;
use App\Http\Controllers\Web\EmployeeController;
use App\Http\Controllers\Web\FaqController;
use App\Http\Controllers\Web\HomeController;
use App\Http\Controllers\Web\ImageController;
use App\Http\Controllers\Web\NewsController;
use App\Models\Document\Document;
use App\Http\Controllers\Web\NotificationController;
use App\Http\Controllers\Web\VideoController as WebVideoController;
use Illuminate\Support\Facades\Route;
use App\Http\Middleware\Filter;

Route::get('/', HomeController::class)->name('home');
Route::get('/tin-tuc/{post:id}', [NewsController::class, 'show'])->name('news.show');
route::get('/danh-muc/gioi-thieu/co-cau-to-chuc', [EmployeeController::class, 'index'])->name('employee.index');
route::get('/danh-muc/gioi-thieu/{id}', [HomeController::class, 'getIntro'])->name('home.intro');
route::get('/nhan-vien/{employee:id}', [EmployeeController::class, 'show'])->name('employee.show');
route::get('/van-ban-qppl', [DocumentController::class, 'index'])->name('document.index');
route::get('/thong-bao', [NotificationController::class, 'index'])->name('noti.index');
route::get('/thong-bao/{Announcement:id}', [NotificationController::class, 'show'])->name('noti.show');
route::get('/video', [WebVideoController::class, 'index'])->name('video.index');
route::get('/video/{video:id}', [WebVideoController::class, 'index'])->name('video.show');
route::get('/image', [ImageController::class, 'index'])->name('image.index');
route::get('/image/{album:id}', [ImageController::class, 'show'])->name('image.show');
route::get('/hoi-dap', [FaqController::class, 'index'])->name('faq.index');
route::get('/hoi-dap/create', [FaqController::class, 'create'])->name('faq.create');
route::post('/hoi-dap/store', [FaqController::class, 'store'])->name('faq.store');
route::get('/hoi-dap/{faq:id}', [FaqController::class, 'show'])->name('faq.show');
route::get('/hoi-dap/done/success', [FaqController::class, 'success'])->name('faq.success');
route::get('/lien-he', [ContactController::class, 'index'])->name('contact.index');
route::post('/lien-he/store', [ContactController::class, 'store'])->name('contact.store');
route::get('/lien-he/done/success', [ContactController::class, 'success'])->name('contact.success');
route::get('/gopy-duthao',[Document_OpinionController::class, 'index'])->name('doc_opi.index');
route::get('/gopy-duthao/{document_opinion}', [Document_OpinionController::class, 'show'])->name('doc_opi.show');
route::post('/gopy-duthao/{document_opinion}/store', [Document_OpinionController::class, 'store'])->name('doc_opi.store');
route::get('/gopy-duthao/done/success', [Document_OpinionController::class, 'success'])->name('doc_opi.success');
route::get('don-vi-su-nghiep/{category:id}/menu/{menu:id}', [HomeController::class, 'getChild'])->name('home.child.index');
route::get('don-vi-su-nghiep/{category:id}/menu/{menu:id}/gioi-thieu-chung/{id}', [HomeController::class, 'getChildIntro'])->name('home.child.intro');
route::get('don-vi-su-nghiep/{category:id}/menu/{menu:id}/post/{post:id}', [HomeController::class, 'getPost'])->name('home.child.post');
Route::get('/danh-muc/{category:id}', [NewsController::class, 'index'])->name('news.index');
Route::get('/danh-muc-con/{Id}', [NewsController::class, 'getChild'])->name('news.child');

require __DIR__ . '/admin.php';
