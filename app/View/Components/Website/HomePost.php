<?php

namespace App\View\Components\Website;

use App\Models\Post;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class HomePost extends Component
{
    public function render(): View|Closure|string
    {
        $posts = Post::query()
            ->with('category')
            ->latest()->take(6)->get();
        // $latestPost = $posts->first();
        $hotnews = Post::query()
            ->with('category')
            ->where('type', 'Tin nổi bật')
            ->latest()->take(3)->get();
        return view('components.website.home-post', [
            'posts' => $posts,
            // 'latestPost' => $latestPost,
            'hotnews' => $hotnews,
        ]);
    }
}
