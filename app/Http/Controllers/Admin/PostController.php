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
        $parent_category = [];
        $category = Category::where('id', $id)->firstOrFail();
        $all_cate_of_category = Category::where('parent_id', $category->id)->get();
        foreach ($all_cate_of_category as $cate) {;
            $parent_category[] = $cate->id;
        }
        $child_category = Category::whereIn('parent_id', $parent_category)->get();
        foreach ($child_category as $cate) {
            $parent_category[] = $cate->id;
        }
        if ($request->search != null && $request->categoryFilter1 != null && $request->categoryFilter != null) {
            $child_category = Category::where('parent_id', $request->categoryFilter)->get();
            $posts = Post::where('category_id', $request->categoryFilter1)->where('title', 'like', '%' . $request->search . '%')->latest()->paginate(10);
        }
        if ($request->search != null && $request->categoryFilter1 == null && $request->categoryFilter == null) {
            $posts = Post::where('title', 'like', '%' . $request->search . '%')->latest()->paginate(10);
        }
        if ($request->search != null && $request->categoryFilter1 != null && $request->categoryFilter == null) {
            $child_category = Category::where('parent_id', $request->categoryFilter)->get();
            $posts = Post::where('category_id', $request->categoryFilter1)->where('title', 'like', '%' . $request->search . '%')->latest()->paginate(10);
        }
        if ($request->search != null && $request->categoryFilter1 == null && $request->categoryFilter != null) {
            $child_category = Post::where('category_id', $request->categoryFilter)->get();
            $posts = Post::whereIn('category_id', $child_category)->where('title', 'like', '%' . $request->search . '%')->latest()->paginate(10);
        }
        if ($request->search == null && $request->categoryFilter1 != null && $request->categoryFilter != null) {
            $child_category = Category::where('parent_id', $request->categoryFilter)->get();
            $posts = Post::where('category_id', $request->categoryFilter1)->latest()->paginate(10);
        }
        if ($request->search == null && $request->categoryFilter1 == null && $request->categoryFilter != null) {
            $child_category = Category::where('parent_id', $request->categoryFilter)->get();
            $posts = Post::whereIn('category_id', $child_category)->latest()->paginate(10);
        }
        if ($request->search == null && $request->categoryFilter1 == null && $request->categoryFilter == null) {
            $posts = Post::whereIn('category_id', $parent_category)->latest()->paginate(10);
        }
        // dd($posts);
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
        $tags = Tag::all();
        $category = Category::findOrFail($categoryId);

        return view('admin.categories.posts.create', compact('tags', 'categories', 'category'));
    }

    public function store(PostRequest $request): RedirectResponse
    {
        $post = new Post([
            'user_id' => auth()->id(),
            'category_id' => $request->category_id,
            'title' => $request->title,
            'description' => $request->description,
            'content' => $request->content,
            'author' => $request->author,
            'published_at' => $request->published_at,
            'type' => $request->type,
        ]);

        $post->save();

        if ($request->tags) {
            $tagIds = [];
            $tags = json_decode($request->tags);
            foreach ($tags as $tagObj) {
                $tag = Tag::firstOrCreate(['name' => trim($tagObj->value)]);
                $tagIds[] = $tag->id;
            }
            $post->tags()->sync($tagIds);
        }
        if ($request->hasFile('image')) {
            $imageFile = $request->file('image');
            $post->addMedia($imageFile->getRealPath())
                ->usingFileName($imageFile->getClientOriginalName())
                ->usingName($imageFile->getClientOriginalName())
                ->toMediaCollection('featured_image');
        }
        $category = Category::findOrFail($request->category_id);

        return redirect()->route('admin.categories.posts.index', ['category' => $category->id])->with([
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
        $category = Category::findOrFail($categoryId);
        $post = Post::with('tags')->findOrFail($postId);
        $tags = Tag::all();
        $tagNames = $post->tags->pluck('name')->toJson();

        return view('admin.categories.posts.edit', compact('category', 'post', 'tags', 'tagNames'));
    }

    public function update(PostRequest $request, $categoryId, $postId): RedirectResponse
    {
        $post = Post::findOrFail($postId);
        // dd($request->all());
        DB::beginTransaction();
        // dd($post->type);
        try {
            $post->update([
                'title' => $request->title,
                'description' => $request->description,
                'content' => $request->content,
                'author' => $request->author,
                'published_at' => $request->published_at,
                'category_id' => $categoryId,
                'type' => $request->type,

            ]);
            if ($request->tags) {
                $tagIds = collect(json_decode($request->tags, true))->pluck('value')->map(function ($name) {
                    return Tag::firstOrCreate(['name' => trim($name)])->id;
                });
                $post->tags()->sync($tagIds);
                $unusedTags = Tag::whereDoesntHave('posts')->get();
                foreach ($unusedTags as $unusedTag) {
                    $unusedTag->delete();
                }
            }
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
            $category = Category::findOrFail($categoryId);

            return redirect()->route('admin.categories.posts.index', ['slug' => $category->slug])->with([
                'icon' => 'success',
                'heading' => 'Success',
                'message' => 'Cập nhật bài viết thành công',
            ]);
        } catch (\Exception $e) {
            DB::rollBack();

            return redirect()->back()->with('error', 'Error updating post: ' . $e->getMessage());
        }
    }

    public function destroy($category_id, $post_id)
    {
        $category = Category::findOrFail($category_id);
        $post = $category->posts()->findOrFail($post_id);
        $post->clearMediaCollection('featured_image');
        $post->tags()->detach();
        $post->delete();
        $unusedTags = Tag::doesntHave('posts')->get();
        foreach ($unusedTags as $unusedTag) {
            $unusedTag->delete();
        }

        return back()->with([
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
