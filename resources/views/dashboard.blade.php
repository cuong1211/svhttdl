<x-app-layout>
    <x-slot name="header">
        <h2 class="text-black text-xl font-semibold leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
            <div class="overflow-hidden bg-white shadow-sm sm:rounded-lg">
                <div class="text-gray-900 p-6">
                    {{ __("Bạn đã đăng nhập thành công !") }}
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
