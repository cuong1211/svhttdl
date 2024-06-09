<x-app-layout>
    <div class="p-6">
        <div class="text-gray-800 text-normal font-semibold leading-tight">
            <span class="text-gray-800 text-normal flex items-center gap-2 font-semibold leading-tight">
                @lang('admin.contacts')
                <x-heroicon-m-arrow-small-right class="size-4" />
                @lang('admin.contacts.show')
            </span>
        </div>
        <div class="mt-6">
            <a
                href="{{ route('admin.contacts.index') }}"
                class="bg-gray-300 text-gray-700 hover:bg-gray-400 active:bg-gray-500 focus:border-gray-500 focus:ring-gray-300 inline-flex items-center rounded-md px-4 py-2 text-xs font-semibold uppercase tracking-widest transition focus:outline-none focus:ring disabled:opacity-25"
            >
                <x-heroicon-o-arrow-left class="mr-2 size-4" />
                @lang('admin.back')
            </a>
            <div class="overflow-hidden bg-white shadow-sm sm:rounded-lg">
                <div class="border-gray-200 border-b bg-white p-6">
                    <div class="grid grid-cols-1 gap-4 md:grid-cols-2">
                        <div class="col-span-1">
                            <h3 class="text-gray-900 text-lg font-medium leading-6">@lang('admin.contacts.name')</h3>
                            <p class="text-gray-500 mt-1 max-w-2xl text-sm">{{ $contact->name }}</p>
                        </div>
                        <div class="col-span-1">
                            <h3 class="text-gray-900 text-lg font-medium leading-6">@lang('admin.contacts.email')</h3>
                            <p class="text-gray-500 mt-1 max-w-2xl text-sm">{{ $contact->email }}</p>
                        </div>
                        <div class="col-span-1">
                            <h3 class="text-gray-900 text-lg font-medium leading-6">@lang('admin.contacts.phone')</h3>
                            <p class="text-gray-500 mt-1 max-w-2xl text-sm">{{ $contact->phone }}</p>
                        </div>
                        <div class="col-span-1">
                            <h3 class="text-gray-900 text-lg font-medium leading-6">@lang('admin.contacts.read_at')</h3>
                            <p class="text-gray-500 mt-1 max-w-2xl text-sm">{{ $contact->read_at ? $contact->read_at : 'Not read yet' }}</p>
                        </div>
                        <div class="col-span-1">
                            <h3 class="text-gray-900 text-lg font-medium leading-6">@lang('admin.contacts.created_at')</h3>
                            <p class="text-gray-500 mt-1 max-w-2xl text-sm">{{ $contact->createdAtVi }}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
