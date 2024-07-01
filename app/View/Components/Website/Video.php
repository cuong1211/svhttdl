<?php

namespace App\View\Components\Website;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;
use App\Models\Video as Videos;

class Video extends Component
{

    public function render(): View|Closure|string
    {
        $video = Videos::query()->where('is_active', 1)->first();
        return view('components.website.video', compact('video'));
    }
}
