<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Post;

class CheckDepartmentAccess
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        $categoryId = $request->route('category');
        $post = $categoryId;
        $category = Category::find($categoryId);
        $user = auth()->user();
        $postId = $request->route('post');
        if ($user->category_id == 1 || $user->category_id == 2) {
            return $next($request);
        }
        if ($postId) {
            $post = Post::find($postId)->category_id;
        }
        if (!$category || $category->department_id != $user->department_id && $user->category_id == 3 || $post != $categoryId) {
            abort(403, 'Unauthorized access');
        }


        return $next($request);
    }
}
