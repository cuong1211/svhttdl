<x-app-layout>
    <div class="p-6">
        <div class="text-black text-normal font-semibold leading-tight">
            <span class="text-black text-normal flex items-center gap-2 font-semibold leading-tight">
                @lang('admin.album')
                <x-heroicon-m-arrow-small-right class="size-4" />
                @lang('admin.create')
            </span>
        </div>

        <div class="mt-6">
            <div class="overflow-hidden bg-white p-6 sm:rounded-lg">
                @if ($errors->any())
                    <div class="alert alert-danger text-black">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                <form action="{{ route('admin.albums.store') }}" method="POST" class="space-y-4 needs-validation"
                    novalidate enctype="multipart/form-data">
                    @csrf
                    <label class="form-control w-full">
                        <div class="label">
                            <span class="label-text text-base text-black font-medium">@lang('admin.albums.name')</span>
                        </div>
                        <input name="name" type="text" placeholder="Nhập tên" @class([
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
                            <label class="form-control w-20">
                                <div class="label" for="tags">
                                    <span class="label-text text-base text-black font-medium">Hình ảnh</span>
                                </div>
                                <span class="sr-only">Chọn ảnh đại diện</span>
                                <input type="file" name="image" onchange="loadFile(event)"
                                    class="file:bg-violet-50 file:text-violet-700 hover:file:bg-violet-100 block w-full text-sm text-slate-500 file:mr-4 file:rounded-full file:border-0 file:px-4 file:py-2 file:text-sm file:font-semibold" />
                            </label>
                        </div>
                        <label class="form-control w-full">
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
                                <option value="">@lang('admin.select')</option>
                                @foreach (App\Enums\AlbumTypeEnum::cases() as $type)
                                    <option @selected($type->value == old('type')) value="{{ $type->value }}">
                                        @lang('admin.' . $type->value)
                                    </option>
                                @endforeach
                            </select>
                        </label>
                    </div>
                    {{-- duck --}}
                    <div class="shrink-0">
                        <img id="preview_img" class="h-40 w-72 object-cover rounded" src="" alt=""
                            style="display:none" />
                    </div>
                    <div class="flex justify-end gap-4">
                        <a href="{{ route('admin.albums.index') }}" class="btn-light btn">
                            @lang('admin.btn.cancel')
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
