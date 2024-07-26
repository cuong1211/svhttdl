<x-website-layout>
    <div>
        <div
            style="font-size: 36px; width: 100%; border-bottom: 3px solid transparent; border-image: linear-gradient(0.25turn, rgba(255,249,34), rgba(255,0,128), rgba(56,2,155,0)); border-image-slice: 1;">
            <a style="margin-left:24px; color: #000; font-weight: bold;">TIN TỨC HOẠT ĐỘNG - {{$category}}</a>
        </div>
        <div>
            @foreach ($posts as $post)
                <div class="listnews_item">
                    <div class="listnews_item_img">
                        <a
                            href="{{ route('home.child.post', ['category' => $category_id, 'menu' => $menu_id, 'post' => $post->id]) }}">
                            @if ($post->getFirstMedia('featured_image'))
                                <img src='{{ $post->getFirstMedia('featured_image')->getUrl() }}' alt='' />
                            @else
                                <img src='{{ asset($post->image) }}' alt='' />
                            @endif
                        </a>
                    </div>
                    <div class="listnews_item_title">
                        <a
                            href="{{ route('home.child.post', ['category' => $category_id, 'menu' => $menu_id, 'post' => $post->id]) }}">{{ $post->title }}</a>
                    </div>
                    <div class="listnews_item_des">{{ $post->description }}</div>
                    <div class="listnews_item_date">
                        <span>Ngày đăng: {{ $post->published_post_date }} / Lượt xem: {{$post->view}}</span>
                    </div>
                </div>
            @endforeach
            {{ $posts->render('web.paginate') }}
        </div>
    </div>
</x-website-layout>
