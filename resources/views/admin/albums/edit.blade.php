<x-app-layout>
    <div class="p-6">
        <div class="text-gray-800 text-normal font-semibold leading-tight">
            <span class="text-gray-800 text-normal flex items-center gap-2 font-semibold leading-tight">
                @lang('admin.album')
                <x-heroicon-m-arrow-small-right class="size-4" />
                @lang('admin.edit')
            </span>
        </div>
        <div class="mt-6">
            <div class="overflow-hidden bg-white p-6 sm:rounded-lg">
                <form action="{{ route('admin.albums.update', ['album' => $album->id]) }}" method="POST"
                    class="space-y-4 needs-validation" novalidate>
                    @csrf
                    @method('patch')
                    <label class="form-control w-full">
                        <div class="label">
                            <span class="label-text text-base text-black font-medium">@lang('admin.albums.name')</span>
                        </div>
                        <input type="text" name="name" placeholder="Nhập tên"
                            value="{{ old('name', $album->name) }}" @class([
                                'border',
                                'border-gray-300',
                                'bg-white',
                                'text-black',
                                'p-2',
                                'rounded-md',
                                'input-error' => $errors->has('name'),
                                'w-full',
                            ]) />
                    </label>
                    <label class="form-control w-full">
                        <div class="label">
                            <span class="label-text text-base text-black font-medium">@lang('admin.albums.type')</span>
                        </div>
                        <select name="type" required @class([
                            'input',
                            'input-bordered',
                            'input-error' => $errors->has('type'),
                            'w-full',
                        ])>
                            @foreach (App\Enums\AlbumTypeEnum::cases() as $type)
                                <option value="{{ $type->value }}" {{ $album->type == $type ? 'selected' : '' }}>
                                    @lang('admin.' . $type->value)
                                </option>
                            @endforeach
                        </select>
                    </label>
                    <div class="flex items-center space-x-6">
                        <label class="form-control w-full">
                            <div class="label" for="tags">
                                <span class="label-text text-base text-black font-medium">Hình ảnh</span>
                            </div>
                            <div
                                class="input border border-gray-300 bg-white text-black p-2 rounded-md flex items-center gap-2 px-3 py-2">
                                File:
                                <span id="selected_file_name">{{ $album->getFirstMedia('album_thumb')->name }}</span>
                            </div>
                            <span class="sr-only">Chọn hình ảnh</span>
                            <input type="file" name="image" onchange="loadFile(event)"
                                class="file:bg-violet-50 file:text-violet-700 hover:file:bg-violet-100 block w-full text-sm text-slate-500 file:mr-4 file:rounded-full file:border-0 file:px-4 file:py-2 file:text-sm file:font-semibold" />
                        </label>
                        </label>
                    </div>
                    <div class="shrink-0">
                        <img id="preview_img" class="h-32 w-64 object-cover rounded"
                            src="{{ $album->getFirstMedia('album_thumb')->getUrl('') }}"
                            alt="{{ $album->getFirstMedia('album_thumb')->name }}" />
                    </div>
                    <div class="flex justify-end gap-4">
                        <a href="{{ route('admin.addons.index') }}" class="btn-light btn">@lang('admin.btn.cancel')</a>
                        <button type="submit" class="btn btn-success ml-2">
                            @lang('admin.btn.submit')
                        </button>
                    </div>
                    <div class="flex justify-end gap-4">
                        <a href="{{ route('admin.albums.index') }}" class="btn-light btn">@lang('admin.btn.cancel')
                        </a>
                        <button type="submit" class="btn btn-success ml-2">
                            @lang('admin.btn.submit')
                        </button>
                    </div>
                </form>
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
                document.getElementById('preview_img').style.display = 'block'
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
