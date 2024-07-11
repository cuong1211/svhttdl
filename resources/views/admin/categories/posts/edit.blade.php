<x-app-layout>
    <div class="p-6">
        <div class="text-black text-normal font-semibold leading-tight">
            <span class="text-black text-normal flex items-center gap-2 font-semibold leading-tight">
                {{ app()->getLocale() === 'en' ? $selectedCategory->title_en : $selectedCategory->title }}
                <x-heroicon-m-arrow-small-right class="size-4" />
                @lang('admin.edit')
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
                <div class="bg-white p-4 shadow sm:rounded-lg sm:p-8">
                    <div class="space-y-4">
                        <form
                            action="{{ route('admin.categories.posts.update', ['category' => $categoryId, 'post' => $post->id]) }}"
                            method="POST" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')

                            <div class="space-y-4">
                                <div class="flex gap-4">
                                    <label class="form-control w-full">
                                        <div class="label">
                                            <span
                                                class="label-text text-base text-black font-medium">@lang('admin.post.title')</span>
                                        </div>
                                        <input type="text" name="title" placeholder="Nhập tên"
                                            @class([
                                                'border',
                                                'border-gray-300',
                                                'bg-white',
                                                'text-black',
                                                'p-2',
                                                'rounded-md',
                                                'w-full',
                                                'input-error' => $errors->has('title'),
                                            ]) value="{{ old('title', $post->title) }}" />
                                        @error('title')
                                            <div class="text-red-500 text-sm">{{ $message }}</div>
                                        @enderror
                                    </label>
                                    <x-admin.forms.calendar :publish_at="$post->published_at" />
                                </div>
                                <label class="form-control w-full">
                                    <div class="label">
                                        <span class="label-text text-base text-black font-medium">Tác giả</span>
                                    </div>
                                    <input type="text" name="author" placeholder="Nhập tác giả"
                                        value="{{ old('author', $post->author) }}" @class([
                                            'border',
                                            'border-gray-300',
                                            'bg-white',
                                            'text-black',
                                            'p-2',
                                            'rounded-md',
                                            'w-full',
                                            'input-error' => $errors->has('author'),
                                        ]) />
                                    @error('author')
                                        <div class="text-red-500 text-sm">{{ $message }}</div>
                                    @enderror
                                </label>
                                <label class="form-control w-full">
                                    <div class="label">
                                        <span class="label-text text-base text-black font-medium">Mô tả</span>
                                    </div>
                                    <textarea type="text" name="description" placeholder="Nhập tóm tắt"
                                        value="{{ old('description', $post->description) }}" @class([
                                            'border',
                                            'border-gray-300',
                                            'bg-white',
                                            'text-black',
                                            'p-2',
                                            'rounded-md',
                                            'w-full',
                                            'input-error' => $errors->has('description'),
                                        ])>
{{ $post->author }}
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
                                    <textarea name="content" id="content" class="form-input rounded-md shadow-sm mt-1 block w-full" rows="5">{{ old('content', $post->content) }}</textarea>
                                    @error('content')
                                        <div class="text-red-500 text-sm">{{ $message }}</div>
                                    @enderror
                                </label>
                                <label class="form-control w-full">
                                    <div class="label">
                                        <span
                                            class="label-text text-base text-black font-medium">@lang('admin.categories.parent')</span>
                                    </div>
                                    <select name="category_id" @class([
                                        'border',
                                        'border-gray-300',
                                        'bg-white',
                                        'text-black',
                                        'p-2',
                                        'rounded-md',
                                        'w-full',
                                    ])>
                                        <option value="">@lang('admin.categories.select_parent')</option>
                                        @foreach ($categories as $category)
                                            <x-admin.forms.select.category_post :category="$category" :selectedCategory="$selectedCategory" />
                                        @endforeach
                                    </select>
                                    @error('category_id')
                                        <div class="text-red-500 text-sm">{{ $message }}</div>
                                    @enderror
                                </label>
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
                                    @error('state')
                                        <div class="text-red-500 text-sm">{{ $message }}</div>
                                    @enderror
                                </label>
                                @foreach (App\Enums\PostTypeEnum::cases() as $type)
                                    <div class="flex items-center mb-4">
                                        <input id="{{ $type->value }}" type="checkbox" value="{{ $type->value }}"
                                            name="type" {{ $post->type == $type->value ? 'checked' : '' }}
                                            class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                                        <label for="{{ $type->value }}"
                                            class="ms-2 text-base font-medium text-black dark:text-gray-300">{{ $type->value == 0 ? 'Tin mới' : 'Tin hot' }}</label>
                                    </div>
                                @endforeach

                                <div class="flex items-center space-x-6">
                                    <label class="form-control w-full">
                                        <div class="label" for="tags">
                                            <span class="label-text text-base text-black font-medium">Hình ảnh</span>
                                        </div>
                                        <div
                                            class="input border border-gray-300 bg-white text-black p-2 rounded-md flex items-center gap-2 px-3 py-2">
                                            File:
                                            <span id="selected_file_name">
                                                @if ($post->getFirstMedia('featured_image'))
                                                    {{ $post->getFirstMedia('featured_image')->name }}
                                                @else
                                                @endif
                                            </span>
                                        </div>
                                        <span class="sr-only">Chọn hình ảnh</span>
                                        <input type="file" name="image" onchange="loadFile(event)"
                                            placeholder="Chọn"
                                            class="file:bg-violet-50 file:text-violet-700 hover:file:bg-violet-100 block w-full text-sm text-slate-500 file:mr-4 file:rounded-full file:border-0 file:px-4 file:py-2 file:text-sm file:font-semibold" />
                                    </label>
                                    </label>
                                    @error('image')
                                        <div class="text-red-500 text-sm">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="shrink-0">
                                    @if ($post->getFirstMedia('featured_image'))
                                        <img id="preview_img" class="h-32 w-64 object-cover rounded"
                                            src="{{ $post->getFirstMedia('featured_image')->getUrl('') }}"
                                            alt="{{ $post->getFirstMedia('featured_image')->name }}" />
                                    @else
                                        <img id="preview_img" class="h-32 w-64 object-cover rounded" src=""
                                            alt="" style="display:none" />
                                    @endif
                                </div>
                                <div class="flex justify-end gap-4">
                                    <a href="{{ route('admin.categories.posts.index', ['category' => $selectedCategory->id]) }}"
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
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@yaireo/tagify/dist/tagify.css" />
        <script src="https://cdn.jsdelivr.net/npm/@yaireo/tagify/dist/tagify.min.js"></script>

        <script>
            var loadFile = function(event) {
                var input = event.target
                var file = input.files[0]
                var type = file.type

                var output = document.getElementById('preview_img')

                output.src = URL.createObjectURL(event.target.files[0])
                output.onload = function() {
                    URL.revokeObjectURL(output.src) // free memory
                }
            }
        </script>
    @endpushonce
</x-app-layout>
