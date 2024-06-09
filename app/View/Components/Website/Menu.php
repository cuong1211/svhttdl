<?php

namespace App\View\Components\Website;

use App\Models\Menu as Menus;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Menu extends Component
{
    public function render(): View|Closure|string
    {
        $menus = Menus::query()->with('children')->whereNull('parent_id')->orderBy('order')->get();
        return view('components.website.menu', compact('menus'));
    }
}
