<?php

namespace App\Observers;

use App\Models\Announcement;
use Illuminate\Support\Str;

class AnnouncementObserver
{
    public function saving(Announcement $announcement)
    {
        $announcement->title = Str::ucfirst($announcement->title);
        $announcement->slug = Str::slug($announcement->title);
    }
}
