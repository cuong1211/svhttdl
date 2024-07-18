<x-website-layout>
    @push('styles')
        <style>
            .groupnews_item2 {
                float: left;
                width: 100%;
                margin-top: 10px;
                text-align: justify;
                padding-bottom: 5px;
                color: #585858
            }

            .groupnews_item2 h3 a {
                color: #101010;
                font-size: 12px;
                line-height: 25px;
                margin-right: 5px
            }

            .groupnews_item2 img {
                float: left;
                width: 220px;
                height: 146px;
                margin-right: 5px;
                margin-bottom: 3px
            }
        </style>
    @endpush
    @foreach ($posts as $category)
        @if ($category->children->count() > 0)
            @foreach ($category->children as $category_title)
                <div class="khungtin" style=" float: left; width: 100%; margin-bottom: 5px; ">
                    <div class="groupnews_head bg_blue">
                        <a class='group_header_link'
                            href="{{ route('news.child', ['Id' => $category_title->id]) }}">{{ $category_title->title }}</a>
                    </div>
                    @foreach ($category_title->posts as $index => $post)
                        @if ($index == 0)
                            <div class="groupnews_item2">
                                <a href="{{ route('news.show', $post) }}">
                                    @if ($post->getFirstMedia('featured_image'))
                                        <img src='{{ $post->getFirstMedia('featured_image')->getUrl('') }}'
                                            alt='' />
                                    @else
                                        <img src='{{ asset($post->image) }}' alt='' />
                                    @endif
                                </a>
                                <h3>
                                    <a href="{{ route('news.show', $post) }}">
                                        <span><b>{{ $post->title }}</b></span>
                                    </a>
                                </h3>
                                <p></p>
                            </div>
                        @endif
                    @endforeach

                    <ul class="othernews">
                        @foreach ($category_title->posts as $index => $post)
                            @if ($index > 0 and $index < 10)
                                <li>
                                    <a href="{{ route('news.show', $post) }}">{{ $post->title }} </a>
                                </li>
                            @endif
                        @endforeach
                    </ul>
                </div>
            @endforeach
        @endif
    @endforeach
</x-website-layout>
