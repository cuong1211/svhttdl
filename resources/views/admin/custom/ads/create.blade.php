<x-app-layout>
    <div class="p-6">
        <div class="text-gray-800 text-normal font-semibold leading-tight">
            <span class="text-gray-800 text-normal flex items-center gap-2 font-semibold leading-tight">
                {{-- {{ app()->getLocale() === 'en' ? $category->title_en : $category->title }} --}}
                <x-heroicon-m-arrow-small-right class="size-4" />
                @lang('admin.add')
            </span>
        </div>

        <div class="mt-6">

            <div class="overflow-hidden bg-white shadow-sm sm:rounded-lg">
                @if ($errors->any())
                    <div class="alert alert-danger text-black">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                <div class="bg-white px-8 pb-8 pt-0 shadow sm:rounded-lg">
                    <div class="space-y-4">
                        <form action="{{ route('admin.ads.store') }}" method="POST" enctype="multipart/form-data">
                            @csrf

                            <div class="space-y-4">


                                <label class="form-control w-full">
                                    <div class="label">
                                        <span
                                            class="label-text text-base text-black font-medium">@lang('admin.post.title')</span>
                                    </div>
                                    <input type="text" name="title" placeholder="Nhập tiêu đề"
                                        value="{{ old('title') }}" @class([
                                            'border',
                                            'border-gray-300',
                                            'bg-white',
                                            'text-black',
                                            'p-2',
                                            'rounded-md',
                                            'input-error' => $errors->has('title'),
                                            'w-full',
                                        ]) />
                                    @if ($errors->has('title'))
                                        <div class="text-red-500 text-sm">{{ $errors->first('title') }}</div>
                                    @endif

                                </label>
                                <label class="form-control w-full">
                                    <div class="label">
                                        <span
                                            class="label-text text-base text-black font-medium">Đường dẫn</span>
                                    </div>
                                    <input type="text" name="url" placeholder="Nhập đường dẫn"
                                        value="{{ old('url') }}" @class([
                                            'border',
                                            'border-gray-300',
                                            'bg-white',
                                            'text-black',
                                            'p-2',
                                            'rounded-md',
                                            'input-error' => $errors->has('title'),
                                            'w-full',
                                        ]) />
                                    @if ($errors->has('title'))
                                        <div class="text-red-500 text-sm">{{ $errors->first('title') }}</div>
                                    @endif

                                </label>
                                <div class="flex items-center space-x-6">
                                    <label class="form-control w-full">
                                        <div class="label" for="tags">
                                            <span class="label-text text-base text-black font-medium">Hình ảnh</span>
                                        </div>
                                        <span class="sr-only">Chọn hình ảnh</span>
                                        <input type="file" name="image" onchange="loadFile(event)"
                                            class="file:bg-violet-50 file:text-violet-700 hover:file:bg-violet-100 block w-full text-sm text-slate-500 file:mr-4 file:rounded-full file:border-0 file:px-4 file:py-2 file:text-sm file:font-semibold" />
                                    </label>
                                </div>
                                <div class="shrink-0">
                                    <img id="preview_img" class="h-32 w-64 object-cover rounded" src=""
                                        alt="" />
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
