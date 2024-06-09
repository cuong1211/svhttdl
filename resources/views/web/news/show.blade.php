<x-website-layout>
    <section>
        <div class="mx-auto max-w-7xl px-3 sm:px-6 md:items-center lg:px-8">
            <div class="grid grid-cols-8 gap-4">
                <div class="col-span-8 space-y-3 md:col-span-6 lg:col-span-6">
                    <div class="border-b-2 border-blue-700">
                        <h2 class="inline-block bg-blue-700 px-6 py-3 text-xl font-bold text-white">@lang('web.news_events')</h2>
                    </div>
                    <div class="breadcrumbs w-full text-sm">
                        <ul>
                            <li>
                                <a href="{{ route('news.index') }}">@lang('web.news')</a>
                            </li>
                            <li>{{ $post->category->title }}</li>
                        </ul>
                    </div>
                    <article class="group">
                        <div
                            class="tooltip tooltip-top flex items-center gap-2 text-green-700"
                            data-tip="{{ $post->published_post_date }}"
                        >
                            <x-heroicon-m-calendar class="size-4" />
                            <span class="text-xs">{{ $post->published_post_date_thumb }}</span>
                        </div>
                        <h2 class="text-2xl font-bold">{{ $post->title }}</h2>
                        <div class="">
                            {!! $post->content !!}
                        </div>
                    </article>
                    <div class="flex items-center gap-2">
                        <div class="flex items-center gap-1">
                            <x-heroicon-o-tag class="size-4" />
                            <span class="text-sm font-bold">@lang('web.post_tags')</span>
                        </div>
                        <ul class="flex items-center gap-2">
                            @foreach ($post->tags as $tag)
                                <li>
                                    <a
                                        href="#"
                                        class="btn btn-xs"
                                        >{{ $tag->name }}</a
                                    >
                                </li>
                            @endforeach
                        </ul>
                    </div>
                </div>
                <div class="col-span-8 hidden space-y-3 md:col-span-2 lg:block">
                    <x-website.announcement />
                </div>
            </div>
        </div>
    </section>
</x-website-layout>
