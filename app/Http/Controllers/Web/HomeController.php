<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Events\PostViewed;
use App\Models\banner;
use Illuminate\View\View;
use App\Models\Menu;
use App\Models\Category;
use App\Models\Post;

class HomeController extends Controller
{
    public function __invoke(): View
    {

        $post_van_hoa = Category::query()->where('id', 9)->with(['posts' => function ($q) {
            $q->published()
                ->where('state', 1)
                ->orderByDesc('published_at')
                ->take(5);
        }])->first();
        $post_du_lich = Category::query()->where('id', 12)->with(['posts' => function ($q) {
            $q->published()
                ->where('state', 1)
                ->orderByDesc('published_at')
                ->take(5);
        }])->first();
        $post_the_thao = Category::query()->where('id', 11)->with(['posts' => function ($q) {
            $q->published()
                ->where('state', 1)
                ->orderByDesc('published_at')
                ->take(5);
        }])->first();
        $post_gia_dinh = Category::query()->where('id', 19)->with(['posts' => function ($q) {
            $q->published()
                ->where('state', 1)
                ->orderByDesc('published_at')
                ->take(5);
        }])->first();
        $banner_mid = banner::query()->where('position', 2)->where('is_active', 1)->first();
        return view('web.home', compact('banner_mid', 'post_van_hoa', 'post_du_lich', 'post_the_thao', 'post_gia_dinh'));
    }
    public function showMenu()
    {
        $menus = Menu::with('children')->whereNull('parent_id')->orderBy('order')->get();
        return view('layouts.website', compact('menus'));
    }
    public function getChild($category_id, $menu_id)
    {   
        $category = Menu::findOrFail($menu_id)->title;
        $posts = Post::query()->where('category_id', $category_id)->where('state', 1)->latest()->paginate(10);
        return view('web.child', compact('posts', 'menu_id', 'category_id', 'category'));
    }
    public function getPost($category_id, $menu_id, $id): View
    {
        $category = Category::query()->where('id', $category_id)->first();
        $post = Post::query()->where('id', $id)->first();
        $otherPosts = Post::query()
            ->where('category_id', $post->category_id)
            ->where('id', '!=', $post->id)
            ->published()
            ->latest()
            ->take(10)
            ->get();
        // dd($otherPosts);
        $session = request()->session();
        if (!$this->isPostViewed($post, $session)) {
            $post->update(['view' => $post->view + 1]);
            $this->storePost($post, $session);
            event(new PostViewed($post));
        }
        return view('web.news.show', [
            'post' => $post,
            'category' => $category,
            'otherPosts' => $otherPosts,
        ]);
    }
    public function getIntro($id)
    {
        $about = Post::query()->where('id', $id)->first();
        return view('web.about', compact('about'));
    }
    public function getChildIntro($category_id, $menu_id, $id)
    {
        $about = Post::query()->where('id', $id)->first();
        return view('web.about_child', compact('about'));
    }
    private function isPostViewed(Post $post, $session)
    {
        $viewed = $session->get('viewed_posts', []);

        return in_array($post->id, $viewed);
    }

    private function storePost(Post $post, $session)
    {
        $viewed = $session->get('viewed_posts', []);
        $viewed[] = $post->id;

        $session->put('viewed_posts', $viewed);
    }
}
