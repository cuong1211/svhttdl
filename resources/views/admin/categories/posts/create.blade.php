<x-app-layout>
    <div class="p-6">
        <div class="text-black text-normal font-semibold leading-tight">
            <span class="text-black text-normal flex items-center gap-2 font-semibold leading-tight">
                {{ app()->getLocale() === 'en' ? $category->title_en : $category->title }}
                <x-heroicon-m-arrow-small-right class="size-4" />
                @lang('admin.add')
            </span>
        </div>

        <div class="mt-6">

            <div class="overflow-hidden bg-white shadow-sm sm:rounded-lg">
                @if ($errors->any())
                    <div class="alert alert-error text-black">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                <div class="bg-white px-8 pb-8 pt-0 shadow sm:rounded-lg">
                    <div class="space-y-4">
                        <form action="{{ route('admin.categories.posts.store', $category->id) }}" method="POST"
                            enctype="multipart/form-data">
                            @csrf

                            <div class="space-y-4">
                                @if (Auth::user()->category_id == 3)
                                    <input type="hidden" name="category_id" value="{{ $category->id }}">
                                @endif
                                <div class="join join-vertical lg:join-horizontal gap-4 w-full">
                                    <label class="join-item form-control w-full">
                                        <div class="label">
                                            <span class="label-text text-base text-black font-medium">
                                                @lang('admin.post.title')
                                            </span>
                                        </div>
                                        <input type="text" name="title" placeholder="Nhập tiêu đề bài viết..."
                                            value="{{ old('title') }}"
                                            class="border border-gray-300 bg-white text-black p-2 rounded-md w-full @error('title') input-error @enderror" />
                                        @error('title')
                                            <div class="text-red-500 text-sm">{{ $message }}</div>
                                        @enderror
                                    </label>
                                    <div class="join-item w-auto">
                                        <x-admin.forms.calendar />
                                    </div>
                                </div>
                                <label class="form-control w-full">
                                    <div class="label">
                                        <span class="label-text text-base text-black font-medium">
                                            Tác giả
                                        </span>
                                    </div>
                                    <input type="text" name="author" placeholder="Nhập tác giả."
                                        value="{{ old('author') }}"
                                        class="border border-gray-300 bg-white text-black p-2 rounded-md w-full @error('author') input-error @enderror" />
                                    @error('author')
                                        <div class="text-red-500 text-sm">{{ $message }}</div>
                                    @enderror
                                </label>
                                <label class="form-control w-full">
                                    <div class="label">
                                        <span class="label-text text-base text-black font-medium">
                                            Tóm tắt
                                        </span>
                                    </div>
                                    <textarea type="text" name="description" placeholder="Nhập tóm tắt bài viết..." value="{{ old('description') }}"
                                        class="border border-gray-300 bg-white text-black p-2 rounded-md w-full @error('description') input-error @enderror">
</textarea>
                                    @error('description')
                                        <div class="text-red-500 text-sm">{{ $message }}</div>
                                    @enderror
                                </label>

                                <label class="form-control w-full">
                                    <div class="label">
                                        <span
                                            class="label-text text-base text-black font-medium">@lang('admin.content')</span>
                                    </div>
                                    <textarea name="content" id="content" class="form-input rounded-md shadow-sm mt-1 block w-full" rows="5"
                                        @error('content') input-error @enderror>{{ old('content') }}</textarea>
                                    @error('content')
                                        <div class="text-red-500 text-sm">{{ $message }}</div>
                                    @enderror
                                </label>
                                @if (Auth::user()->category_id == 3)
                                @else
                                    <label class="form-control w-full">
                                        <div class="label">
                                            <span class="label-text text-base text-black font-medium">Chọn danh
                                                mục</span>
                                        </div>
                                        <select name="category_id" @class([
                                            'border',
                                            'border-gray-300',
                                            'bg-white',
                                            'text-black',
                                            'p-2',
                                            'rounded-md',
                                            'input-error' => $errors->has('category_id'),
                                            'w-full',
                                        ])>
                                            <option value="">@lang('admin.categories.select_parent')</option>
                                            @foreach ($categories as $category)
                                                <x-admin.forms.select.category :category="$category" />
                                            @endforeach

                                        </select>
                                        @error('category_id')
                                            <div class="text-red-500 text-sm">{{ $message }}</div>
                                        @enderror
                                    </label>
                                @endif
                                <label class="form-control w-full">
                                    <div class="label">
                                        <span class="label-text text-base text-black font-medium">Trạng thái</span>
                                    </div>
                                    <select name="state" @class([
                                        'border',
                                        'border-gray-300',
                                        'bg-white',
                                        'text-black',
                                        'p-2',
                                        'rounded-md',
                                        'w-full',
                                    ])>
                                        <option value="0">Ẩn</option>
                                        <option value="1">Hiển thị</option>

                                    </select>
                                </label>
                                <label class="form-control w-full">
                                    <div class="label" for="tags">
                                        <span class="label-text text-base text-black font-medium">Bài
                                            viết thuộc các nhóm tin</span>
                                    </div>
                                    @foreach (App\Enums\PostTypeEnum::cases() as $type)
                                        <div class="flex items-center mb-4">
                                            <input id="{{ $type->value }}" type="radio" name="type"
                                                value="{{ $type->value }}"
                                                {{ $type->value === '0' ? 'checked' : '' }}
                                                class="w-4 h-4 text-blue-700 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                                            <label for="{{ $type->value }}"
                                                class="ms-2  text-black dark:text-gray-300 text-base">{{ $type->value == 0 ? 'Tin mới' : 'Tin hot' }}</label>
                                        </div>
                                    @endforeach

                                </label>
                                <div class="flex items-center space-x-6">
                                    <label class="form-control w-full">
                                        <div class="label" for="tags">
                                            <span class="label-text text-base text-black font-medium">Thumbnail</span>
                                        </div>
                                        <span class="sr-only">Chọn hình ảnh</span>
                                        <input type="file" name="image" onchange="loadFile(event)"
                                            class="file:bg-violet-50 file:text-violet-700 hover:file:bg-violet-100 block w-full text-sm text-slate-500 file:mr-4 file:rounded-full file:border-0 file:px-4 file:py-2 file:text-sm file:font-semibold" />
                                    </label>
                                </div>
                                <div class="shrink-0">
                                    <img id="preview_img" class="h-40 w-72 object-cover rounded" src=""
                                        alt="" style="display:none" />
                                </div>

                                <div class="flex justify-end gap-4">
                                    <a href="{{ route('admin.categories.posts.index', ['category' => $categoryId]+ request()->query()) }}"
                                        class="btn-light btn text-white">@lang('admin.btn.cancel')</a>
                                    <button type="submit" class="btn bg-blue-700 text-white ml-2">
                                        @lang('admin.btn.submit')
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @pushonce('bottom_scripts')
        <x-admin.forms.tinymce-config column="content" />
       
        <script>
            var loadFile = function(event) {
                document.getElementById('preview_img').style.display = 'block'
                var input = event.target
                var file = input.files[0]
                var type = file.type

                var output = document.getElementById('preview_img')
                const allowedExtensions = /(\.png|\.jpeg|\.jpg)$/i;
                const maxFileSize = 5 * 1024 * 1024; // 5MB in bytes

                if (!allowedExtensions.exec(input.value)) {
                    Swal.fire({
                        icon: "error",
                        title: "Oops...",
                        text: "Chỉ chấp nhận tệp tin PNG, JPEG, JPG .",
                    });
                    input.value = '';
                    return false;
                }

                if (input.files[0].size > maxFileSize) {
                    Swal.fire({
                        icon: "error",
                        title: "Oops...",
                        text: "Dung lượng tệp tin không được vượt quá 5MB.",
                    });
                    input.value = '';
                    return false;
                }
                output.src = URL.createObjectURL(event.target.files[0])
                output.onload = function() {
                    URL.revokeObjectURL(output.src)
                }
            }
        </script>
    @endpushonce
</x-app-layout>
