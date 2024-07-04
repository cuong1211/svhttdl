<?php

namespace App\Http\Controllers\Web;

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
        // dd($posts);
        // Post::query()
        //         ->with('category')
        //         ->published()
        //         ->orderByDesc('published_at')
        //         ->paginate(10)
        return view('web.news.index', [
            'posts' => $posts,
        ]);
    }
    public function getChild($parentId, $Id): View
    {
        $category = Category::query()->where('id', $Id)->first();
        $category_title = $category->title;
        $posts =  Post::query()->where('category_id', $Id)
            ->with('category')
            // ->published()
            ->orderByDesc('published_at')
            ->paginate(10);
            // ->get();
        // dd($posts);
        return view('web.child.index', [
            'posts' => $posts,
            'category_title' => $category_title,
        ]);
    }
    public function show(Post $post): View
    {
        $category = Category::query()->where('id', $post->category_id)->first();
        // dd($category);
        $otherPosts = Post::query()
            ->where('category_id', $post->category_id)
            ->where('id', '!=', $post->id)
            ->published()
            ->latest()
            ->take(10)
            ->get();
            // dd($otherPosts);
        return view('web.news.show', [
            'post' => $post,
            'category' => $category,
            'otherPosts' => $otherPosts,
        ]);
    }
}
