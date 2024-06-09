<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function getCategory($slug)
    {
        $posts = Category::query()->where('slug',$slug)->with(['children'=> function ($query){
            $query->with('posts');
        }])->get(); 
        dd($posts);
        // Menu::query()
        //         ->with('children')
        //         ->whereNull('parent_id')
        //         ->where('in_menu', true)
        //         ->orderBy('order')
        //         ->get();

        
        return view('web.news.index', compact('posts'));
    }
}
