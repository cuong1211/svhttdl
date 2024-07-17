<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Announcement;

class NotificationController extends Controller
{
    public function index()
    {
        $notis = Announcement::query()
            ->published()
            ->latest()
            ->paginate(15);
            
        return view('web.notification.index', [
            'notis' => $notis,
        ]);
    }
    public function show($announcement)
    {
        $noti = Announcement::query()
            ->where('slug', $announcement)
            ->published()
            ->firstOrFail();
        $other_noti = Announcement::query()
            ->where('id', '!=', $noti->id)
            ->published()
            ->latest()
            ->take(10)
            ->get();
        // dd($other_noti, $noti);
        return view('web.notification.show', [
            'noti' => $noti,
            'other_noti' => $other_noti,
        ]);
    }
}
