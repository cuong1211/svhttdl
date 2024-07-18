<?php

namespace App\Http\Controllers\Web;

use App\Events\PostViewed;
use App\Http\Controllers\Controller;
use App\Models\Post;
use Illuminate\View\View;
use App\Models\Category;

class NewsController extends Controller
{
    public function index($id): View
    {
        $posts = Category::query()->where('parent_id', $id)->with(['children' => function ($query) {
            $query->with('posts')->take(10);
        }])->get();
        return view('web.news.index', [
            'posts' => $posts,
        ]);
    }
    public function getChild($Id): View
    {
        $category = Category::query()->where('id', $Id)->first();
        $category_title = $category->title;
        $posts =  Post::query()->where('category_id', $Id)
            ->orderByDesc('published_at')
            ->paginate(10);
        return view('web.child.index', [
            'posts' => $posts,
            'category_title' => $category_title,
        ]);
    }
    public function show(Post $post): View
    {
        $session = request()->session();
        if (!$this->isPostViewed($post, $session)) {
            $post->update(['view' => $post->view + 1]);
            $this->storePost($post, $session);
            event(new PostViewed($post));
        }

        $category = Category::query()->where('id', $post->category_id)->first();
        $otherPosts = Post::query()
            ->where('category_id', $post->category_id)
            ->where('id', '!=', $post->id)
            ->published()
            ->latest()
            ->take(10)
            ->get();

        return view('web.news.show', [
            'post' => $post,
            'category' => $category,
            'otherPosts' => $otherPosts,
        ]);
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
