<x-app-layout>
    <div class="p-6">
        <div class="flex justify-between">

            <div class="text-black text-normal font-semibold leading-tight">
                <span class="text-black text-normal flex items-center gap-2 font-semibold leading-tight">
                    @lang('admin.documents.list')
                </span>
            </div>

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
                    <form action="{{ route('admin.opinions.index') }}" method="GET" class="w-full">
                        <div class=" items-center gird-cols-3 md:grid-cols-1">
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
                                <th class="text-left font-semibold">Văn bản</th>
                                <th class="text-left font-semibold">Họ và tên</th>
                                <th class="text-center font-semibold">SĐT</th>
                                <th class="text-center font-semibold">Email</th>
                                <th class="text-center font-semibold">Ngày gửi</th>
                                <th class="text-center font-semibold">@lang('admin.funtion')</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($opinions as $opinion)
                                <tr>
                                    <th class="text-center">
                                        {{ $opinions->firstItem() + $loop->index }}
                                    </th>
                                    <td class="text-left">{{ $opinion->document_opinion[0]->name }}</td>
                                    <td class="text-left">{{ $opinion->name }}</td>
                                    <td class="text-center">{{ $opinion->phone }}</td>
                                    <td class="text-center">{{ $opinion->email }}</td>
                                    <td class="text-center">{{ $opinion->created_at }}</td>
                                    <td class="flex gap-3 items-center justify-center">
                                        <a
                                            href="{{ route('admin.opinions.show', [$opinion->id] + request()->query()) }}"><x-heroicon-o-eye
                                                class="size-4 text-green-600" /></a>
                                        <form id="delete-form-{{ $opinion->id }}"
                                            action="{{ route('admin.opinions.destroy', ['opinion' => $opinion->id]) }}"
                                            method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <button type="button" onclick="confirmDelete({{ $opinion->id }})">
                                                <x-heroicon-o-trash class="size-4 text-red-500" />
                                            </button>
                                        </form>

                                        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
                                        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
                                        <script>
                                            $(document).ready(function() {
                                                setTimeout(function() {
                                                    $(".alert").fadeOut(2000);
                                                }, 3000); // thông báo sẽ ẩn sau 3 giây
                                            });

                                            function confirmDelete(opinionId) {
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
                                                        $('#delete-form-' + opinionId).submit();
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
            {{ $opinions->links('pagination.web-tailwind') }}
        </div>
    </div>
</x-app-layout>
