<x-app-layout>
    <div class="p-6">
        <div class="text-black text-normal font-semibold leading-tight">
            <span class="text-black text-normal flex items-center gap-2 font-semibold leading-tight">
                @lang('admin.staffs.list')
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
                        <form action="{{ route('admin.staffs.index') }}" method="GET" class="w-full">
                            <div class="flex items-center justify-between">
                                <div class="flex items-center">
                                    <label class="input border border-gray-300 bg-white text-gray-900 p-2 rounded-md flex items-center gap-2 bg-white flex items-center gap-2">
                                        <input name="search" type="text" class="grow"
                                            placeholder="Tìm kiếm theo tiêu đề" style="border: unset; color:black""
                                            value="{{ request()->search }}" />
                                        <button type="submit">
                                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 16 16"
                                                fill="currentColor" class="h-4 w-4 opacity-70">
                                                <path fill-rule="evenodd"
                                                    d="M9.965 11.026a5 5 0 1 1 1.06-1.06l2.755 2.754a.75.75 0 1 1-1.06 1.06l-2.755-2.754ZM10.5 7a3.5 3.5 0 1 1-7 0 3.5 3.5 0 0 1 7 0Z"
                                                    clip-rule="evenodd" />
                                            </svg>
                                        </button>
                                    </label>
                                </div>
                                <a class="bg-blue-700 btn border-blue-500" href="{{ route('admin.staffs.create') }}">
                                    <x-heroicon-s-plus class="size-4 text-white" />
                                    <span class="text-white">@lang('admin.add')</span>
                                </a>
                            </div>
                        </form>
                    </div>
                    <table class="table">
                        <!-- head -->
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>@lang('admin.staffs.image')</th>
                                <th>@lang('admin.staffs.name')</th>
                                <th>@lang('admin.departments')</th>
                                <th>@lang('admin.positions')</th>
                                <th>@lang('admin.created_at')</th>
                                <th>@lang('admin.updated_at')</th>
                                <th>@lang('admin.funtion')</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($staffs as $staff)
                                <tr>
                                    <th>{{ $loop->index + 1 }}</th>
                                    <td>
                                        @if($staff->getFirstMedia('staff_image'))
                                            <img id="preview_img" class="h-10 w-10 rounded-full object-cover"
                                                 src="{{ $staff->getFirstMedia('staff_image')->getUrl() }}"
                                                 alt="{{ $staff->getFirstMedia('staff_image')->name }}" />
                                        @else
                                            <img id="preview_img" class="h-10 w-10 rounded-full object-cover"
                                                 src="/path/to/default/image.jpg"
                                                 alt="Default Image" />
                                        @endif
                                    </td>
                                    <td>{{ $staff->name }}</td>
                                    <td>{{ optional($staff->department)->name }}</td>
                                    <td>{{ optional($staff->position)->name }}</td>
                                    <td>{{ $staff->createdAtVi }}</td>
                                    <td>{{ $staff->updatedAtVi }}</td>
                                    <td class="flex gap-3">
                                        <a href="{{ route('admin.staffs.edit', $staff->id) }}">
                                            <x-heroicon-s-pencil-square class="size-4 text-green-600" />
                                        </a>
                                        <form id="delete-form-{{ $staff->id }}" action="{{ route('admin.staffs.destroy', ['staff' => $staff->id]) }}" method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <button type="button" onclick="confirmDelete({{ $staff->id }})">
                                                <x-heroicon-o-trash class="size-4 text-red-500" />
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                        
                        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
                        <script>
                            $(document).ready(function() {
                                setTimeout(function() {
                                    $(".alert").fadeOut(2000);
                                }, 3000);
                            });
                        
                            function confirmDelete(staffId) {
                                if (confirm('Bạn có chắc chắn muốn xóa nhân viên này không?')) {
                                    document.getElementById('delete-form-' + staffId).submit();
                                }
                            }
                        </script>
                        
                    </table>
                </div>
            </div>
        </div>
        <div class="mt-4">
            {{--            {{ $staffs->links('pagination.web-tailwind') }} --}}
        </div>
    </div>
</x-app-layout>
