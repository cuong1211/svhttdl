<?php

namespace App\Listeners;

use App\Events\PostViewed;
use Illuminate\Session\Store;
use App\Models\Post;

class ViewPostHandler
{
    private $session;

    public function __construct(Store $session)
    {
        $this->session = $session;
    }

    public function handle(PostViewed $event)
    {
        $post = $event->post;
        if (!$this->isPostViewed($post)) {
            $this->storePost($post);
        }
    }

    private function isPostViewed(Post $post)
    {
        $viewed = $this->session->get('viewed_posts', []);

        return in_array($post->id, $viewed);
    }

    private function storePost(Post $post)
    {
        $viewed = $this->session->get('viewed_posts', []);
        $viewed[] = $post->id;

        $this->session->put('viewed_posts', $viewed);
    }
}
