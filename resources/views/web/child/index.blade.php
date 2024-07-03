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
    <ul class="pagination" style="float: right;">
        <li class='active'><a href='indexa6d2.html?com=danhmuc_tin&amp;id_category=2&amp;page=1'>1</a></li>
        <li><a href='index38f0.html?com=danhmuc_tin&amp;id_category=2&amp;page=2'>2</a></li>
        <li><a href='index5575.html?com=danhmuc_tin&amp;id_category=2&amp;page=3'>3</a></li>
        <li><a href='index2127.html?com=danhmuc_tin&amp;id_category=2&amp;page=4'>4</a></li>
        <li><a href='index23a2.html?com=danhmuc_tin&amp;id_category=2&amp;page=5'>5</a></li>
        <li><a href='indexbc8b.html?com=danhmuc_tin&amp;id_category=2&amp;page=6'>6</a></li>
        <li><a href='index991c.html?com=danhmuc_tin&amp;id_category=2&amp;page=7'>7</a></li>
        <li><a href='index2f55.html?com=danhmuc_tin&amp;id_category=2&amp;page=8'>8</a></li>
        <li><a href='index5b56.html?com=danhmuc_tin&amp;id_category=2&amp;page=9'>9</a></li>
        <li><a href='indexccb3.html?com=danhmuc_tin&amp;id_category=2&amp;page=10'>10</a></li>
        <li><a href='index9260.html?com=danhmuc_tin&amp;id_category=2&amp;page=11'>11</a></li>
    </ul>

</x-website-layout>
