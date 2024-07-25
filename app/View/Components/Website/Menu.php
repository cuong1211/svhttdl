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
        $menus = Menus::query()->where('in_menu', 1)->with(['children' => function ($query) {
            $query->where('in_menu', 1)->get();
        }])->whereNull('parent_id')->orderBy('order')->get();
        if (request()->routeIs('home.child.*')) {
            $menus = Menus::query()->where('in_menu', 1)->where('parent_id', request()->menu)->with(['children' => function ($query) {
                $query->where('in_menu', 1)->get();
            }])->orderBy('order')->get();
        }
        // dd(request()->routeIs('home.child'));
        return view('components.website.menu', compact('menus'));
    }
}
