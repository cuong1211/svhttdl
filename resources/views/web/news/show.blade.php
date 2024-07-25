<x-website-layout>
    <ul class="UL_Link_Menu">
        <li class="Lv_1">
            <a href="index-2.html">Trang chủ</a>
        </li>
        <li class="Lv_3">
            <span class="Arrow_Link_Menu"></span>
            <a href="javascript:void(0)" disable>Tin tức - sự kiện</a>
        </li>
        <li class="Lv_3">
            <span class="Arrow_Link_Menu"></span>
            <a href="{{ route('news.child', ['Id' => $category->id]) }}" disable>{{ $post->category->title }}</a>
        </li>
    </ul>


    <div class="Around_News_Detail">
        <div class="Around_News_Content">
            <div style="float: left; width: 100%;">
                <span class="News_Time_Post">
                    Ngày đăng: {{ $post->published_post_date }} / Lượt xem: {{$post->view}}</span>
            </div>
            <div class="title">
                <h1 class="News_Detail_Title">
                    {{ $post->title }} </h1>
            </div>
            <div id="divArticleDescription">
                <div class="content" style="object-fit: cover;">
                    <style>
                        .content img {
                            height: 370px;
                            width: 600px;
                        }

                        p {
                            font-size: 16px;
                            line-height: 1.5;
                        }
                    </style>
                    {!! $post->content !!}


                </div>
            </div>
        </div>
    </div>

    <div class="border_content_fullwidth">
        <div style="">
            <div class="groupnews_head bg_blue">
                <span class="group_header_link">Bài viết cùng chuyên mục</span>
            </div>
            <div class="groupnews_content">
                <ul class="othernews_fullwidth">
                    @foreach ($otherPosts as $otherPosts)
                        <li>
                            <a href="{{ route('news.show', $otherPosts) }}">
                                <span>{{ $otherPosts->title }}({{ $otherPosts->published_post_date }})</span>
                            </a>
                        </li>
                    @endforeach

                </ul>
            </div>
        </div>
    </div>
</x-website-layout>
