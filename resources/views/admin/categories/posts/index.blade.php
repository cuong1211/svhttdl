<x-app-layout>
    <!-- CSS -->
    @push('styles')
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
        <link rel="stylesheet" type="text/css" href="https://npmcdn.com/flatpickr/dist/themes/material_blue.css">
        <style>
            input:focus {
                outline: none !important;
            }

            .table-wrapper {
                scrollbar-width: thin;
            }

            .table-wrapper::-webkit-scrollbar {
                height: 8px;
            }

            .table-wrapper::-webkit-scrollbar-track {
                background: #f1f1f1;
            }

            .table-wrapper::-webkit-scrollbar-thumb {
                background: #2563eb;
                border-radius: 4px;
            }

            .custom-shadow {
                box-shadow: 0 0 15px rgba(37, 99, 235, 0.1);
            }
        </style>
    @endpush

    <!-- Page Container -->
    <div class="p-6 bg-blue-50/30 min-h-screen">
        <!-- Header Section -->
        <div class="mb-6">
            <div class="flex justify-between items-center">
                <h1 class="text-2xl font-bold text-blue-900">
                    {{ app()->getLocale() === 'en' ? $category->title_en : $category->title }}
                </h1>
                <div class="flex gap-3">
                    <a href="{{ route('admin.categories.posts.export', ['category' => $category->id] + request()->query()) }}"
                        class="btn bg-green-600 text-white gap-2 hover:bg-green-700 transition-colors" style="background-color: #2563eb">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                            stroke="currentColor" class="w-5 h-5">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M3 16.5v2.25A2.25 2.25 0 0 0 5.25 21h13.5A2.25 2.25 0 0 0 21 18.75V16.5m-13.5-9L12 3m0 0 4.5 4.5M12 3v13.5" />
                        </svg>
                        <span>Xuất Excel</span>
                    </a>
                    <a href="{{ route('admin.categories.posts.create', ['category' => $category] + request()->query()) }}"
                        class="btn bg-blue-600 text-white gap-2 hover:bg-blue-700 transition-colors" style="background-color: #2563eb">
                        <x-heroicon-s-plus class="size-4" />
                        <span>@lang('admin.add')</span>
                    </a>
                </div>
            </div>

            <!-- Alert Messages -->
            @if (session('icon') && session('heading') && session('message'))
                <div role="alert" class="alert bg-blue-50 border-l-4 border-blue-500 p-4 mt-4 animate-fadeIn"
                    id="successAlert">
                    <div class="flex items-center gap-2">
                        <svg xmlns="http://www.w3.org/2000/svg" class="stroke-current shrink-0 h-6 w-6 text-blue-500"
                            fill="none" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                        <span class="font-medium text-blue-800">{{ session('message') }}</span>
                    </div>
                </div>
            @endif
        </div>

        <!-- Main Content -->
        <div class="bg-white rounded-xl custom-shadow border border-blue-100">
            <!-- Search and Filter Section -->
            <div class="p-6 border-b border-blue-100">
                <form action="{{ route('admin.categories.posts.index', $category->id) }}" method="GET"
                    class="space-y-4">
                    <div class="flex flex-wrap gap-4">
                        <!-- Date Filter Button -->
                        <button type="button" onclick="document.getElementById('date-filter-modal').showModal()"
                            class="btn bg-blue-700 text-white">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                stroke-width="1.5" stroke="currentColor" class="w-4 h-4">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M6.75 3v2.25M17.25 3v2.25M3 18.75V7.5a2.25 2.25 0 0 1 2.25-2.25h13.5A2.25 2.25 0 0 1 21 7.5v11.25m-18 0A2.25 2.25 0 0 0 5.25 21h13.5A2.25 2.25 0 0 0 21 18.75m-18 0v-7.5A2.25 2.25 0 0 1 5.25 9h13.5A2.25 2.25 0 0 1 21 11.25v7.5" />
                            </svg>
                        </button>


                        <!-- Search Input -->
                        <div class="flex-grow">
                            <input type="text" name="search" placeholder="Tìm kiếm theo tiêu đề"
                                value="{{ request()->search }}"
                                class="w-full px-4 py-2 border border-gray-300 rounded-md focus:border-blue-500
                                    focus:ring focus:ring-blue-200 transition-all">
                        </div>

                        <!-- Category Filters -->
                        @if (Auth::user()->category_id != 3)
                            <div class="flex gap-4">
                                <select id="categoryFilter" name="categoryFilter"
                                    class="select select-bordered w-48 min-w-[12rem]">
                                    <option value="">Tất cả danh mục</option>
                                    @foreach ($filter_cate as $filter)
                                        <option value="{{ $filter->id }}"
                                            {{ request()->categoryFilter == $filter->id ? 'selected' : '' }}>
                                            {{ $filter->title }}
                                        </option>
                                    @endforeach
                                </select>

                                <select id="categoryFilter1" name="categoryFilter1"
                                    class="select select-bordered w-48 min-w-[12rem]"
                                    style="display: {{ request()->categoryFilter ? 'block' : 'none' }}">
                                    <option value="">Tất cả danh mục con</option>
                                    @foreach ($filter_child_cate as $filter1)
                                        <option value="{{ $filter1->id }}"
                                            {{ request()->categoryFilter1 == $filter1->id ? 'selected' : '' }}>
                                            {{ $filter1->title }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        @endif

                        <!-- Search Button -->
                        <button type="submit" class="btn bg-blue-700 hover:bg-blue-800 text-white">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24"
                                stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                            </svg>
                        </button>
                    </div>
                </form>
            </div>

            <!-- Posts Table -->
            <div class="table-wrapper overflow-x-auto">
                <table class="w-full text-base">
                    <!-- Table Header -->
                    <thead>
                        <tr class="bg-blue-50 border-y border-blue-100">
                            <th class="px-6 py-4 font-semibold text-center text-blue-900">#</th>
                            <th class="px-6 py-4 font-semibold text-center text-blue-900">ID</th>
                            <th class="px-6 py-4 font-semibold text-left text-blue-900">@lang('admin.post.title')</th>
                            <th class="px-6 py-4 font-semibold text-center text-blue-900">Tác giả</th>
                            <th class="px-6 py-4 font-semibold text-left text-blue-900">Bài viết thuộc</th>
                            <th class="px-6 py-4 font-semibold text-center text-blue-900">@lang('admin.post.published_at')</th>
                            <th class="px-6 py-4 font-semibold text-center text-blue-900">@lang('admin.post.updated_at')</th>
                            <th class="px-6 py-4 font-semibold text-center text-blue-900">@lang('admin.funtion')</th>
                        </tr>
                    </thead>

                    <!-- Table Body -->
                    <tbody class="divide-y divide-blue-50">
                        @foreach ($posts as $post)
                            <tr class="hover:bg-blue-50/50 transition-colors duration-150">
                                <td class="px-6 py-4 text-center text-blue-900">
                                    {{ $posts->firstItem() + $loop->index }}</td>
                                <td class="px-6 py-4 text-center text-blue-900">{{ $post->id }}</td>
                                <td class="px-6 py-4 text-left font-medium text-blue-900">{{ $post->title }}</td>
                                <td class="px-6 py-4 text-center text-blue-900">{{ $post->author }}</td>
                                <td class="px-6 py-4 text-left">
                                    <span class="text-blue-800">{{ $post->category->parent->title }}</span>
                                    <span class="text-blue-300 mx-1">/</span>
                                    <span class="text-blue-600">{{ $post->category->title }}</span>
                                </td>
                                <td class="px-6 py-4 text-center whitespace-nowrap text-blue-900">
                                    {{ $post->publishedAtVi }}</td>
                                <td class="px-6 py-4 text-center whitespace-nowrap text-blue-900">
                                    {{ $post->updatedAtVi }}</td>
                                <td class="px-6 py-4">
                                    <div class="flex items-center justify-center gap-3">
                                        <a href="{{ route('admin.categories.posts.edit', ['category' => $category->id, 'post' => $post->id] + request()->query()) }}"
                                            class="text-blue-600 hover:text-blue-800 transition-colors">
                                            <x-heroicon-s-pencil-square class="size-5" />
                                        </a>
                                        <form id="delete-form-{{ $post->id }}"
                                            action="{{ route('admin.categories.posts.destroy', ['category' => $category->id, 'post' => $post->id]) }}"
                                            method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <button type="button" onclick="confirmDelete({{ $post->id }})"
                                                class="text-red-500 hover:text-red-600 transition-colors">
                                                <x-heroicon-o-trash class="size-5" />
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <!-- Pagination -->
            <div class="p-6 border-t border-blue-100">
                {{ $posts->links('pagination.web-tailwind') }}
            </div>
        </div>

        <!-- Date Filter Modal -->
        <dialog id="date-filter-modal" class="modal">
            <div class="modal-box bg-white p-0 max-w-xl">
                <div class="bg-blue-600 text-base px-6 py-4 rounded-t-lg flex justify-between items-center">
                    <h3 class="font-bold text-lg">Lọc theo khoảng thời gian</h3>
                    <form method="dialog">
                        <button class="btn btn-sm btn-circle btn-ghost text-white hover:bg-blue-700">✕</button>
                    </form>
                </div>

                <div class="p-6">
                    <form id="dateFilterForm" action="{{ route('admin.categories.posts.index', $category->id) }}"
                        method="GET">
                        @if (request()->has('search'))
                            <input type="hidden" name="search" value="{{ request('search') }}">
                        @endif
                        @if (request()->has('categoryFilter'))
                            <input type="hidden" name="categoryFilter" value="{{ request('categoryFilter') }}">
                        @endif
                        @if (request()->has('categoryFilter1'))
                            <input type="hidden" name="categoryFilter1" value="{{ request('categoryFilter1') }}">
                        @endif

                        <div class="space-y-6">
                            <div class="form-control">
                                <label class="label">
                                    <span class="label-text text-gray-700 font-medium flex items-center gap-2">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-blue-600"
                                            fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                        </svg>
                                        Từ ngày
                                    </span>
                                </label>
                                <input type="date" id="from_date" name="from_date" onchange="formatDate(this)"
                                    class="input input-bordered bg-white text-gray-800 border-gray-300 w-full focus:border-blue-500">

                            </div>

                            <div class="form-control mt-4">
                                <label class="label">
                                    <span class="label-text text-gray-700 font-medium flex items-center gap-2">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-blue-600"
                                            fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                        </svg>
                                        Đến ngày
                                    </span>
                                </label>
                                <input type="date" id="to_date" name="to_date" onchange="formatDate(this)"
                                    class="input input-bordered bg-white text-gray-800 border-gray-300 w-full focus:border-blue-500">

                            </div>

                            <!-- Action Buttons -->
                            <div class="flex justify-end gap-3 pt-4 border-t">
                                <button type="button" onclick="resetForm()"
                                    class="btn bg-gray-100 text-gray-600 hover:bg-gray-200 gap-2">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                        stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="M16.023 9.348h4.992v-.001M2.985 19.644v-4.992m0 0h4.992m-4.993 0 3.181 3.183a8.25 8.25 0 0 0 13.803-3.7M4.031 9.865a8.25 8.25 0 0 1 13.803-3.7l3.181 3.182m0-4.991v4.99" />
                                    </svg>
                                    Làm mới
                                </button>
                                <button type="button" class="btn btn-ghost text-gray-600 hover:bg-gray-100" style="border: 1px solid #d1d5db"
                                    onclick="document.getElementById('date-filter-modal').close()">
                                    Hủy bỏ
                                </button>
                                <button type="submit" class="btn bg-blue-600 hover:bg-blue-700 text-white gap-2" style="background-color: #2563eb">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none"
                                        viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M3 4a1 1 0 011-1h16a1 1 0 011 1v2.586a1 1 0 01-.293.707l-6.414 6.414a1 1 0 00-.293.707V17l-4 4v-6.586a1 1 0 00-.293-.707L3.293 7.293A1 1 0 013 6.586V4z" />
                                    </svg>
                                    Áp dụng
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            <form method="dialog" class="modal-backdrop">
                <button>close</button>
            </form>
        </dialog>
    </div>

    @push('bottom_scripts')
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>

        <script>
            // Define functions globally
            window.formatDate = function(input) {
                const value = input.value;

                if (!value) return;

                const date = new Date(value);
                validateDateRange();
            };

            window.resetForm = function() {
                document.getElementById('from_date').value = '';
                document.getElementById('to_date').value = '';
            };

            window.validateDateRange = function() {
                const fromDate = document.getElementById('from_date');
                const toDate = document.getElementById('to_date');

                if (fromDate.value && toDate.value) {
                    const from = new Date(fromDate.value);
                    const to = new Date(toDate.value);

                    if (from > to) {
                        alert('Ngày bắt đầu không thể lớn hơn ngày kết thúc');
                        toDate.value = '';
                    }
                }
            };

            document.addEventListener('DOMContentLoaded', function() {
                // Xử lý modal

                // Xử lý thông báo thành công
                const successAlert = document.getElementById('successAlert');
                if (successAlert) {
                    setTimeout(() => {
                        successAlert.style.opacity = '0';
                        setTimeout(() => successAlert.remove(), 500);
                    }, 3000);
                }

                // Xử lý filter danh mục
                $('#categoryFilter').on('change', function() {
                    const $subcategoryFilter = $('#categoryFilter1');

                    if (this.value === '') {
                        $subcategoryFilter.empty().hide();
                        return;
                    }

                    $.ajax({
                        url: "{{ route('admin.categories.posts.getCate', '') }}/" + this.value,
                        type: 'GET',
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        success: function(data) {
                            if (data.length === 0) {
                                $subcategoryFilter.hide();
                                return;
                            }

                            $subcategoryFilter
                                .empty()
                                .append('<option value="">Tất cả danh mục con</option>')
                                .append(data.map(item =>
                                    `<option value="${item.id}">${item.title}</option>`
                                ).join(''))
                                .show();
                        }
                    });
                });
            });

            // Xác nhận xóa
            function confirmDelete(postId) {
                Swal.fire({
                    title: 'Xác nhận xóa',
                    text: 'Dữ liệu bị xóa sẽ không thể khôi phục lại được!',
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#2563eb',
                    cancelButtonColor: '#6B7280',
                    confirmButtonText: 'Xác nhận',
                    cancelButtonText: 'Hủy',
                }).then((result) => {
                    if (result.isConfirmed) {
                        document.getElementById(`delete-form-${postId}`).submit();
                    }
                });
            }
        </script>
    @endpush
</x-app-layout>
