<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\Video;
use Illuminate\Http\Request;

class VideoController extends Controller
{
    public function index()
    {
        $video = Video::query()->where('is_active', 1)->first();
        if (!$video) {
            $video = Video::query()->first();
        }
        $other_videos = Video::query()->paginate(9);
        return view('web.video.index', compact('video', 'other_videos'));
    }
}
