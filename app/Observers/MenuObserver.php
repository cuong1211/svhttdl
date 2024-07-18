<?php

namespace App\Observers;

use App\Models\Menu;
use App\Services\MenuService;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\URL;

class MenuObserver
{
    public function __construct(
        public MenuService $menuservice
    ) {
    }



    public function saving(menu $menu): void
    {
        $this->menuservice->deleteCachedMenu();
    }


    public function saved(menu $menu): void
    {
        $this->menuservice->cachedMenu();
    }

    public function deleted(menu $menu): void
    {
        $this->menuservice->deleteCachedMenu();
    }
}
