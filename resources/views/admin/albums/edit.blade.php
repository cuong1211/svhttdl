<x-app-layout>
    {{-- duck --}}
    <div class="p-6">
        <div class="text-black text-normal font-semibold leading-tight">
            <span class="text-black text-normal flex items-center gap-2 font-semibold leading-tight">
                @lang('admin.album')
                <x-heroicon-m-arrow-small-right class="size-4" />
                @lang('admin.edit')
            </span>
        </div>
        <div class="mt-6">
            <div class="overflow-hidden bg-white p-6 sm:rounded-lg">
                @if ($errors->any())
                    <div class="alert alert-error text-black">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                <form action="{{ route('admin.albums.update', ['album' => $album->id]) }}" method="POST"
                    class="space-y-4 needs-validation" novalidate enctype="multipart/form-data">
                    @csrf
                    @method('patch')
@foreach (request()->query() as $key => $value)
                            <input type="hidden" name="{{ $key }}" value="{{ $value }}">
                        @endforeach
                    @foreach (request()->query() as $key => $value)
                        <input type="hidden" name="{{ $key }}" value="{{ $value }}">
                    @endforeach
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
                    <div class="grid grid-cols-2">
                        <div class="flex items-center space-x-6">
                            <label class="form-control w-full">
                                <div class="label" for="tags">
                                    <span class="label-text text-base text-black font-medium">Hình ảnh</span>
                                </div>
                                <div
                                    class="input border border-gray-300 bg-white text-black p-2 rounded-md flex items-center gap-2 px-3 py-2">
                                    File:
                                    <span id="selected_file_name">
                                        @if ($album->getFirstMedia('album_thumb'))
                                            {{ $album->getFirstMedia('album_thumb')->name }}
                                        @else
                                        @endif
                                    </span>
                                </div>
                                <span class="sr-only">Chọn hình ảnh</span>
                                <input type="file" name="image" onchange="loadFile(event)" placeholder="Chọn"
                                    class="file:bg-violet-50 file:text-violet-700 hover:file:bg-violet-100 block w-full text-sm text-slate-500 file:mr-4 file:rounded-full file:border-0 file:px-4 file:py-2 file:text-sm file:font-semibold" />
                            </label>
                            </label>
                        </div>
                        <label class="form-control w-50">
                            <div class="label">
                                <span class="label-text text-base text-black font-medium">@lang('admin.albums.type')</span>
                            </div>
                            <select name="type" required @class([
                                'border',
                                'border-gray-300',
                                'bg-white',
                                'text-black',
                                'p-2',
                                'rounded-md',
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
                    </div>
                    <div class="shrink-0">
                        @if ($album->getFirstMedia('album_thumb'))
                            <img id="preview_img" class="h-32 w-64 object-cover rounded"
                                src="{{ $album->getFirstMedia('album_thumb')->getUrl('') }}"
                                alt="{{ $album->getFirstMedia('album_thumb')->name }}" />
                        @else
                            <img id="preview_img" class="h-32 w-64 object-cover rounded" src="" alt=""
                                style="display:none" />
                        @endif
                    </div>
                    <div class="flex justify-end gap-4">
                        <a href="{{ route('admin.albums.index', request()->query()) }}"
                            class="btn-light btn text-white">@lang('admin.btn.cancel')
                        </a>
                        <button type="submit" class="btn bg-blue-700 text-white ml-2">
                            @lang('admin.btn.submit')
                        </button>
                    </div>
                </form>
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
