<?php

namespace App\View\Components\website;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;
use App\Models\addon as AddonModel;
class addon extends Component
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
        $addon = AddonModel::query()->orderBy('order')->limit(10)->get();
        return view('components.website.addon', ['addon' => $addon]);
    }
}