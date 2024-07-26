<div class="tintop_left">
    <div class="tintop_left_left">
        <div id="featured">
            @foreach ($posts as $post)
                <div id="fragment-{{ $post->id }}" class="ui-tabs-panel">
                    <a href="{{ route('news.show', ['post' => $post]) }}">
                        @if ($post->getFirstMedia('featured_image'))
                            <img src='{{ $post->getFirstMedia('featured_image')->getUrl('') }}' alt='' />
                        @else
                            <img src='{{ asset($post->image) }}' alt='' />
                        @endif
                    </a>
                    <div class="info">
                        <h2>
                            <a href='{{ route('news.show', ['post' => $post]) }}'>
                                {{ $post->title }}
                            </a>
                        </h2>
                    </div>
                </div>
            @endforeach

            <ul class="ui-tabs-nav">
                <b style="color:#ff0000;">TIN MỚI</b>
                <li style="line-height: 1px;">&ensp;</li>
                @foreach ($posts as $post)
                    <li class="ui-tabs-nav-item" id="nav-fragment-1">
                        <a href="#fragment-{{ $post->id }}">
                            @if ($post->getFirstMedia('featured_image'))
                                <img src='{{ $post->getFirstMedia('featured_image')->getUrl('') }}'
                                    alt='{{ $post->title }}' />
                            @else
                                <img src='{{ asset($post->image) }}' alt='{{ $post->title }}' />
                            @endif
                        </a>
                        <a href='{{ route('news.show', ['post' => $post]) }}'>
                            <span>
                                {{ $post->title }}
                            </span>
                        </a>
                    </li>
                @endforeach
            </ul>
        </div>
    </div>
</div>
<div class="groupnews_home">
    <div
        style="font-size: 36px; width: 100%; border-bottom: 3px solid transparent;   border-image: linear-gradient(0.25turn, rgba(38,109,192), rgba(11,143,121));    border-image-slice: 1; ">
        <a href="index9ed1.html?com=danhmuc_tin&amp;id_category=9" style="color: #ff0000;">
            <b>TIN NỔI BẬT</b></a>
    </div>
    <style>
        * {
            box-sizing: border-box;
        }

        /* Create three equal columns that floats next to each other */
        .column {
            float: left;
            width: 33.33%;
            padding: 10px;
            height: 80px;
        }

        /* Clear floats after the columns */
        .row:after {
            content: "";
            display: table;
            clear: both;
        }

        /* Responsive layout - makes the three columns stack on top of each other instead of next to each other */
        @media screen and (max-width: 600px) {
            .column {
                width: 100%;
            }
        }
    </style>
    <div class="row">
        @foreach ($hotnews as $post)
            <div class="column">
                <div style="float:left;width:100%;margin-top:10px;text-align:justify;padding-bottom:5px;color:#585858">
                    <a href="{{ route('news.show', $post) }}">
                        @if ($post->getFirstMedia('featured_image'))
                            <img style="float:left;width:auto;height:50px;margin-right:5px;margin-bottom:3px"
                                src='{{ $post->getFirstMedia('featured_image')->getUrl('') }}' />
                        @else
                            <img style="float:left;width:auto;height:50px;margin-right:5px;margin-bottom:3px"
                                src='{{ asset($post->image) }}' />
                        @endif
                    </a>
                    <h3 style="color:#fff;font-size:10px;margin-right:5px; font-weight: normal;">
                        <a href="{{ route('news.show', $post) }}">
                            <span> {{ Str::limit($post->title, 50, '...') }}</span></a>
                    </h3>
                </div>
            </div>
        @endforeach
    </div>
</div>
