<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\Post;
use Illuminate\View\View;
use App\Models\Category;

class NewsController extends Controller
{
    public function index($slug): View
    {
        $posts = Category::query()->where('slug',$slug)->with(['children'=> function ($query){
            $query->with('posts');
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

    public function show(Post $post): View
    {
        $category = Category::query()->where('id',$post->category_id)->first();
        return view('web.news.show', [
            'post' => $post,
            'category' => $category,
        ]);
    }
}
