<x-app-layout>
    <div class="p-6">
        <div class="text-black text-normal font-semibold leading-tight">
            <span class="text-black text-normal flex items-center gap-2 font-semibold leading-tight">
                {{-- {{ app()->getLocale() === 'en' ? $category->title_en : $category->title }} --}}
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
                        <form action="{{ route('admin.addons.store') }}" method="POST" enctype="multipart/form-data">
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
                                        <span class="label-text text-base text-black font-medium">Đường dẫn</span>
                                    </div>
                                    <input type="text" name="url" placeholder="Nhập đường dẫn"
                                        value="{{ old('url') }}" @class([
                                            'border',
                                            'border-gray-300',
                                            'bg-white',
                                            'text-black',
                                            'p-2',
                                            'rounded-md',
                                            'input-error' => $errors->has('url'),
                                            'w-full',
                                        ]) />
                                    @if ($errors->has('url'))
                                        <div class="text-red-500 text-sm">{{ $errors->first('url') }}</div>
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
                                    <img id="preview_img" class="h-14 w-71 object-cover rounded" src=""
                                        alt="" style="display: none" />
                                </div>

                                <div class="flex justify-end gap-4">
                                    <a href="{{ route('admin.banners.index') }}"
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
