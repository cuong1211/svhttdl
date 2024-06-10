<x-website-layout>
    <section>
        <div class="mx-auto max-w-7xl px-3 sm:px-6 md:items-center lg:px-8">
            <div class="grid grid-cols-8 gap-4">
                <div class="col-span-8 space-y-3 md:col-span-6 lg:col-span-6">
                    @foreach ($posts as $category)
                        @foreach ($category->children as $category_title)
                            <div class="border-b-2 border-blue-700">
                                <h2 class="inline-block bg-blue-700 px-6 py-3 text-xl font-bold text-white">
                                    {{ $category_title->title }}
                                </h2>
                            </div>
                            <ul class="space-y-4">
                                @foreach ($category_title->posts as $index => $post)
                                    <li>
                                        <article class="group">
                                            <div class="flex gap-3">
                                                @if ($index == 0)
                                                    <!-- Phần tử đầu tiên hiển thị đầy đủ ảnh và nội dung giới hạn 500 ký tự -->
                                                    
                                                    <a href="{{ route('news.show', $post) }}"
                                                        class="h-32 w-48 flex-none overflow-hidden">
                                                        <img class="h-auto w-full transition-all group-hover:scale-110"
                                                    src="{{ $post->getFirstMedia('featured_image')->getUrl('') }}"
                                                    alt="" />
                                                    </a>
                                                    <div class="flex flex-col items-start justify-between">
                                                        <div>
                                                            <a href="{{ route('news.show', $post) }}"
                                                                class="group-hover:underline">
                                                                <h3
                                                                    class="line-clamp-2 text-lg font-semibold leading-5 text-blue-950">
                                                                    {{ $post->title }}</h3>
                                                            </a>
                                                            <p class="mt-2 line-clamp-3 text-sm text-slate-500">
                                                                {{ Str::limit(html_entity_decode(strip_tags($post->content)), 500) }}
                                                            </p>
                                                        </div>
                                                        <div class="tooltip tooltip-top flex items-center gap-2 text-green-700"
                                                            data-tip="{{ $post->published_post_date }}">
                                                            <x-heroicon-m-calendar class="size-4" />
                                                            <span
                                                                class="text-xs">{{ $post->published_post_date_thumb }}</span>
                                                        </div>
                                                    </div>
                                                @else
                                                    <!-- Các phần tử khác chỉ hiển thị tiêu đề -->
                                                    <div class="flex flex-col items-start justify-between">
                                                        <a href="{{ route('news.show', $post) }}"
                                                            class="group-hover:underline">
                                                            <h3
                                                                class="line-clamp-2 text-lg font-semibold leading-5 text-blue-950">
                                                                {{ $post->title }}</h3>
                                                        </a>
                                                    </div>
                                                @endif
                                            </div>
                                        </article>
                                    </li>
                                @endforeach
                            </ul>
                        @endforeach
                    @endforeach
                    {{-- {{ $posts->links('pagination.web-tailwind') }} --}}
                </div>
                <div class="col-span-8 hidden space-y-3 md:col-span-2 lg:block">
                    <x-website.announcement />
                </div>
            </div>
        </div>
    </section>
</x-website-layout>
