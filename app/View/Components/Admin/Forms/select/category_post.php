<?php

namespace App\View\Components\admin\forms\select;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class category_post extends Component
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
        return view('components.admin.forms.select.category_post');
    }
}