<x-app-layout>
    <div class="p-6">
        <div class="text-black text-normal font-semibold leading-tight">
            <span class="text-black text-normal flex items-center gap-2 font-semibold leading-tight">
                @lang('admin.staffs.list')
                <x-heroicon-m-arrow-small-right class="size-4" />
                @lang('admin.edit')
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
                    <form action="{{ route('admin.staffs.update', $staff->id) }}" method="POST"
                        class="space-y-4 needs-validation" novalidate enctype="multipart/form-data">
                        @csrf
                        @method('PUT') <!-- Đảm bảo sử dụng method PUT hoặc PATCH cho update -->
                        <label class="form-control w-full">
                            <div class="label">
                                <span class="label-text text-base text-black font-medium">@lang('admin.staffs.name')</span>
                            </div>
                            <input type="text" name="name" value="{{ old('name', $staff->name) }}"
                                placeholder="name..." @class([
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
                            <div class="label" for="departments">
                                <span class="label-text text-base text-black font-medium">@lang('admin.departments')</span>
                            </div>
                            <select name="department_id" id="" required @class([
                                'border',
                                'border-gray-300',
                                'bg-white',
                                'text-black',
                                'p-2',
                                'rounded-md',
                                'input-error' => $errors->has('departments'),
                                'w-full',
                            ])>

                                @foreach ($departments as $department)
                                    <option value="{{ $department->id }}"
                                        {{ $department->department_id == $department->id ? 'selected' : '' }}>
                                        {{ $department->name }}
                                    </option>
                                @endforeach
                            </select>
                            @error('departments')
                                <p class="text-red-500 text-xs italic">{{ $message }}</p>
                            @enderror
                        </label>
                        <label class="form-control w-full">
                            <div class="label" for="positions">
                                <span class="label-text text-base text-black font-medium">@lang('admin.positions')</span>
                            </div>
                            <select name="position_id" id="" required @class([
                                'border',
                                'border-gray-300',
                                'bg-white',
                                'text-black',
                                'p-2',
                                'rounded-md',
                                'input-error' => $errors->has('positions'),
                                'w-full',
                            ])>

                                @foreach ($positions as $position)
                                    <option value="{{ $position->id }}"
                                        {{ $position->position_id == $position->id ? 'selected' : '' }}>
                                        {{ $position->name }}
                                    </option>
                                @endforeach
                            </select>
                            @error('positions')
                                <p class="text-red-500 text-xs italic">{{ $message }}</p>
                            @enderror
                        </label>
                        <label class="form-control w-full">
                            <div class="label">
                                <span class="label-text text-base text-black font-medium">@lang('admin.content')</span>
                            </div>
                            <textarea name="content" id="content" class="form-input rounded-md shadow-sm mt-1 block w-full" rows="5">{{ old('content', $staff->content) }}</textarea>
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
                                        @if ($staff->getFirstMedia('staff_image'))
                                            {{ $staff->getFirstMedia('staff_image')->name }}
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
                                src="{{ $staff->getFirstMedia('staff_image')->getUrl('') }}"
                                alt="{{ $staff->getFirstMedia('staff_image')->name }}" />
                        </div>
                        <div class="flex justify-end gap-4">
                            <a href="{{ route('admin.staffs.index') }}" class="btn-light btn">
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
        <x-admin.forms.tinymce-config column="content" />
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
