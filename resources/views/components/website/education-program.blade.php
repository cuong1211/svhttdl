<div class="col-span-8 space-y-3 md:col-span-6 lg:col-span-6">
    <h2 class="font-semibold text-green-700">@lang('web.educational_program')</h2>
    <p class="mb-4 mt-3 text-4xl font-extrabold">@lang('web.educational_program_title')</p>
    <p class="mb-6 text-slate-500">@lang('web.educational_program_text')</p>
    <div class="relative flex items-center">
        <img
            src="{{ asset('files/images/banner_m.jpeg') }}"
            alt=""
        />
        <div class="absolute inset-0 flex items-end justify-center">
            <a
                class="mb-4 flex items-center border-4 border-blue-950 px-3 py-2 text-sm font-bold hover:bg-blue-950 hover:text-white"
                href=""
            >
                <span>Đăng ký ngay hom nay</span>
                <x-heroicon-m-arrow-small-right class="ml-1 size-6 animate-bounceHorizontal" />
            </a>
        </div>
    </div>
</div>
