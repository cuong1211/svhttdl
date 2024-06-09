<nav class="sticky top-0 z-50 w-full bg-blue-700 shadow" x-data="{ navOpen: false }">
    <div class="lg:hidden">
        <button
            class="hover:bg-denim-600 border-denim-600 focus:shadow-outline flex h-full items-center px-3 py-4 text-white focus:outline-none lg:border-l"
            @click="navOpen = !navOpen">
            <x-heroicon-o-bars-3-bottom-left class="size-5" />
        </button>
    </div>
    <div class="mx-auto hidden max-w-7xl flex-col justify-between px-3 sm:px-6 md:items-center lg:flex lg:flex-row lg:px-8"
        :class="{ 'flex': navOpen, 'hidden': !navOpen }">
        <ul class="text-normal flex w-full flex-col text-xs lg:flex-row lg:divide-x-0 lg:divide-y-0">
            <li>
                <a class="flex h-full w-full flex-row items-center justify-start gap-2 bg-blue-500 py-2 text-center font-semibold uppercase tracking-wider text-white hover:bg-blue-500 focus:outline-none"
                    href="/">
                    <span class="border-white px-2">
                        <x-heroicon-o-home class="size-5" />
                    </span>
                </a>
            </li>
            @foreach($menus as $menu)
                <li class="relative flex-row whitespace-nowrap" x-data="{ dropdownOpen: false }"
                    @mouseover.away="dropdownOpen = false">
                    <div class="flex hover:bg-blue-500 hover:text-white"
                        :class="{ 'bg-black bg-opacity-20': dropdownOpen }">
                        <a
                            class="flex h-full w-full flex-row items-center justify-between gap-2 py-4 text-center font-semibold uppercase tracking-wider text-white focus:outline-none"
                            href="{{$menu->link}}" @mouseover="dropdownOpen = true">
                            <span class="flex w-full justify-between gap-2 border-white px-2 lg:w-auto lg:justify-start">
                                {{ $menu->title }}
                                @if ($menu->children->count() > 0)
                                    <x-heroicon-c-chevron-down class="size-4" />
                                    
                                @endif
                                {{-- <x-heroicon-c-chevron-down class="size-4" /> --}}
                            </span>
                        </a>
                    </div>
                    <div class="hidden w-full origin-top-left bg-white shadow-md md:w-full lg:absolute"
                        :class="{ 'block': dropdownOpen, 'hidden': !dropdownOpen }">
                        <ul
                            class="text-denim-600 divide-denim-400 w-full origin-top-left divide-y divide-dashed whitespace-nowrap bg-white">
                            @foreach($menu->children as $child)
                                <li class="hover:bg-black hover:bg-opacity-5">
                                    <a class="flex items
                                    -center justify-start space-x-2 px-2 py-4 text-slate-800"
                                        href="{{ $child->link }}">
                                        {{ $child->title }}
                                    </a>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                </li>
            @endforeach
            
            {{-- <li class="relative flex-row whitespace-nowrap">
                <a class="flex h-full items-center justify-start py-4 font-semibold uppercase tracking-wider text-white hover:bg-blue-500 hover:text-white"
                    href="{{ route('about') }}">
                    <span class="border-white px-2">@lang('web.about')</span>
                </a>
            </li>
            <li class="relative flex-row whitespace-nowrap" x-data="{ dropdownOpen: false }"
                @mouseover.away="dropdownOpen = false">
                <div class="flex hover:bg-blue-500 hover:text-white"
                    :class="{ 'bg-black bg-opacity-20': dropdownOpen }">
                    <button
                        class="flex h-full w-full flex-row items-center justify-between gap-2 py-4 text-center font-semibold uppercase tracking-wider text-white focus:outline-none"
                        href="#" @mouseover="dropdownOpen = true">
                        <span class="flex w-full justify-between gap-2 border-white px-2 lg:w-auto lg:justify-start">
                            Tin tức
                            <x-heroicon-c-chevron-down class="size-4" />
                        </span>
                    </button>
                </div>
                <div class="hidden w-full origin-top-left bg-white shadow-md md:w-auto lg:absolute"
                :class="{ 'block': dropdownOpen, 'hidden': !dropdownOpen }">
                <ul
                    class="text-denim-600 divide-denim-400 w-full origin-top-left divide-y divide-dashed whitespace-nowrap bg-white">
                    <li class="hover:bg-black hover:bg-opacity-5">
                        <a class="flex items-center justify-start space-x-2 px-2 py-4 text-slate-800"
                            href="">
                            Kỹ sư Quản lý thông tin
                        </a>
                    </li>   
                    
                </ul>
            </div>
            </li>
            <li class="relative flex-row whitespace-nowrap" x-data="{ dropdownOpen: false }"
                @mouseover.away="dropdownOpen = false">
                <div class="flex hover:bg-blue-500 hover:text-white"
                    :class="{ 'bg-black bg-opacity-20': dropdownOpen }">
                    <button
                        class="flex h-full w-full flex-row items-center justify-between gap-2 py-4 text-center font-semibold uppercase tracking-wider text-white focus:outline-none"
                        href="#" @mouseover="dropdownOpen = true">
                        <span class="flex w-full justify-between gap-2 border-white px-2 lg:w-auto lg:justify-start">
                            Chương trình đào tạo
                            <x-heroicon-c-chevron-down class="size-4" />
                        </span>
                    </button>
                </div>
                <div class="hidden w-full origin-top-left bg-white shadow-md md:w-auto lg:absolute"
                    :class="{ 'block': dropdownOpen, 'hidden': !dropdownOpen }">
                    <ul
                        class="text-denim-600 divide-denim-400 w-full origin-top-left divide-y divide-dashed whitespace-nowrap bg-white">
                        <li class="hover:bg-black hover:bg-opacity-5">
                            <a class="flex items-center justify-start space-x-2 px-2 py-4 text-slate-800"
                                href="">
                                Kỹ sư Quản lý thông tin
                            </a>
                        </li>
                        <li class="hover:bg-black hover:bg-opacity-5">
                            <a class="flex items-center justify-start space-x-2 px-2 py-4 text-slate-800"
                                href="">
                                Kỹ sư Công nghệ đổi mới sáng tạo
                            </a>
                        </li>
                        <li class="hover:bg-black hover:bg-opacity-5">
                            <a class="flex items-center justify-start space-x-2 px-2 py-4 text-slate-800"
                                href="">
                                Khoá đào tạo chuyên gia
                            </a>
                        </li>
                    </ul>
                </div>
            </li>
            <li class="relative flex-row whitespace-nowrap" x-data="{ dropdownOpen: false }"
                @mouseover.away="dropdownOpen = false">
                <div class="flex hover:bg-blue-500 hover:text-white"
                    :class="{ 'bg-black bg-opacity-20': dropdownOpen }">
                    <button
                        class="flex h-full w-full flex-row items-center justify-between gap-2 py-4 text-center font-semibold uppercase tracking-wider text-white focus:outline-none"
                        href="#" @mouseover="dropdownOpen = true">
                        <span class="flex w-full justify-between gap-2 border-white px-2 lg:w-auto lg:justify-start">
                            Tuyển sinh </span>
                    </button>
                </div>
            </li>
            <li class="relative flex-row whitespace-nowrap" x-data="{ dropdownOpen: false }"
                @mouseover.away="dropdownOpen = false">
                <div class="flex hover:bg-blue-500 hover:text-white"
                    :class="{ 'bg-black bg-opacity-20': dropdownOpen }">
                    <button
                        class="flex h-full w-full flex-row items-center justify-between gap-2 py-4 text-center font-semibold uppercase tracking-wider text-white focus:outline-none"
                        href="#" @mouseover="dropdownOpen = true">
                        <span class="flex w-full justify-between gap-2 border-white px-2 lg:w-auto lg:justify-start">
                            Khoa học & công nghệ </span>
                    </button>
                </div>
            </li>
            <li class="relative flex-row whitespace-nowrap" x-data="{ dropdownOpen: false }"
                @mouseover.away="dropdownOpen = false">
                <div class="flex hover:bg-blue-500 hover:text-white"
                    :class="{ 'bg-black bg-opacity-20': dropdownOpen }">
                    <button
                        class="flex h-full w-full flex-row items-center justify-between gap-2 py-4 text-center font-semibold uppercase tracking-wider text-white focus:outline-none"
                        href="#" @mouseover="dropdownOpen = true">
                        <span class="flex w-full justify-between gap-2 border-white px-2 lg:w-auto lg:justify-start">
                            Quan hệ, hợp tác
                            <x-heroicon-c-chevron-down class="size-4" />
                        </span>
                    </button>
                </div>
                <div class="hidden w-full origin-top-left bg-white shadow-md md:w-auto lg:absolute"
                    :class="{ 'block': dropdownOpen, 'hidden': !dropdownOpen }">
                    <ul
                        class="text-denim-600 divide-denim-400 w-full origin-top-left divide-y divide-dashed whitespace-nowrap bg-white">
                        <li class="hover:bg-black hover:bg-opacity-5">
                            <a class="flex items-center justify-start space-x-2 px-2 py-4 text-slate-800"
                                href="">
                                Trong nước
                            </a>
                        </li>
                        <li class="hover:bg-black hover:bg-opacity-5">
                            <a class="flex items-center justify-start space-x-2 px-2 py-4 text-slate-800"
                                href="">
                                Quốc tế
                            </a>
                        </li>
                    </ul>
                </div>
            </li>
            <li class="relative flex-row whitespace-nowrap" x-data="{ dropdownOpen: false }"
                @mouseover.away="dropdownOpen = false">
                <div class="flex hover:bg-blue-500 hover:text-white"
                    :class="{ 'bg-black bg-opacity-20': dropdownOpen }">
                    <button
                        class="flex h-full w-full flex-row items-center justify-between gap-2 py-4 text-center font-semibold uppercase tracking-wider text-white focus:outline-none"
                        href="#" @mouseover="dropdownOpen = true">
                        <span class="flex w-full justify-between gap-2 border-white px-2 lg:w-auto lg:justify-start">
                            Quỹ phát triển tài năng </span>
                    </button>
                </div>
            </li> --}}
        </ul>
        <div class="flex flex-row gap-3 py-4 lg:py-0">
            <x-heroicon-o-magnifying-glass class="size-5 text-white" />
        </div>
    </div>
</nav>
