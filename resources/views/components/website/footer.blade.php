<footer class="relative">
    <div class="relative mt-10 h-auto overflow-hidden bg-blue-700">
        <div class="absolute top-0 z-0">
            <x-website.girc-logo-svg class="absolute -top-10 z-10 size-96 text-blue-600" />
        </div>
        <div class="relative z-10 mx-auto grid h-full w-full max-w-7xl grid-cols-3 gap-10 overflow-hidden px-3 py-10">
            <div class="flex flex-col items-start justify-end gap-2 text-white">
                <div class="flex items-start gap-2">
                    <div class="">
                        <x-website.girc-logo-svg class="size-14 text-white" />
                    </div>
                    <div class="mt-2 text-left font-normal">
                        <small class="text-blue-300">@lang('web.tuaf_long')</small>
                        <div class="font-bold">@lang('web.girc_long')</div>
                    </div>
                </div>
                <div class="mt-2 border-l-2 border-white bg-black/10 p-4 text-sm text-blue-200 backdrop-blur">
                    @lang('web.footer_girc_text')
                </div>
            </div>
            <div class="text-white">
                <h3 class="bg-blue-800 px-4 py-2 text-left text-sm font-bold uppercase text-white">@lang('web.quick_links')</h3>
                <ul class="mt-2 space-y-2 text-left text-sm">
                    <li class="group flex items-center gap-2 text-blue-200 hover:text-white">
                        <x-heroicon-m-arrow-small-right class="size-4 group-hover:animate-bounceHorizontal" />
                        <a href="#">Chương trình đào tạo</a>
                    </li>
                    <li class="group flex items-center gap-2 text-blue-200 hover:text-white">
                        <x-heroicon-m-arrow-small-right class="size-4 group-hover:animate-bounceHorizontal" />
                        <a href="#">Tuyển sinh</a>
                    </li>
                    <li class="group flex items-center gap-2 text-blue-200 hover:text-white">
                        <x-heroicon-m-arrow-small-right class="size-4 group-hover:animate-bounceHorizontal" />
                        <a href="#">Khoa học & công nghệ</a>
                    </li>
                    <li class="group flex items-center gap-2 text-blue-200 hover:text-white">
                        <x-heroicon-m-arrow-small-right class="size-4 group-hover:animate-bounceHorizontal" />
                        <a href="#">Quan hệ, hợp tác</a>
                    </li>
                    <li class="group flex items-center gap-2 text-blue-200 hover:text-white">
                        <x-heroicon-m-arrow-small-right class="size-4 group-hover:animate-bounceHorizontal" />
                        <a href="#">Quỹ phát triển tài năng</a>
                    </li>
                </ul>
            </div>
            <div class="text-white">
                <h3 class="bg-blue-800 px-4 py-2 text-left text-sm font-bold uppercase text-white">@lang('web.contact')</h3>
                <ul class="mt-2 space-y-2 text-left text-sm">
                    <li class="group flex items-center gap-2 text-blue-200 hover:text-white">
                        <x-heroicon-o-map-pin class="size-6 flex-none group-hover:animate-bounceHorizontal" />
                        Trung tâm nghiên cứu địa tin học, Đại học Nông Lâm, xã Quyết Thắng - TP. Thái Nguyên
                    </li>
                    <li class="group flex items-center gap-2 text-blue-200 hover:text-white">
                        <x-heroicon-o-phone class="size-6 flex-none group-hover:animate-bounceHorizontal" />
                        <a href="tel:0904031103">0904.031.103</a>
                    </li>
                    <li class="group flex items-center gap-2 text-blue-200 hover:text-white">
                        <x-heroicon-o-envelope class="size-6 flex-none group-hover:animate-bounceHorizontal" />
                        <a href="mail:girc.tuaf@gmail.com">girc.tuaf@gmail.com</a>
                    </li>
                </ul>
            </div>
        </div>
        <div class="relative z-10 w-full bg-blue-900">
            <div class="mx-auto flex h-10 max-w-7xl items-center justify-center">
                <div class="text-xs text-blue-100">Copyright &copy; {{ now()->format('Y') }} GeoInformatics Research Center</div>
            </div>
        </div>
    </div>
</footer>
