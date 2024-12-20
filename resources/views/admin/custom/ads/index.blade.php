<x-app-layout>
    <div class="p-6">
        <div class="flex justify-between">
            <div class="text-black text-normal font-semibold leading-tight">
                <span class="">
                    Quản lý Quảng cáo
                </span>
            </div>
            <a class=" bg-blue-700 btn border-blue-500 " href="{{ route('admin.ads.create', request()->query()) }}">
                <x-heroicon-s-plus class="size-4 text-white" />
                <span class="text-white">@lang('admin.add')</span>
            </a>
        </div>
        @if (session('icon') && session('heading') && session('message'))
            <div class="alert alert-{{ session('icon') === 'success' ? 'success' : 'error' }}" role="alert">
                <strong>{{ session('heading') }}:</strong>
                {{ session('message') }}
            </div>
        @endif
        <div class="mt-6">
            <div class="overflow-hidden bg-white shadow-sm sm:rounded-lg">
                <div class="flex px-6 py-4">
                    <form action="{{ route('admin.ads.index') }}" method="GET" class="w-full">
                        <div class="items-center">
                            <ul class="menu md:menu-horizontal rounded-box bg-white gap-1">
                                <li>
                                    <label
                                        class="input border border-gray-300 bg-white text-gray-900 p-2 rounded-md items-center gap-2 flex md:w-full "
                                        style="border: 1px solid black;">
                                        <input name="search" type="text"
                                            class="grow placeholder-black font-semibold"
                                            placeholder="Tìm kiếm theo tiêu đề" style="border: unset; color:black"
                                            value="{{ request()->search }}" />
                                    </label>
                                </li>
                                <li>
                                    <button type="submit" class="btn bg-blue-700 w-full ">
                                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 16 16"
                                            class="h-4 w-4 opacity-70 fill-white">
                                            <path fill-rule="evenodd"
                                                d="M9.965 11.026a5 5 0 1 1 1.06-1.06l2.755 2.754a.75.75 0 1 1-1.06 1.06l-2.755-2.754ZM10.5 7a3.5 3.5 0 1 1-7 0 3.5 3.5 0 0 1 7 0Z"
                                                clip-rule="evenodd" />
                                        </svg>
                                    </button>
                                </li>
                            </ul>
                        </div>
                    </form>
                </div>
                <div class="overflow-x-auto">
                    <table class="table text-black text-base">
                        <!-- head -->
                        <thead class="text-black text-base">
                            <tr>
                                <th class="text-center font-semibold">#</th>
                                <th class="text-center font-semibold">Thứ tự</th>
                                <th class="text-left font-semibold">Tiêu đề</th>
                                <th class="text-left font-semibold">Đường dẫn</th>
                                <th class="text-center font-semibold">Ngày tạo</th>
                                <th class="text-center font-semibold">Ngày cập nhập</th>
                                <th class="text-center font-semibold">Chức năng</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($ads as $ad)
                                <tr>
                                    <th class="text-center">
                                        {{ $ads->firstItem() + $loop->index }}
                                    </th>
                                    <td class="w-12 text-center">
                                        <div class=" bg-blue-700 text-white">{{ $ad->order }}</div>
                                    </td>
                                    <td class="text-left">
                                        {{ $ad->title }}</td>
                                    <td class="text-left">
                                        {{ $ad->url }}</td>


                                    <td class="text-center">
                                        {{ $ad->created_at->format('d/m/Y h:i') }}
                                    </td>
                                    <td class="text-center">
                                        {{ $ad->updated_at->format('d/m/Y h:i') }}
                                    </td>
                                    <td class="flex gap-3 items-center justify-center">
                                        <a
                                            href="{{ route('admin.ads.edit', ['ad' => $ad->id] + request()->query()) }}"><x-heroicon-s-pencil-square
                                                class="size-4 text-green-600 " /></a>
                                        <form id="delete-form-{{ $ad->id }}"
                                            action="{{ route('admin.ads.destroy', ['ad' => $ad->id]) }}"
                                            method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <button type="button" onclick="confirmDelete({{ $ad->id }})">
                                                <x-heroicon-o-trash class="size-4 text-red-500" />
                                            </button>
                                        </form>
                                        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
                                        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
                                        <script>
                                            $(document).ready(function() {
                                                setTimeout(function() {
                                                    $(".alert").fadeOut(2000);
                                                }, 3000);
                                            });

                                            function confirmDelete(adsId) {
                                                Swal.fire({
                                                    title: 'Bạn có chắc chắn muốn xóa không?',
                                                    text: "Dữ liệu bị xóa sẽ không thể khôi phục lại được!",
                                                    icon: 'warning',
                                                    showCancelButton: true,
                                                    confirmButtonColor: '#3085d6',
                                                    cancelButtonColor: '#d33',
                                                    confirmButtonText: 'Có',
                                                    cancelButtonText: 'Không'
                                                }).then((result) => {
                                                    if (result.isConfirmed) {
                                                        $('#delete-form-' + adsId).submit();
                                                    }
                                                })
                                            }
                                        </script>

                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <div class="mt-4">
            {{ $ads->links('pagination.web-tailwind') }}
        </div>
    </div>
</x-app-layout>
