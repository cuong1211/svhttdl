<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\banner;
use Illuminate\View\View;
use App\Models\Menu;
use App\Models\Category;
use App\Models\Post;

class HomeController extends Controller
{
    public function __invoke(): View
    {
        // $posts = Category::query()->where('slug', 'tin-tuc-su-kien')->with(['children' => function ($query) {
        //     $query->with(['posts' => function ($q) {
        //         $q->published()
        //             ->orderByDesc('published_at');
        //     }])->limit(4);
        // }])->get();
        $post_van_hoa = Category::query()->where('id',9)->with(['posts' => function ($q) {
            $q->published()
                ->orderByDesc('published_at')
                ->take(5);
        }])->first();
        $post_du_lich = Category::query()->where('id',12)->with(['posts' => function ($q) {
            $q->published()
                ->orderByDesc('published_at')
                ->take(5);
        }])->first();
        $post_the_thao = Category::query()->where('id',11)->with(['posts' => function ($q) {
            $q->published()
                ->orderByDesc('published_at')
                ->take(5);
        }])->first();
        $post_gia_dinh = Category::query()->where('id',19)->with(['posts' => function ($q) {
            $q->published()
                ->orderByDesc('published_at')
                ->take(5);
        }])->first();
        $banner_mid = banner::query()->where('position', 2)->where('is_active', 1)->first();
        // dd($posts);
        // Post::query()
        //         ->with('category')
        //         ->published()
        //         ->orderByDesc('published_at')
        //         ->paginate(10)
        // dd($posts);
        return view('web.home', compact('banner_mid','post_van_hoa','post_du_lich','post_the_thao','post_gia_dinh'));
    }
    public function showMenu()
    {
        $menus = Menu::with('children')->whereNull('parent_id')->orderBy('order')->get();
        return view('layouts.website', compact('menus'));
    }
}
