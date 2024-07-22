<x-app-layout>
    <style>
        input:focus {
            outline: none !important;
        }
    </style>
    <div class="p-6">
        <div class="flex justify-between">
            <div class="text-black text-lg font-semibold leading-tight ">
                <span class="text-black text-lg flex items-center gap-2 font-semibold leading-tight">
                    {{ app()->getLocale() === 'en' ? $category->title_en : $category->title }}
                </span>
            </div>
            <a class="bg-blue-700 btn border-blue-500 "
                href="{{ route('admin.categories.posts.create', ['category' => $category]) }}">
                <x-heroicon-s-plus class="size-4 text-white" />
                <span class="text-white">@lang('admin.add')</span>
            </a>
        </div>
        @if (session('icon') && session('heading') && session('message'))
            <div role="alert" class="alert alert-success" id="successAlert">
                <svg xmlns="http://www.w3.org/2000/svg" class="stroke-current shrink-0 h-6 w-6 fill-white"
                    viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                </svg>
                <span>{{ session('message') }}</span>
            </div>
        @endif
        <div class="mt-6">
            <div class="overflow-hidden bg-white shadow-sm sm:rounded-lg">
                <div class="flex px-6 py-4">
                    <form action="{{ route('admin.categories.posts.index', $category->id) }}" method="GET"
                        class="w-full">
                        <div class="items-center">
                            <ul class="menu md:menu-horizontal rounded-box bg-white gap-1">
                                <li>
                                    <label
                                        class="input border border-gray-300 bg-white text-gray-900 p-2 rounded-md items-center gap-2 flex w-auto md:w-full "
                                        style="border: 1px solid black;">
                                        <input name="search" type="text"
                                            class="grow placeholder-black font-semibold"
                                            placeholder="Tìm kiếm theo tiêu đề" style="border: unset; color:black"
                                            value="{{ request()->search }}" />
                                    </label>
                                </li>
                                @if (Auth::user()->category_id == 3)
                                @else
                                    <li>
                                        <select id="categoryFilter" name="categoryFilter"
                                            class=" select select-bordered w-full bg-white text-black font-semibold"
                                            style="border: 1px solid black;">
                                            <option value="">Tất cả</option>
                                            @foreach ($filter_cate as $filter)
                                                <option value="{{ $filter->id }}"
                                                    {{ $request->categoryFilter == $filter->id ? 'selected' : '' }}>
                                                    {{ $filter->title }}</option>
                                            @endforeach
                                        </select>
                                    </li>

                                    <li>
                                        <select id="categoryFilter1" name="categoryFilter1"
                                            class="select select-bordered w-full bg-white text-black font-semibold"
                                            style="border: 1px solid black; display: {{ $request->categoryFilter == null || $request->categoryFilter1 == null ? 'none' : 'block' }}">
                                            <option value="">Tất cả</option>
                                            @foreach ($filter_child_cate as $filter1)
                                                <option value="{{ $filter1->id }}"
                                                    {{ $request->categoryFilter1 == $filter1->id ? 'selected' : '' }}>
                                                    {{ $filter1->title }}</option>
                                            @endforeach
                                        </select>
                                    </li>

                                @endif
                                <li>
                                    <button type="submit" class="btn bg-blue-700  ">
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
                    <table class="table text-black text-base text-center">
                        <!-- head -->
                        <thead class="text-black text-base">
                            <tr>
                                <th class="text-center font-semibold">#</th>
                                <th class="text-center font-semibold">ID</th>
                                <th class="text-left font-semibold">@lang('admin.post.title')</th>
                                <th class="text-left font-semibold">Bài viết thuộc</th>
                                <th class="text-center font-semibold">@lang('admin.post.published_at')</th>
                                {{-- ngày đăng --}}
                                <th>@lang('admin.post.updated_at')</th>
                                {{-- ngày cập nhật --}}
                                <th>@lang('admin.funtion')</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($posts as $post)
                                <tr>
                                    <th class="text-center">{{ $posts->firstItem() + $loop->index }}</th>
                                    <td class="text-center">{{ $post->id }}</td>
                                    <td class="text-left">{{ $post->title }}</td>
                                    <td class="text-left">{{ $post->category->parent->title }} /
                                        {{ $post->category->title }}</td>
                                    <td class="text-center">{{ $post->publishedAtVi }}</td>
                                    <td class="text-center">{{ $post->updatedAtVi }}</td>

                                    <td class="flex gap-3 items-center justify-center">
                                        <a
                                            href="{{ route('admin.categories.posts.edit', ['category' => $category->id, 'post' => $post->id]) }}">
                                            <x-heroicon-s-pencil-square class="size-4 text-green-600" />
                                        </a>
                                        <form id="delete-form-{{ $post->id }}"
                                            action="{{ route('admin.categories.posts.destroy', ['category' => $category->id, 'post' => $post->id]) }}"
                                            method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <button type="button" onclick="confirmDelete({{ $post->id }})">
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

                                            function confirmDelete(postId) {
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
                                                        $('#delete-form-' + postId).submit();
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
            {{ $posts->links('pagination.web-tailwind') }}
        </div>
    </div>
    @push('bottom_scripts')
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
        <script>
            $('#categoryFilter').on('change', function(e) {
                if ($(this).val() == '') {
                    $('#categoryFilter1').empty();
                    $('#categoryFilter1').hide();
                }
                e.preventDefault();
                let type = 'GET',
                    id = $(this).val(),
                    url = "{{ route('admin.categories.posts.getCate', '') }}" + '/' + id;
                $.ajax({
                    url: url,
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    type: type,
                    success: function(data) {
                        if (data.length == 0) {
                            $('#categoryFilter1').hide();
                        } else {
                            $('#categoryFilter1').empty();
                            $('#categoryFilter1').append('<option value="">Tất cả</option>');
                            for (let i = 0; i < data.length; i++) {
                                $('#categoryFilter1').append('<option value="' + data[i].id + '">' + data[i]
                                    .title +
                                    '</option>');
                            }
                            $('#categoryFilter1').show();
                        }
                    },
                    error: function(data) {}
                });
            });
        </script>
    @endpush
</x-app-layout>
