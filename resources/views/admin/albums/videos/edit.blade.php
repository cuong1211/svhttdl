<x-app-layout>
    <div class="p-6">
        <div class="text-black text-normal font-semibold leading-tight">
            <span class="text-black text-normal flex items-center gap-2 font-semibold leading-tight">
                @lang('admin.video')
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
                <div class="bg-white px-8 pb-8 pt-0 shadow sm:rounded-lg">
                    <form action="{{ route('admin.videos.update', ['video' => $video->id]) }}" method="POST"
                        class="space-y-4 needs-validation" novalidate enctype="multipart/form-data">
                        @csrf
                        @method('patch')
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
                                    <option value="{{ $album->id }}"
                                        {{ $video->album_id == $album->id ? 'selected' : '' }}>
                                        {{ $album->name }}
                                    </option>
                                @endforeach
                            </select>
                        </label>
                        <label class="form-control w-full">
                            <div class="label">
                                <span class="label-text text-base text-black font-medium">@lang('admin.post.title')</span>
                            </div>
                            <input type="text" name="name" value="{{ old('name', $video->name) }}"
                                placeholder="title video..." @class([
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
                            <div class="label" for="source">
                                <span class="label-text text-base text-black font-medium">@lang('admin.videos.source')</span>
                            </div>
                            <select name="source" required @class([
                                'border',
                                'border-gray-300',
                                'bg-white',
                                'text-black',
                                'p-2',
                                'rounded-md',
                                'input-error' => $errors->has('source'),
                                'w-full',
                            ])>
                                @foreach (App\Enums\VideoSourceEnum::cases() as $source)
                                    <option value="{{ $source->value }}"
                                        {{ $video->source == $source ? 'selected' : '' }}>
                                        {{ $source->value }}
                                    </option>
                                @endforeach
                            </select>
                        </label>
                        <label class="form-control w-full">
                            <div class="label">
                                <span class="label-text text-base text-black font-medium">@lang('admin.videos.videoID')</span>
                            </div>
                            <input type="text" name="video_id" value="{{ old('video_id', $video->video_id) }}"
                                placeholder="put on video ID..." @class([
                                    'border',
                                    'border-gray-300',
                                    'bg-white',
                                    'text-black',
                                    'p-2',
                                    'rounded-md',
                                    'input-error' => $errors->has('video_id'),
                                    'w-full',
                                ]) />
                        </label>
                        <label class="form-control w-full">
                            <div class="label">
                                <span class="label-text text-base text-black font-medium ">Hiển thị chính</span>
                            </div>
                            <div class="flex items-center mb-4">
                                <input id="true" type="checkbox" value="1" name="is_active"
                                    {{ $video->is_active ? 'checked' : '' }}
                                    class="w-4 h-4 text-blue-700 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                                <label for="true" class="ms-2  text-black dark:text-gray-300 text-base">Hiển
                                    thị</label>

                            </div>
                        </label>
                        <div class="flex items-center space-x-6">

                            <div class="flex items-center space-x-6">
                                <label class="form-control w-full">
                                    <div class="label" for="tags">
                                        <span class="label-text text-base text-black font-medium">Hình ảnh</span>
                                    </div>
                                    <div
                                        class="input border border-gray-300 bg-white text-black p-2 rounded-md flex items-center gap-2 px-3 py-2">
                                        File:
                                        <span id="selected_file_name">
                                            @if ($video->getFirstMedia('thumbnail_video'))
                                                {{ $video->getFirstMedia('thumbnail_video')->name }}
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
                        </div>
                        <div class="shrink-0">
                            <img id="preview_img" class="h-40 w-72 rounded object-cover"
                                src="{{ $video->getFirstMedia('thumbnail_video')->getUrl('') }}"
                                alt="{{ $video->getFirstMedia('thumbnail_video')->name }}" />
                        </div>
                        <div class="flex justify-end gap-4">
                            <a href="{{ route('admin.videos.index') }}" class="btn-light btn text-white">
                                @lang('admin.btn.cancel')
                            </a>
                            <button type="submit" class="btn bg-blue-700 text-white ml-2">
                                @lang('admin.btn.submit')
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    @pushonce('bottom_scripts')
       
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
