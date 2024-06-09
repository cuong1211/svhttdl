<?php

namespace App\View\Components\Website;

use App\Models\Announcement as AnnouncementModel;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Announcement extends Component
{
    public function render(): View|Closure|string
    {
        return view('components.website.announcement', [
            'announcements' => AnnouncementModel::query()
                ->published()
                ->orderByDesc('published_at')
                ->take(10)
                ->get(),
        ]);
    }
}
