<?php

namespace App\View\Components\Website;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;
use App\Models\Addon as AddonModel;

class Addon extends Component
{
    /**
     * Create a new component instance.
     */
    public function __construct()
    {
        //
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        $addon = AddonModel::query()->orderBy('order')->where('state', 1)->get();
        if (request()->routeIs('home.child.*')) {
            $addon = AddonModel::query()->orderBy('order')->where('state', 1)->where('is_active', 1)->get();
        }
        return view('components.website.addon', compact('addon'));
    }
}
