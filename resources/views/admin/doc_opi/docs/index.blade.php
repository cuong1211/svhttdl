<x-app-layout>
    <div class="p-6">
        <div class="text-black text-normal font-semibold leading-tight">
            <span class="text-black text-normal flex items-center gap-2 font-semibold leading-tight">
                @lang('admin.documents.list')
            </span>
        </div>
        @if (session('icon') && session('heading') && session('message'))
            <div class="alert alert-{{ session('icon') === 'success' ? 'success' : 'danger' }}" role="alert">
                <strong>{{ session('heading') }}:</strong>
                {{ session('message') }}
            </div>
        @endif
        <div class="mt-6">
            <div class="overflow-hidden bg-white shadow-sm sm:rounded-lg">
                <div class="overflow-x-auto">
                    <div class="flex px-6 py-4">
                        <form action="{{ route('admin.documents.index') }}" method="GET" class="w-full">
                            <div class="flex items-center justify-between gird-cols-3 md:grid-cols-1">
                                <div class="flex items-center gap-4">
                                    <label
                                        class="input border border-gray-300 bg-white text-gray-900 p-2 rounded-md flex items-center gap-2"
                                        style="border: 1px solid black;">
                                        <input name="search" type="text" class="grow"
                                            placeholder="Tìm kiếm theo tiêu đề" style="border: unset; color:black"
                                            value="{{ request()->search }}" />

                                    </label>
                                    <button type="submit">
                                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 16 16" fill="currentColor"
                                            class="h-4 w-4 opacity-70">
                                            <path fill-rule="evenodd"
                                                d="M9.965 11.026a5 5 0 1 1 1.06-1.06l2.755 2.754a.75.75 0 1 1-1.06 1.06l-2.755-2.754ZM10.5 7a3.5 3.5 0 1 1-7 0 3.5 3.5 0 0 1 7 0Z"
                                                clip-rule="evenodd" />
                                        </svg>
                                    </button>
                                </div>
                                <a class="bg-blue-700 btn border-blue-500"
                                    href="{{ route('admin.docs-opis.create') }}">
                                    <x-heroicon-s-plus class="size-4 text-white" />
                                    <span class="text-white">@lang('admin.add')</span>
                                </a>
                            </div>
                        </form>
                    </div>
                    <table class="table text-black text-base">
                        <!-- head -->
                        <thead class="text-black text-base">
                            <tr>
                                <th class="text-center font-semibold">#</th>
                                <th class="text-left font-semibold">@lang('admin.documents.name')</th>
                                <th class="text-center font-semibold">Ngày bắt đầu</th>
                                <th class="text-center font-semibold">Ngày kết thúc</th>
                                <th class="text-center font-semibold">@lang('admin.created_at')</th>
                                <th class="text-center font-semibold">@lang('admin.updated_at')</th>
                                <th class="text-center font-semibold">@lang('admin.funtion')</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($docs as $doc)
                                <tr>
                                    <th class="text-center">
                                        {{ $docs->firstItem() + $loop->index }}
                                    </th>
                                    <td class="text-left">{{ $doc->name }}</td>
                                    <td class="text-center">{{ $doc->startAtVi }}</td>
                                    <td class="text-center">{{ $doc->endAtVi }}</td>
                                    <td class="text-center">{{ $doc->createdAtVi }}</td>
                                    <td class="text-center">{{ $doc->updatedAtVi }}</td>

                                    <td class="flex gap-3 items-center justify-center">
                                        <a href="{{ route('admin.docs-opis.edit', $doc->id) }}"><x-heroicon-s-pencil-square
                                                class="size-4 text-green-600" /></a>
                                        <form id="delete-form-{{ $doc->id }}"
                                            action="{{ route('admin.docs-opis.destroy', ['docs_opi' => $doc->id]) }}"
                                            method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <button type="button" onclick="confirmDelete({{ $doc->id }})">
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
                                            function confirmDelete(documentId) {
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
                                                        $('#delete-form-' + documentId).submit();
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
            {{ $docs->links('pagination.web-tailwind') }}
        </div>
    </div>
</x-app-layout>