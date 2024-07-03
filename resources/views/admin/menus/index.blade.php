<x-app-layout>
    <div class="p-6">
        <div class="text-black text-normal font-semibold leading-tight">
            <span class="text-black text-normal flex items-center gap-2 font-semibold leading-tight">
                @lang('admin.menu.list')
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
                        <form action="{{ route('admin.categories.index') }}" method="GET" class="w-full">
                            <div class="flex items-center justify-between">
                                <div class="flex items-center">
                                    <label class="input border border-gray-300 bg-white text-gray-900 p-2 rounded-md flex items-center gap-2 bg-white flex items-center gap-2 bg-white">
                                        <input name="search" type="text" class="grow"
                                            placeholder="Search by title" style="border: unset; color:black""
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
                                <a class="bg-blue-700 btn border-blue-500" href="{{ route('admin.menus.create') }}">
                                    <x-heroicon-s-plus class="size-4 text-white" />
                                    <span class="text-white">@lang('admin.add')</span>
                                </a>
                            </div>
                        </form>
                    </div>
                    <table class="table" id="kt_customers_table">
                        <!-- head -->
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>@lang('admin.menus.order')</th>
                                <th>@lang('admin.menus.title')</th>
                                <th>@lang('admin.menus.position')</th>
                                <th>@lang('admin.menus.created_at')</th>
                                <th>@lang('admin.menus.updated_at')</th>
                                <th>@lang('admin.funtion')</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($menus as $category)
                                <tr>
                                    <th>
                                        {{ $loop->index + 1 }}
                                    </th>
                                    <td>
                                        <div class="badge bg-blue-700 text-white">{{ $category->order }}</div>
                                    </td>
                                    <td>{{ app()->getLocale() === 'en' ? $category->title_en : $category->title }}</td>
                                    <td>
                                        @if ($category->parent_id)
                                            <span class="">@lang('admin.menus.children')</span>
                                        @else
                                            <span class="">@lang('admin.menus.parent')</span>
                                        @endif

                                    </td>
                                    <td>{{ $category->createdAtVi }}</td>
                                    <td>{{ $category->updatedAtVi }}</td>

                                    <td class="flex gap-3">
                                        <a href="{{ route('admin.menus.edit', $category->id) }}"><x-heroicon-s-pencil-square
                                                class="size-4 text-green-600" /></a>
                                        <form id="delete-form-{{ $category->id }}"
                                            action="{{ route('admin.menus.destroy', ['menu' => $category->id]) }}"
                                            method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <button type="button" onclick="confirmDelete({{ $category->id }})">
                                                <x-heroicon-o-trash class="size-4 text-red-500" />
                                            </button>
                                        </form>

                                        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
                                        <script>
                                            $(document).ready(function() {
                                                setTimeout(function() {
                                                    $(".alert").fadeOut(2000);
                                                }, 3000); // thông báo sẽ ẩn sau 3 giây
                                            });

                                            function confirmDelete(categoryId) {
                                                if (confirm('Are you sure you want to delete this category?')) {
                                                    document.getElementById('delete-form-' + categoryId).submit();
                                                }
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
                       {{-- {{ $menus->links('pagination.web-tailwind') }} --}}
        </div>
    </div>
    {{-- @push('bottom_scripts')
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
        <script src="https://cdn.datatables.net/2.0.8/js/dataTables.js"></script>
        <script>
            $(document).ready(function() {
                $('#collapsible-button').click(function() {
                    console.log('click');
                    var content = document.getElementById('collapsible-content');
                    content.classList.toggle('hidden');
                });
            });

            $("#kt_customers_table").DataTable({
                serverSide: true,
                select: {
                    style: 'multi',
                    selector: 'td:first-child',
                    className: 'row-selected'
                },
                ajax: {
                    url: "{{ route('admin.menus.show', 'get-list') }}",
                    type: 'GET',
                },
                columns: [{
                        data: 'null',
                        orderable: false,
                        searchable: false,
                        render: function(data, type, row, meta) {
                            return meta.row + meta.settings._iDisplayStart + 1;
                        },
                    },
                    {
                        data: 'order',
                        render: function(data, type, row, meta) {
                            return data;
                        }
                    },
                    {

                        data: 'title',
                        render: function(data, type, row, meta) {
                            return data;
                        }
                    },
                    {
                        data: 'parent_id',
                        render: function(data, type, row, meta) {
                            return (data ? '@lang('admin.menus.children')' : '@lang('admin.menus.parent')');
                        }
                    },
                    {
                        data: 'created_at',
                        render: function(data, type, row, meta) {
                            return data;
                        }
                    },
                    {
                        data: 'updated_at',
                        render: function(data, type, row, meta) {
                            return data;
                        }
                    },
                    {
                        data: null,
                        className: 'text-end',
                        render: function(data, type, row, meta) {
                            return '<button id="collapsible-button" class="w-full px-4 py-2 text-left text-lg font-medium text-black bg-gray-200 rounded-t-lg focus:outline-none">' +
                                'Action' +
                                '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">' +
                                '<path d="M11.4343 12.7344L7.25 8.55005C6.83579 8.13583 6.16421 8.13584 5.75 8.55005C5.33579 8.96426 5.33579 9.63583 5.75 10.05L11.2929 15.5929C11.6834 15.9835 12.3166 15.9835 12.7071 15.5929L18.25 10.05C18.6642 9.63584 18.6642 8.96426 18.25 8.55005C17.8358 8.13584 17.1642 8.13584 16.75 8.55005L12.5657 12.7344C12.2533 13.0468 11.7467 13.0468 11.4343 12.7344Z" fill="black" />' +
                                '</svg>' +
                                '</button>' +
                                '<div id="collapsible-content" class="px-4 py-2 text-black bg-gray-100 rounded-b-lg hidden">' +
                                '<div class="menu-item px-3">' +
                                '<a href="" data-data="$ {JSON.stringify(row)}" class="menu-link px-3 btn-edit" data-bs-toggle="modal" data-bs-target="#kt_modal_add_customer">Sửa</a>' +
                                '</div>' +
                                '<div class="menu-item px-3">' +
                                '<a href="#" data-id="${row.id}" class="menu-link px-3 btn-delete" data-kt-customer-table-filter="delete_row">Xoá</a>' +
                                '</div>' +
                                '</div>';
                        }
                    }
                ]
            });
        </script>
    @endpush --}}
</x-app-layout>
