<x-website-layout>
    {{-- <section class="bg-[#2213390] bg-white">
        <div class="mx-auto max-w-7xl flex-col justify-between px-3 sm:px-6 md:items-center lg:flex lg:flex-row lg:px-8">
            <video
                class="w-full"
                autoplay
                loop
                muted
                src="{{ asset('files/videos/slider_3.mp4') }}"
            ></video>
        </div>
    </section> --}}
    <section>
        <div class="mx-auto mt-6 max-w-7xl px-3 sm:px-6 md:items-center lg:px-8">
            <div class="grid grid-cols-8 gap-4">
                <div class="col-span-8 space-y-10 md:col-span-6 lg:col-span-6">
                    <x-website.home-post />
                    {{-- <x-website.education-program />
                    <x-website.staff />
                    <x-website.infrastructure />
                    <x-website.partners /> --}}
                    @foreach ($posts as $category)
                        @foreach ($category->children as $category_title)
                            <div class="container mx-auto space-y-8 mb-12 bg-white shadow-md p-6">
                                <h1 class="text-justify font-roboto text-xl font-extrabold tracking-tight text-blue-700 group-hover:text-blue-800 mb-6">{{ $category_title->title }}</h1>
                                <!-- Dòng 1: Tin tức mới nhất -->
                                <div class="grid grid-cols-8 md:grid-cols-3">
                                    @foreach ($category_title->posts as $index => $post)
                                        <!-- Tin tức mới nhất -->
                                        @if ($index == 0)
                                            <div class="md:col-span-6 ">
                                                <div class="grid grid-cols-2 gap-3">
                                                    <div class="">
                                                        <img src="{{ $post->getFirstMedia('featured_image')->getUrl() }}"
                                                            alt="{{ $post->title }}"
                                                            class="w-full h-full object-cover ">
                                                    </div>
                                                    <div class="">
                                                        <a href="{{ route('news.show', $post) }}" class="">
                                                            <h3 class=" text-lg font-semibold leading-5 text-blue-950">
                                                                {{ $post->title }}
                                                            </h3>
                                                        </a>
                                                        <p class="mt-2 line-clamp-3 text-sm text-slate-500">
                                                            {{ Str::limit(html_entity_decode(strip_tags(app\Models\Post::query()->where('id', $post->id)->first()->content->toTrixHtml())),500) }}
                                                        </p>
                                                        <div class="tooltip tooltip-top flex items-center gap-2 text-green-700"
                                                            data-tip="{{ $post->published_post_date }}">
                                                            <x-heroicon-m-calendar class="size-4" />
                                                            <span
                                                                class="text-xs">{{ $post->published_post_date_thumb }}</span>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        @elseif ($index == 1)
                                            <!-- Tin tức bên phải không có ảnh -->
                                            <div class="md:col-span-2  ">
                                                <a href="{{ route('news.show', $post) }}" class="">
                                                    <h3
                                                        class="line-clamp-2 text-lg font-semibold leading-5 text-blue-950">
                                                        {{ $post->title }}
                                                    </h3>
                                                </a>
                                                <p class="mt-2 line-clamp-3 text-sm text-slate-500">
                                                    {{ Str::limit(html_entity_decode(strip_tags(app\Models\Post::query()->where('id', $post->id)->first()->content->toTrixHtml())),500) }}

                                                </p>
                                                <div class="tooltip tooltip-top flex items-center gap-2 text-green-700"
                                                    data-tip="{{ $post->published_post_date }}">
                                                    <x-heroicon-m-calendar class="size-4" />
                                                    <span class="text-xs">{{ $post->published_post_date_thumb }}</span>
                                                </div>
                                            </div>
                                        @endif
                                    @endforeach
                                </div>

                                <!-- Dòng 2: Các tin tức chỉ tiêu đề phân bổ thành 3 cột -->
                                <div class="grid grid-cols-3 md:grid-cols-3 ">
                                    @foreach ($category_title->posts as $index => $post)
                                        @if ($index > 1)
                                            <div class="p-6 ">
                                                <a href="{{ route('news.show', $post) }}" class="">
                                                    <h3
                                                        class=" text-lg font-semibold leading-5 text-blue-950">
                                                        {{ $post->title }}
                                                    </h3>
                                                </a>
                                                <div class="tooltip tooltip-top flex items-center gap-2 text-green-700"
                                                    data-tip="{{ $post->published_post_date }}">
                                                    <x-heroicon-m-calendar class="size-4" />
                                                    <span class="text-xs">{{ $post->published_post_date_thumb }}</span>
                                                </div>
                                            </div>
                                        @endif
                                    @endforeach
                                </div>
                            </div>
                        @endforeach
                    @endforeach

                </div>
                <div class="col-span-8 hidden space-y-3 md:col-span-2 lg:block">
                    <x-website.announcement />
                </div>
            </div>
        </div>
    </section>
</x-website-layout>
