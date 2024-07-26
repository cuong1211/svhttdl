<x-app-layout>
    <div class="p-6">
        <div class="text-black text-normal font-semibold leading-tight">
            <span class="text-black text-normal flex items-center gap-2 font-semibold leading-tight">
                Ý kiến
                <x-heroicon-m-arrow-small-right class="size-4" />
                @lang('admin.contacts.show')
            </span>
        </div>
        <div class="mt-6">
            <a href="{{ route('admin.opinions.index', request()->query()) }}"
                class="bg-gray-300 text-black hover:bg-gray-400 active:bg-gray-500 focus:border-gray-500 focus:ring-gray-300 inline-flex items-center rounded-md px-4 py-2 text-xs font-semibold uppercase tracking-widest transition focus:outline-none focus:ring disabled:opacity-25">
                <x-heroicon-o-arrow-left class="mr-2 size-4" />
                @lang('admin.back')
            </a>
            <div class="overflow-hidden bg-white shadow-sm sm:rounded-lg">
                <div class="border-gray-200 border-b bg-white p-6">
                    <div class="grid grid-cols-1 gap-4 md:grid-cols-2">
                        <div class="col-span-1">
                            <h3 class="text-black text-lg font-medium leading-6">@lang('admin.contacts.name')</h3>
                            <p class="text-black mt-1 max-w-2xl text-sm">{{ $opinion->name }}</p>
                        </div>
                        <div class="col-span-1">
                            <h3 class="text-black text-lg font-medium leading-6">@lang('admin.contacts.email')</h3>
                            <p class="text-black mt-1 max-w-2xl text-sm">{{ $opinion->email }}</p>
                        </div>
                        <div class="col-span-1">
                            <h3 class="text-black text-lg font-medium leading-6">@lang('admin.contacts.phone')</h3>
                            <p class="text-black mt-1 max-w-2xl text-sm">{{ $opinion->phone }}</p>
                        </div>
                        <div class="col-span-1">
                            <h3 class="text-black text-lg font-medium leading-6">@lang('admin.contacts.address')</h3>
                            <p class="text-black mt-1 max-w-2xl text-sm">{{ $opinion->address }}</p>
                        </div>
                        <div class="col-span-1">
                            <h3 class="text-black text-lg font-medium leading-6">@lang('admin.contacts.created_at')</h3>
                            <p class="text-black mt-1 max-w-2xl text-sm">{{ $opinion->created_at }}</p>
                        </div>
                    </div>
                </div>
                <div class="border-gray-200 border-b bg-white p-6">
                    <div class="grid grid-cols-1 gap-4 md:grid-cols-1">
                        <div class="col-span-1">
                            <h3 class="text-black text-lg font-medium leading-6">Nội dung</h3>
                            <p class="text-black mt-1 max-w-2xl ">{!! $opinion->content !!}</p>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
