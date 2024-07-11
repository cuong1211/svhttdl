<?php

use App\Http\Controllers\Admin\Album\CooperationController;
use App\Http\Controllers\Admin\Album\PhotoController;
use App\Http\Controllers\Admin\Album\VideoController;
use App\Http\Controllers\Admin\AlbumController;
use App\Http\Controllers\Admin\AnnouncementController;
use App\Http\Controllers\Admin\AnswerController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\ContactController;
use App\Http\Controllers\Admin\FaqController;
use App\Http\Controllers\Admin\PostController;
use App\Http\Controllers\Admin\RichTextAttachmentController;
use App\Http\Controllers\Admin\Staff\DepartmentController;
use App\Http\Controllers\Admin\Staff\StaffController;
use App\Http\Controllers\Admin\Staff\PositionController;
use App\Http\Controllers\Admin\Document\TypeDocumentController;
use App\Http\Controllers\Admin\Document\DocumentController;
use App\Http\Controllers\Admin\Document\SignerDocumentController;
use App\Http\Controllers\Admin\TagController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Admin\Custom\MenuController;
use App\Http\Controllers\Admin\Custom\AdController;
use App\Http\Controllers\Admin\Custom\AddOnController;
use App\Http\Controllers\Admin\Custom\BannerController;
use App\Http\Controllers\Admin\Document_Opinion\Document_OpinionController;
use App\Http\Controllers\Admin\Document_Opinion\OpinionController;
use App\Http\Controllers\Admin\User\CategorieController;
use App\Http\Controllers\Admin\User\UserController;
use App\Http\Middleware\CheckDepartmentAccess;
use Illuminate\Support\Facades\Route;

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::prefix('admin')->name('admin.')->group(function () {
        Route::resource('categories', CategoryController::class);
        Route::resource('tags', TagController::class);

        //post of category
        Route::group(['middleware'=> CheckDepartmentAccess::class],function () {
            Route::get('/category/{category:id}/post', [PostController::class, 'index'])->name('categories.posts.index');
            route::get('/cate/{id}', [PostController::class, 'getCate'])->name('categories.posts.getCate');
            Route::get('/category/{category:id}/posts/create', [PostController::class, 'create'])->name('categories.posts.create');
            Route::post('/category/{category:id}/posts', [PostController::class, 'store'])->name('categories.posts.store');
            Route::get('/category/{category:id}/posts/{post}/edit', [PostController::class, 'edit'])->name('categories.posts.edit');
            Route::put('/category/{category:id}/posts/{post}', [PostController::class, 'update'])->name('categories.posts.update');
            Route::delete('/category/{category:id}/posts/{post}', [PostController::class, 'destroy'])->name('categories.posts.destroy');
        });
        Route::resource('announcements', AnnouncementController::class);
        //album-photo-video
        Route::resource('albums', AlbumController::class);
        Route::resource('photos', PhotoController::class);
        Route::resource('videos', VideoController::class);
        Route::resource('cooperations', CooperationController::class);

        //contact
        Route::resource('contacts', ContactController::class);
        //faq
        Route::resource('faqs', FaqController::class);
        route::get('faq/{faq:id}/answer/{answer:id}', [AnswerController::class, 'edit'])->name('answer.edit');
        route::put('faq/{faq:id}/answer/{answer:id}', [AnswerController::class, 'update'])->name('answer.update');
        route::delete('answer/{answer:id}', [AnswerController::class, 'destroy'])->name('answer.destroy');

        Route::post('rich-text-attachment', RichTextAttachmentController::class)->name('rich-text.attachment');
        //Department and staff
        Route::resource('departments', DepartmentController::class);
        Route::resource('positions', PositionController::class);
        Route::resource('staffs', StaffController::class);
        //Document
        Route::resource('documents', DocumentController::class);
        Route::resource('types', TypeDocumentController::class);
        Route::resource('signers', SignerDocumentController::class);

        //Document_Opinion
        Route::resource('Docs-opis', Document_OpinionController::class);
        Route::resource('opinions', OpinionController::class);
        //Menu
        Route::resource('menus', MenuController::class);

        //ads
        Route::resource('ads', AdController::class);

        //add-on
        Route::resource('addons', AddonController::class);

        // banner
        Route::resource('banners', BannerController::class);

        //user
        Route::resource('users', UserController::class);
        route::resource('roles', CategorieController::class);
    });
});

require __DIR__ . '/auth.php';
