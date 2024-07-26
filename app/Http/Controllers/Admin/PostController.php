<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\PostRequest;
use App\Models\Category;
use App\Models\Post;
use App\Models\Tag;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\DB;
use Illuminate\View\View;
use Illuminate\Http\Request;

class PostController extends Controller
{
    public function index(Request $request, $id)
    {
        // dd($request->all());
        $parent_category = [];
        $child_category_id = [];
        $category = Category::where('id', $id)->firstOrFail();
        $all_cate_of_category = Category::where('parent_id', $id)->get();
        foreach ($all_cate_of_category as $cate) {
            $parent_category[] = $cate->id;
        }
        if ($request->categoryFilter) {
            $child_category = Category::where('parent_id', $request->categoryFilter)->get();
        } else {
            $child_category = Category::whereIn('parent_id', $parent_category)->get();
        }

        foreach ($child_category as $cate) {
            $child_category_id[] = $cate->id;
        }
        if ($request->categoryFilter == null) {
            $child_category_id =  array_merge($child_category_id, $parent_category);
        }
        $postsQuery = Post::query();
        if ($child_category->count() == 0) {
            $postsQuery->whereIn('category_id', $all_cate_of_category->pluck('id')->toArray());
        }
        if ($request->search != null) {
            $postsQuery->where('title', 'like', '%' . $request->search . '%');
        }

        if ($request->categoryFilter1 != null) {
            $postsQuery->where('category_id', $request->categoryFilter1);
        } elseif ($request->categoryFilter != null && $request->categoryFilter1 == null) {
            $child_categories = Category::where('parent_id', $request->categoryFilter)->pluck('id')->toArray();
            $child_categories = array_merge($child_categories, array($request->categoryFilter));
            $postsQuery->whereIn('category_id', $child_categories);
        } elseif ($child_category_id != null) {
            $postsQuery->whereIn('category_id', $child_category_id);
        }
        switch ($all_cate_of_category->count()) {
            case 0:
                $posts = Post::query()
                    ->where('category_id', $id)
                    ->when($request->search, function ($query, $search) {
                        return $query->where('title', 'like', '%' . $search . '%');
                    })
                    ->latest()
                    ->paginate(10)
                    ->appends($request->all());
                break;
            default:
                $posts = $postsQuery->latest()->paginate(10)->appends($request->all());
                break;
        }


        return view('admin.categories.posts.index', [
            'category' => $category,
            'posts' => $posts,
            'filter_cate' => $all_cate_of_category,
            'filter_child_cate' => $child_category,
            'request' => $request,
        ]);
    }


    public function create($categoryId): View
    {
        $categories = Category::query()
            ->with('children')
            ->where('parent_id', $categoryId)
            ->where('in_menu', true)
            ->orderBy('order')->get();

        $category = Category::findOrFail($categoryId);

        return view('admin.categories.posts.create', compact('categories', 'category', 'categoryId'));
    }

    public function store($id, PostRequest $request): RedirectResponse
    {
        $data = $request->validated();
        $post = new Post([
            'title' => $data['title'],
            'description' => $data['description'],
            'content' => $data['content'],
            'author' => $data['author'],
            'published_at' => $data['published_at'],
            'category_id' => $data['category_id'],
            'type' => $data['type'],
            'state' => $data['state'],
            'user_id' => auth()->id(),
        ]);

        $post->save();
        if ($request->hasFile('image')) {
            $imageFile = $request->file('image');
            $post->addMedia($imageFile->getRealPath())
                ->usingFileName($imageFile->getClientOriginalName())
                ->usingName($imageFile->getClientOriginalName())
                ->toMediaCollection('featured_image');
        }
        return redirect()->route('admin.categories.posts.index', ['category' => $id])->with([
            'icon' => 'success',
            'heading' => 'Success',
            'message' => 'Tạo bài viết thành công',

        ]);
    }

    /**
     * @return RedirectResponse
     */
    public function edit($categoryId, $postId): View
    {

        $selectedCategory_id = Post::findOrFail($postId)->category_id;
        $selectedCategory = Category::findOrFail($selectedCategory_id);
        $post = Post::findOrFail($postId);

        $categories = Category::query()
            ->with('children')
            ->where('parent_id', $categoryId)
            ->where('in_menu', true)
            ->orderBy('order')->get();

        return view('admin.categories.posts.edit', compact('selectedCategory_id', 'post', 'categories', 'selectedCategory', 'categoryId'));
    }

    public function update(PostRequest $request, $categoryId, $postId): RedirectResponse
    {
        $post = Post::findOrFail($postId);
        $data = $request->validated();
        // dd($request->all());
        DB::beginTransaction();
        // dd($post->type);
        try {
            $post->update([
                'title' => $data['title'],
                'description' => $data['description'],
                'content' => $data['content'],
                'author' => $data['author'],
                'published_at' => $data['published_at'],
                'category_id' => $data['category_id'],
                'type' => $data['type'],
                'state' => $data['state'],
                'user_id' => auth()->id(),
            ]);
            if ($request->hasFile('image')) {
                $imageFile = $request->file('image');
                $post->clearMediaCollection('featured_image');
                $post->addMedia($imageFile->getRealPath())
                    ->usingFileName($imageFile->getClientOriginalName())
                    ->usingName($imageFile->getClientOriginalName())
                    ->toMediaCollection('featured_image');
            }
            // dd($post);
            DB::commit();
            $queryParams = $request->except(array_keys($data));
            return redirect()->route('admin.categories.posts.index', ['category' => $categoryId] + $queryParams)->with([
                'icon' => 'success',
                'heading' => 'Success',
                'message' => 'Cập nhật bài viết thành công',
            ]);
        } catch (\Exception $e) {
            DB::rollBack();

            return redirect()->back()->with([
                'icon' => 'error',
                'heading' => 'Error',
                'message' => 'Cập nhật bài viết thất bại',
            ]);
        }
    }

    public function destroy($category_id, $post_id)
    {
        $post = Post::findOrFail($post_id);
        $post->clearMediaCollection('featured_image');
        $post->delete();
        return redirect()->route('admin.categories.posts.index', ['category' => $category_id])->with([
            'icon' => 'success',
            'heading' => 'Success',
            'message' => trans('admin.alert.deleted-success'),
        ]);
    }
    public function getCate($id)
    {
        $category =  Category::where('parent_id', $id)->get();
        return response()->json($category);
    }
}
