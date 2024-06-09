<?php

namespace App\Observers;

use App\Models\Post;
use Illuminate\Support\Str;

class PostObserver
{
    public function saving(Post $post)
    {
        $post->title = Str::ucfirst($post->title);
        $post->slug = Str::slug($post->title);
    }
}
