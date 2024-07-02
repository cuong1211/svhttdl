<x-app-layout>
    <div class="p-6">
        <div class="text-gray-800 text-normal font-semibold leading-tight">
            <span class="text-gray-800 text-normal flex items-center gap-2 font-semibold leading-tight">
                {{-- {{ app()->getLocale() === 'en' ? $category->title_en : $category->title }} --}}
                <x-heroicon-m-arrow-small-right class="size-4" />
                @lang('admin.edit')
            </span>
        </div>
        <div class="mt-6">
            <div class="overflow-hidden bg-white shadow-sm sm:rounded-lg">
                <div class="bg-white p-4 shadow sm:rounded-lg sm:p-8">
                    <div class="space-y-4">
                        <form action="{{ route('admin.banners.update', ['banner' => $banner->id]) }}" method="POST"
                            enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            <div class="space-y-4">

                                <label class="form-control w-full">
                                    <div class="label">
                                        <span
                                            class="label-text text-base text-black font-medium">@lang('admin.post.title')</span>
                                    </div>
                                    <input type="text" name="title" placeholder="Nhập tên"
                                        value="{{ old('title', $banner->title) }}" @class([
                                            'border',
                                            'border-gray-300',
                                            'bg-white',
                                            'text-black',
                                            'p-2',
                                            'rounded-md',
                                            'w-full',
                                            'input-error' => $errors->has('title'),
                                        ]) />
                                </label>
                                <label class="form-control w-full">
                                    <div class="label">
                                        <span
                                            class="label-text text-base text-black font-medium">@lang('admin.categories.in_menu')</span>
                                    </div>
                                    <select name="is_active" @class([
                                        'border',
                                        'border-gray-300',
                                        'bg-white',
                                        'text-black',
                                        'p-2',
                                        'rounded-md',
                                        'w-full',
                                    ])>
                                        <option @selected(old('in_menu') == 0) value="0">@lang('admin.false')</option>
                                        <option @selected(old('in_menu') == 1) value="1">@lang('admin.true')</option>
                                    </select>
                                </label>
                                <label class="form-control w-full">
                                    <div class="label">
                                        <span class="label-text  text-base text-black font-medium">Vị trí banner </span>
                                    </div>

                                    <div class="flex items-center mb-4">
                                        <input id="default-radio-1" type="radio" value="1" name="position"
                                            class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                                        <label for="default-radio-1"
                                            class="ms-2  text-black dark:text-gray-300 text-base">Đầu trang</label>
                                    </div>
                                    <div class="flex items-center">
                                        <input checked id="default-radio-2" type="radio" value="2"
                                            name="position"
                                            class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                                        <label for="default-radio-2"
                                            class="ms-2  text-black dark:text-gray-300 text-base">Giữa Trang</label>
                                    </div>

                                </label>

                                <div class="flex items-center space-x-6">
                                    <label class="form-control w-full">
                                        <div class="label" for="tags">
                                            <span class="label-text text-base text-black font-medium">Thumbnail</span>
                                        </div>
                                        <div
                                            class="input border border-gray-300 bg-white text-black p-2 rounded-md flex items-center gap-2 px-3 py-2">
                                            File:
                                            <span
                                                id="selected_file_name">{{ $banner->getFirstMedia('banner_image')->name }}</span>
                                        </div>
                                        <span class="sr-only">Chọn hình ảnh</span>
                                        <input type="file" name="image" onchange="loadFile(event)"
                                            class="file:bg-violet-50 file:text-violet-700 hover:file:bg-violet-100 block w-full text-sm text-slate-500 file:mr-4 file:rounded-full file:border-0 file:px-4 file:py-2 file:text-sm file:font-semibold" />
                                    </label>
                                    </label>
                                </div>
                                <div class="shrink-0">
                                    <img id="preview_img" class="h-32 w-64 object-cover rounded"
                                        src="{{ $banner->getFirstMedia('banner_image')->getUrl('') }}"
                                        alt="{{ $banner->getFirstMedia('banner_image')->name }}" />
                                </div>
                                <div class="flex justify-end gap-4">
                                    <a href="{{ route('admin.banners.index') }}"
                                        class="btn-light btn text-white">@lang('admin.btn.cancel')</a>
                                    <button type="submit" class="btn btn-success ml-2">
                                        @lang('admin.btn.submit')
                                    </button>
                                </div>
                            </div>
                        </form>
                        @if ($errors->any())
                            <div class="alert alert-danger">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif
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
