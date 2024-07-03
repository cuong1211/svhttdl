<x-website-layout>
    <style>
        .hidden {
            display: none;
        }

        .banner_top {
            margin-bottom: 5px;
        }

        .banner_bottom {
            margin-top: 5px;
            margin-bottom: 5px;
        }

        .text {
            overflow: hidden;
            text-overflow: ellipsis;
            display: -webkit-box;
            -webkit-line-clamp: 3;
            /* number of lines to show */
            line-clamp: 2;
            -webkit-box-orient: vertical;
        }
    </style>
    {{-- tin main --}}
    <x-website.home-post />



    {{-- tin noi bat --}}
    {{-- banner --}}
    <div class="banner_top">
        <div class="_banner fade">
            <img style="width: 100%;" src="{{ $banner_mid->getFirstMedia('banner_image')->getUrl() }}" />
        </div>
    </div>


    {{-- tin tuc  --}}
    <div class="cols-2">
        @foreach ($posts as $category)
            @foreach ($category->children as $category_title)
                <div class="groupnews_home">
                    <div
                        style="font-size: 36px; width: 100%; border-bottom: 3px solid transparent;   border-image: linear-gradient(0.25turn, rgba(38,109,192), rgba(11,143,121));    border-image-slice: 1; ">
                        <a
                            href="{{ route('news.child', ['parentSlug' => $category->slug, 'slug' => $category_title->slug]) }}">
                            <b>{{ $category_title->title }}</b></a>
                    </div>
                    <div class="groupnews_home_content">
                        @foreach ($category_title->posts as $index => $post)
                            @if ($index == 0)
                                <div class="groupnews_item">
                                    <a href="{{ route('news.show', $post) }}">
                                        @if ($post->getFirstMedia('featured_image'))
                                            <img src='{{ $post->getFirstMedia('featured_image')->getUrl() }}'
                                                alt='' style="height: 245px" />
                                        @endif

                                    </a>
                                    <h3>
                                        <a href="{{ route('news.show', $post) }}"><span>{{ $post->title }}</span></a>
                                    </h3>
                                    <p class="text text-black text-justify">
                                    </p>
                                </div>
                            @endif
                        @endforeach
                        <ul class="othernews">
                            @foreach ($category_title->posts as $index => $post)
                                @if ($index > 0)
                                    <li
                                        style="background:url('images/point_yellow.png') no-repeat left 5px;  overflow: hidden;  text-overflow: ellipsis;text-align: justify;">
                                        <a href="{{ route('news.show', $post) }}">
                                            {{ $post->title }}
                                        </a>
                                    </li>
                                @endif
                            @endforeach
                        </ul>
                    </div>
                </div>
            @endforeach
        @endforeach

    </div>

    <style>
        * {
            box-sizing: border-box;
        }

        /* Create three equal columns that floats next to each other */
        .column_link {
            float: left;
            width: 33.3%;
            padding: 10px;
            height: 80px;
        }

        /* Clear floats after the columns */
        .row_link:after {
            content: "";
            display: table;
            clear: both;
        }

        /* Responsive layout - makes the three columns stack on top of each other instead of next to each other */
        @media screen and (max-width: 600px) {
            .column_link {
                width: 100%;
            }
        }
    </style>

    <div
        style="font-size: 36px; width: 100%; border-bottom: 3px solid transparent;   border-image: linear-gradient(0.25turn, rgba(255,249,34), rgba(255,0,128), rgba(56,2,155,0));    border-image-slice: 1; ">
        <b>&nbsp; </b>
    </div>
    {{-- add-on --}}
    <x-website.ads />
</x-website-layout>
