<?php

namespace App\View\Components\website;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;
use App\Models\ads as AdsModel;
class ads extends Component
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
        $ads = AdsModel::query()->orderBy('order')->limit(6)->get();
        return view('components.website.ads', ['ads' => $ads]);
    }
}
