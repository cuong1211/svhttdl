{{-- <div class="sticky top-16">
    <div class="flex items-center gap-2 bg-blue-700 px-4 py-3 font-semibold uppercase text-white">
        <x-heroicon-o-megaphone class="size-5" />
        <span>@lang('web.announcements')</span>
    </div>
    <ul id="scroll-container-document"
        class="flex h-[500px] flex-col divide-y divide-dashed divide-blue-500 overflow-scroll overflow-y-auto overscroll-contain border border-blue-500 text-sm scrollbar-hide">
        @foreach ($announcements as $announcement)
            <li class="gap-2 p-3 text-sm">
                <div class="gap float-left mr-2 divide-y divide-blue-200 bg-blue-700 text-white">
                    <div class="h-4 w-12 whitespace-nowrap text-center text-[10px]">
                        @lang('web.month')
                        {{ $announcement->published_at->translatedFormat('m') }}
                    </div>
                    <div class="text h-8 w-12 text-center text-xl font-extrabold">
                        {{ $announcement->published_at->translatedFormat('d') }}</div>
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
</div> --}}
<div>
    <div class="notification-box">
        <div class="notification-header">
            <svg xmlns="http://www.w3.org/2000/svg" style="color:#ddd;" width="20" fill="#fff"
                viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9" />
            </svg>
            <a href="{{route('noti.index')}}">THÔNG BÁO MỚI</a>
        </div>
        <div class="notification-body">
            <ul id="notification">
                @foreach ($announcements as $announcement)
                    <li><a href="{{ route('noti.show', $announcement->id) }}"> {{ $announcement->title }}</a>
                    </li>
                @endforeach
            </ul>
        </div>
    </div>
</div>
