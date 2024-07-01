<x-website-layout>
    <ul class="UL_Link_Menu">
        <li class="Lv_1">
            <a href="index-2.html">Trang chủ</a>
        </li>
        <li class="Lv_3">
            <span class="Arrow_Link_Menu"></span>
            <a href="{{ route('noti.index')}}">Thông báo</a>
        </li>
        <li class="Lv_3">
            <span class="Arrow_Link_Menu"></span>
            <a href="#">chi tiết</a>
        </li>
    </ul>


    <div class="Around_News_Detail">
        <div class="Around_News_Content">
            <div style="float: left; width: 100%;">
                <span class="News_Time_Post">
                    Ngày đăng: {{ $noti->published_post_date }} / Lượt xem: 74 </span>
            </div>
            <div class="title">
                <h1 class="News_Detail_Title">
                    {{ $noti->title }} </h1>
            </div>
            <div id="divArticleDescription">
                <div class="content" style="object-fit: cover;">
                    
                    {!! $noti->content !!}


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
                    @foreach ($other_noti as $otherNoti)
                        <li>
                            <a href="{{ route('noti.show', $otherNoti) }}">
                                <span>{{ $otherNoti->title }}({{ $otherNoti->published_post_date }})</span>
                            </a>
                        </li>
                    @endforeach

                </ul>
            </div>
        </div>
    </div>
</x-website-layout>
