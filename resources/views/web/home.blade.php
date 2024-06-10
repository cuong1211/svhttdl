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
                            <div class="container mx-auto space-y-8 mb-12">
                                <h1 class="text-4xl font-bold mb-6">{{ $category_title->title }}</h1>
                                <!-- Dòng 1: Tin tức mới nhất -->
                                <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                                    @foreach ($category_title->posts as $index => $post)
                                        <!-- Tin tức mới nhất -->
                                        @if ($index == 0)
                                            <div class="md:col-span-2 bg-white p-6 rounded-lg shadow-md">
                                                <div class="grid grid-cols-2 gap-4">
                                                    <div class="col-span-1">
                                                        <img src="{{ $post->getFirstMedia('featured_image')->getUrl() }}"
                                                            alt="{{ $post->title }}"
                                                            class="w-full h-48 object-cover rounded-md">
                                                    </div>
                                                    <div class="col-span-1">
                                                        <a href="{{ route('news.show', $post) }}"
                                                            class="group-hover:underline">
                                                            <h3
                                                                class="line-clamp-2 text-lg font-semibold leading-5 text-blue-950">
                                                                {{ $post->title }}
                                                            </h3>
                                                        </a>
                                                        <p class="mt-2 line-clamp-3 text-sm text-slate-500">
                                                            {{ Str::limit(html_entity_decode(strip_tags($post->content)), 500) }}
                                                        </p>
                                                    </div>
                                                </div>
                                            </div>
                                        @elseif ($index == 1)
                                            <!-- Tin tức bên phải không có ảnh -->
                                            <div class="md:col-span-1 bg-white p-6 rounded-lg shadow-md">
                                                <a href="{{ route('news.show', $post) }}" class="group-hover:underline">
                                                    <h3
                                                        class="line-clamp-2 text-lg font-semibold leading-5 text-blue-950">
                                                        {{ $post->title }}
                                                    </h3>
                                                </a>
                                                <p class="mt-2 line-clamp-3 text-sm text-slate-500">
                                                    {{ Str::limit(html_entity_decode(strip_tags($post->content)), 500) }}
                                                </p>
                                            </div>
                                        @endif
                                    @endforeach
                                </div>

                                <!-- Dòng 2: Các tin tức chỉ tiêu đề phân bổ thành 3 cột -->
                                <div class="grid grid-cols-3 md:grid-cols-3 gap-8 mt-6">
                                    @foreach ($category_title->posts as $index => $post)
                                        @if ($index > 1)
                                            <div class="bg-white p-6 rounded-lg shadow-md">
                                                <a href="{{ route('news.show', $post) }}" class="group-hover:underline">
                                                    <h3
                                                        class="line-clamp-2 text-lg font-semibold leading-5 text-blue-950">
                                                        {{ $post->title }}
                                                    </h3>
                                                </a>
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
