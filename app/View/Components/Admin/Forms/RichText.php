<?php

namespace App\View\Components\Admin\Forms;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class RichText extends Component
{
    public function render(): View|Closure|string
    {
        return view('components.admin.forms.rich-text');
    }
}
