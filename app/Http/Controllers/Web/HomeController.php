<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use Illuminate\View\View;
use App\Models\Menu;
use App\Models\Category;
use App\Models\Post;

class HomeController extends Controller
{
    public function __invoke(): View
    {
        $posts = Category::query()->where('slug', 'tin-tuc-su-kien')->with(['children' => function ($query) {
            $query->with(['posts' => function ($q) {
                $q->published()
                    ->orderByDesc('published_at');
            }])->limit(5);
        }])->get();

        // dd($posts);
        // Post::query()
        //         ->with('category')
        //         ->published()
        //         ->orderByDesc('published_at')
        //         ->paginate(10)
        // dd($posts);
        return view('web.home', compact('posts'));
    }
    public function showMenu()
    {
        $menus = Menu::with('children')->whereNull('parent_id')->orderBy('order')->get();
        return view('layouts.website', compact('menus'));
    }
}
