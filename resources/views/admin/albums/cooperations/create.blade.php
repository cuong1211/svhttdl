<x-app-layout>
    <div class="p-6">
        <div class="text-black text-normal font-semibold leading-tight">
            <span class="text-black text-normal flex items-center gap-2 font-semibold leading-tight">
                @lang('admin.cooperations.all')
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
                    <form action="{{ route('admin.cooperations.store') }}" method="POST" class="needs-validation"
                        novalidate enctype="multipart/form-data">
                        @csrf
                        <div class="space-y-4">
                            <label class="form-control w-full">
                                <div class="label" for="album_id">
                                    <span class="label-text text-base text-black font-medium">@lang('admin.album')</span>
                                </div>
                                <select name="album_id" required @class([
                                    'border',
                                    'border-gray-300',
                                    'bg-white',
                                    'text-black',
                                    'p-2',
                                    'rounded-md',
                                    'input-error' => $errors->has('album_id'),
                                    'w-full',
                                ])>
                                    <option value="">Select Album</option>
                                    @foreach ($albums as $album)
                                        <option value="{{ $album->id }}" @selected(old('album_id') == $album->id)>
                                            {{ $album->name }}
                                        </option>
                                    @endforeach
                                </select>
                            </label>
                            <label class="form-control w-full">
                                <div class="label">
                                    <span class="label-text text-base text-black font-medium">@lang('admin.post.title')</span>
                                </div>
                                <input type="text" name="name" placeholder="title cooperation..."
                                    @class([
                                        'border',
                                        'border-gray-300',
                                        'bg-white',
                                        'text-black',
                                        'p-2',
                                        'rounded-md',
                                        'input-error' => $errors->has('name'),
                                        'w-full',
                                    ]) value="{{ old('name') }}" />
                            </label>
                            <label class="form-control w-full">
                                <div class="label">
                                    <span class="label-text text-base text-black font-medium">@lang('admin.cooperations.link')</span>
                                </div>
                                <input type="text" name="link_website" placeholder="link website..."
                                    @class([
                                        'border',
                                        'border-gray-300',
                                        'bg-white',
                                        'text-black',
                                        'p-2',
                                        'rounded-md',
                                        'input-error' => $errors->has('link_website'),
                                        'w-full',
                                    ]) value="{{ old('link_website') }}" />
                            </label>
                            <label class="form-control w-full">
                                <div class="label">
                                    <span class="label-text text-base text-black font-medium">@lang('admin.description')</span>
                                </div>
                                <textarea name="description" id="description" class="hidden" column="description">
                                        {{ old('description') }}
                                    </textarea>
                            </label>

                            <div class="flex items-center space-x-6">
                                <label class="form-control">
                                    <div class="label" for="tags">
                                        <span class="label-text text-base text-black font-medium">Hình ảnh</span>
                                    </div>
                                    <span class="sr-only">Chọn ảnh đại diện</span>
                                    <input type="file" name="image" onchange="loadFile(event)"
                                        class="file:bg-violet-50 file:text-violet-700 hover:file:bg-violet-100 block w-full text-sm text-slate-500 file:mr-4 file:rounded-full file:border-0 file:px-4 file:py-2 file:text-sm file:font-semibold" />
                                </label>
                            </div>
                            <div class="shrink-0">
                                <img id="preview_img" class="h-40 w-72 object-cover rounded" src=""
                                    alt="" style="display:none" />
                            </div>

                        </div>
                        <div class="flex justify-end gap-4">
                            <a href="{{ route('admin.cooperations.index') }}" class="btn-light btn text-white">@lang('admin.btn.cancel')
                            </a>
                            <button type="submit" class="btn bg-blue-700 text-white ml-2 ">
                                @lang('admin.btn.submit')
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    @pushonce('bottom_scripts')
        <x-admin.forms.tinymce-config column="description" />
        <script>
            var loadFile = function(event) {
                document.getElementById('preview_img').style.display = 'block'
                var input = event.target
                var file = input.files[0]
                var type = file.type

                var output = document.getElementById('preview_img')
                const allowedExtensions = /(\.png|\.jpeg|\.jpg|\.gif)$/i;
                const maxFileSize = 5 * 1024 * 1024; // 5MB in bytes

                if (!allowedExtensions.exec(input.value)) {
                    alert('Vui lòng chọn tệp tin định dạng ảnh.');
                    input.value = '';
                    return false;
                }

                if (input.files[0].size > maxFileSize) {
                    alert('Tệp tin tải lên không được vượt quá 5MB.');
                    input.value = '';
                    return false;
                }
                output.src = URL.createObjectURL(event.target.files[0])
                output.onload = function() {
                    URL.revokeObjectURL(output.src) // free memory
                }
            }
        </script>
    @endpushonce
</x-app-layout>
