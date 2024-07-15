<?php

namespace App\Providers;

use App\Models\Announcement;
use App\Models\Category;
use App\Models\Post;
use App\Models\Document\Type;
use App\Models\Document\Signer;
use App\Models\Document\Document;
use App\Models\Menu;
use App\Observers\AnnouncementObserver;
use App\Observers\Documents\TypeObserver;
use App\Observers\Documents\SignerObserver;
use App\Observers\Documents\DocumentObserver;
use App\Observers\CategoryObserver;
use App\Observers\PostObserver;
use App\Observers\MenuObserver;
use Illuminate\Support\Facades\Event;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Announcement::observe(AnnouncementObserver::class);
        Category::observe(CategoryObserver::class);
        Post::observe(PostObserver::class);
        Type::observe(TypeObserver::class);
        Signer::observe(SignerObserver::class);
        Document::observe(DocumentObserver::class);
        Menu::observe(MenuObserver::class);
        Event::listen('news.show', 'App\Events\ViewPostHandler');
    }
}
