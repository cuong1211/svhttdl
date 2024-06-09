<div>
    <div class="grid h-auto grid-cols-5 gap-2">
        <a
            href="{{ route('news.show', $latestPost) }}"
            class="group col-span-5 flex md:col-span-3"
        >
            <article>
                <figure>
                    <div class="relative overflow-hidden bg-red-500">
                        <img
                            class="h-auto w-full transition-all group-hover:scale-110"
                            src="{{ $latestPost->getFirstMedia('featured_image')->getUrl('') }}"
                            alt=""
                        />
                        <div class="absolute bottom-0 right-0 flex w-fit items-center gap-2 bg-blue-700 p-2 text-xs text-white">
                            <x-heroicon-m-calendar class="size-4" />
                            <span>{{ $latestPost->published_post_date }}</span>
                        </div>
                    </div>
                    <h2 class="line-clamp-2 h-20 py-2 text-justify font-roboto text-xl font-extrabold tracking-tight text-blue-700 group-hover:text-blue-800">
                        {{ $latestPost->title }}
                    </h2>
                </figure>

                <p class="line-clamp-6 text-justify font-roboto font-normal leading-5 text-slate-500">
                    {{ Str::limit(html_entity_decode(strip_tags($latestPost->content)), 500) }}
                </p>
            </article>
        </a>
        <div class="col-span-5 flex flex-col justify-between md:col-span-2">
            <div>
                <div class="flex items-center gap-2 border-x-4 border-blue-700 bg-white px-4 py-3 font-semibold uppercase text-blue-700">
                    <x-heroicon-o-newspaper class="size-5" />
                    <span>@lang('web.news_events')</span>
                </div>
                <div class="mt-2 h-auto space-y-3">
                    @foreach ($posts as $post)
                        @unless ($loop->first)
                            <a
                                class="block"
                                href="{{ route('news.show', $post) }}"
                            >
                                <article>
                                    <figure class="group relative flex rounded-t-xl">
                                        <div
                                            href="{{ route('news.show', $post) }}"
                                            class="h-20 w-28 flex-none overflow-hidden"
                                        >
                                            <img
                                                class="h-auto w-auto transition-all group-hover:scale-110"
                                                src="{{ $post->getFirstMedia('featured_image')->getUrl('') }}"
                                                alt="{{ $post->title }}"
                                            />
                                        </div>
                                        <figcaption class="w-full px-3 text-sm">
                                            <div class="">
                                                <div class="hover:text-rose-600 line-clamp-3 leading-5">{{ $post->title }}</div>
                                                <div class="flex justify-between gap-2 pt-2 text-xs text-green-700">
                                                    <div class="text-xs hover:underline">{{ $post->category->title }}</div>
                                                    <div
                                                        class="tooltip tooltip-left flex items-center gap-2"
                                                        data-tip="{{ $post->published_post_date }}"
                                                    >
                                                        <span class="text-xs">{{ $post->published_post_date_thumb }}</span>
                                                    </div>
                                                </div>
                                            </div>
                                        </figcaption>
                                    </figure>
                                </article>
                            </a>
                        @endunless
                    @endforeach
                </div>
            </div>
            {{-- <div class="mt-4 w-full text-center"> --}}
            {{-- <a --}}
            {{-- class="flex w-full justify-center border-blue-800 bg-blue-700 py-3 text-sm font-bold text-white hover:bg-blue-800 hover:shadow-lg" --}}
            {{-- href="{{ route('news.index') }}" --}}
            {{-- >@lang('web.show_more_posts') --}}
            {{-- </a> --}}
            {{-- </div> --}}
        </div>
    </div>
</div>
