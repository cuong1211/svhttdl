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
        $menu->title = Str::ucfirst($menu->title);
        $menu->slug = Str::slug($menu->title);
        if ($menu->parent_id) {
            // Lấy menu cha từ cơ sở dữ liệu
            $parentMenu = Menu::find($menu->parent_id);
            if ($parentMenu) {
                $parentSlug = $parentMenu->slug;
                $menu->link = URL::to('/') . '/' . $parentSlug . '/' . $menu->slug;
            } else {
                // Xử lý trường hợp không tìm thấy menu cha (nếu cần)
                $menu->link = URL::to('/') . '/' . $menu->slug;
            }
        } else {
            $menu->link = URL::to('/') . '/' . $menu->slug;
        }

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