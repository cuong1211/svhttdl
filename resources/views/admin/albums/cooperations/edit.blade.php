<x-app-layout>
    <div class="p-6">
        <div class="text-black text-normal font-semibold leading-tight">
            <span class="text-black text-normal flex items-center gap-2 font-semibold leading-tight">
                @lang('admin.cooperations.all')
                <x-heroicon-m-arrow-small-right class="size-4" />
                @lang('admin.edit')
            </span>
        </div>
        <div class="mt-6">
            <div class="overflow-hidden bg-white shadow-sm sm:rounded-lg">
                <div class="bg-white px-8 pb-8 pt-0 shadow sm:rounded-lg">
                    <form action="{{ route('admin.cooperations.update', ['cooperation' => $cooperation->id]) }}"
                        method="POST" class="needs-validation" novalidate enctype="multipart/form-data">
                        @csrf
                        @method('patch')

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
                                    @foreach ($albums as $album)
                                        <option value="{{ $album->id }}"
                                            {{ $cooperation->album_id == $album->id ? 'selected' : '' }}>
                                            {{ $album->name }}
                                        </option>
                                    @endforeach
                                </select>
                            </label>
                            <label class="form-control w-full">
                                <div class="label">
                                    <span class="label-text text-base text-black font-medium">@lang('admin.post.title')</span>
                                </div>
                                <input type="text" name="name" value="{{ old('name', $cooperation->name) }}"
                                    placeholder="title cooperation..." @class([
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
                                    <span class="label-text text-base text-black font-medium">@lang('admin.cooperations.link')</span>
                                </div>
                                <input type="text" name="link_website"
                                    value="{{ old('link_website', $cooperation->link_website) }}"
                                    placeholder="link website..." @class([
                                        'border',
                                        'border-gray-300',
                                        'bg-white',
                                        'text-black',
                                        'p-2',
                                        'rounded-md',
                                        'input-error' => $errors->has('link_website'),
                                        'w-full',
                                    ]) />
                            </label>
                            <label class="form-control w-full">
                                <div class="label">
                                    <span class="label-text text-base text-black font-medium">@lang('admin.description')</span>
                                </div>
                                <textarea name="description" id="description" class="hidden" column="description">
                                    {!! $cooperation->description !!}
                                </textarea>
                            </label>
                            <div class="flex items-center space-x-6">
                                <label class="form-control w-full">
                                    <div class="label" for="tags">
                                        <span class="label-text text-base text-black font-medium">Hình ảnh</span>
                                    </div>
                                    <div
                                        class="input border border-gray-300 bg-white text-black p-2 rounded-md flex items-center gap-2 px-3 py-2">
                                        File:
                                        <span id="selected_file_name">
                                            @if ($cooperation->getFirstMedia('album_cooperation'))
                                                {{ $cooperation->getFirstMedia('album_cooperation')->name }}
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
                            <div class="shrink-0">
                                <img id="preview_img" class="h-40 w-72 object-cover rounded"
                                    src="{{ $cooperation->getFirstMedia('album_cooperation')->getUrl('') }}"
                                    alt="{{ $cooperation->getFirstMedia('album_cooperation')->name }}" />
                            </div>
                        </div>
                        <div class="flex justify-end gap-4">
                            <a href="{{ route('admin.cooperations.index') }}" class="btn-light btn">@lang('admin.btn.cancel')
                            </a>
                            <button type="submit" class="btn btn-success">
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

                output.src = URL.createObjectURL(event.target.files[0])
                output.onload = function() {
                    URL.revokeObjectURL(output.src) // free memory
                }
            }
        </script>
    @endpushonce
</x-app-layout>
