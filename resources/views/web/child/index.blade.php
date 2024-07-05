<x-website-layout>

    <ul class="UL_Link_Menu">
        <li class="Lv_1">
            <a href="index-2.html">Trang chủ</a>
        </li>
        <li class="Lv_3">
            <span class="Arrow_Link_Menu"></span>
            <a href="indexd5f1.html?com=tin-tuc">Tin tức – sự kiện</a>
        </li>
        <li class="Lv_3">
            <span class="Arrow_Link_Menu"></span>
            <a> {{ $category_title }}</a>
        </li>
    </ul>
    @foreach ($posts as $index => $post)
        <div class="listnews_item">
            <div class="listnews_item_img">
                <a href="{{ route('news.show', $post) }}">
                    @if ($post->getFirstMedia('featured_image'))
                        <img src='{{ $post->getFirstMedia('featured_image')->getUrl('') }}' alt='' />
                    @else
                        <img src='{{ asset($post->image) }}' alt='' />
                    @endif
                </a>
            </div>
            <div class="listnews_item_title">
                <a href="{{ route('news.show', $post) }}">{{ $post->title }}</a>
            </div>
            <div class="listnews_item_des">
                {{ $post->description }}
            </div>
            <div class="listnews_item_date">
                <span> Ngày đăng: {{ $post->published_post_date }}/ Lượt xem: 3</span>
            </div>
        </div>
    @endforeach
    </table>
    {{ $posts->render('web.paginate') }}



</x-website-layout>
