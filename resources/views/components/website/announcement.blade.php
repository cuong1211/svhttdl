<div class="sticky top-16">
    <div class="flex items-center gap-2 bg-blue-700 px-4 py-3 font-semibold uppercase text-white">
        <x-heroicon-o-megaphone class="size-5" />
        <span>@lang('web.announcements')</span>
    </div>
    <ul
        id="scroll-container-document"
        class="flex h-[500px] flex-col divide-y divide-dashed divide-blue-500 overflow-scroll overflow-y-auto overscroll-contain border border-blue-500 text-sm scrollbar-hide"
    >
        @foreach ($announcements as $announcement)
            <li class="gap-2 p-3 text-sm">
                <div class="gap float-left mr-2 divide-y divide-blue-200 bg-blue-700 text-white">
                    <div class="h-4 w-12 whitespace-nowrap text-center text-[10px]">
                        @lang('web.month')
                        {{ $announcement->published_at->translatedFormat('m') }}
                    </div>
                    <div class="text h-8 w-12 text-center text-xl font-extrabold">{{ $announcement->published_at->translatedFormat('d') }}</div>
                </div>
                <h3 class="line-clamp-3 h-12 font-bold leading-4 tracking-normal text-blue-900">
                    {{ $announcement->title }}
                </h3>
                <p class="mt-2 line-clamp-3 text-blue-700">
                    {{ html_entity_decode(strip_tags($announcement->content)) }}
                </p>
            </li>
        @endforeach
    </ul>
</div>
