<x-app-layout>
    <div class="p-6">
        <div class="text-gray-800 text-normal font-semibold leading-tight">
            <span class="text-gray-800 text-normal flex items-center gap-2 font-semibold leading-tight">
                @lang('admin.staffs.list')
                <x-heroicon-m-arrow-small-right class="size-4" />
                @lang('admin.edit')
            </span>
        </div>
        @if (session('icon') && session('heading') && session('message'))
            <div class="alert alert-{{ session('icon') === 'success' ? 'success' : 'danger' }}" role="alert">
                <strong>{{ session('heading') }}:</strong>
                {{ session('message') }}
            </div>
        @endif
        <div class="mt-6">
            <div class="overflow-hidden bg-white shadow-sm sm:rounded-lg">
                <div class="bg-white px-8 pb-8 pt-0 shadow sm:rounded-lg">
                    <form action="{{ route('admin.staffs.update', $staff->id) }}" method="POST" class="space-y-4 needs-validation"
                        novalidate enctype="multipart/form-data">
                        @csrf
                        @method('PUT') <!-- Đảm bảo sử dụng method PUT hoặc PATCH cho update -->
                        <label class="form-control w-full">
                            <div class="label">
                                <span class="label-text">@lang('admin.staffs.name')</span>
                            </div>
                            <input type="text" name="name" value="{{ old('name', $staff->name) }}" placeholder="name..." @class([
                                'input',
                                'input-bordered',
                                'input-error' => $errors->has('name'),
                                'w-full',
                            ]) />
                        </label>
                        <label class="form-control w-full">
                            <div class="label" for="departments">
                                <span class="label-text">@lang('admin.departments')</span>
                            </div>
                            @foreach ($departments as $department)
                                <div class="flex items-center mb-2">
                                    <input type="checkbox" id="dept{{ $department->id }}" name="departments[]" value="{{ $department->id }}"
                                        @if(is_array(old('departments')) && in_array($department->id, old('departments')))
                                            checked
                                        @elseif($staff->departments->contains($department))
                                            checked
                                        @endif
                                        class="input input-bordered w-4 h-4 mr-2"
                                    >
                                    <label for="dept{{ $department->id }}" class="select-none">{{ $department->name }}</label>
                                </div>
                            @endforeach
                            @error('departments')
                                <p class="text-red-500 text-xs italic">{{ $message }}</p>
                            @enderror
                        </label>
                        
                        <label class="form-control w-full">
                            <div class="label">
                                <span class="label-text">@lang('admin.content')</span>
                            </div>
                            <textarea name="content" id="content" class="form-input rounded-md shadow-sm mt-1 block w-full" rows="5">{{ old('content', $staff->content) }}</textarea>
                        </label>
                        <div class="flex items-center space-x-6">
                            <div class="shrink-0">
                                <img id="preview_img" class="h-16 w-16 rounded-full object-cover"
                                    src="{{ $staff->getFirstMedia('staff_image')->getUrl('thumb') }}"
                                    alt="{{ $staff->getFirstMedia('staff_image')->name }}" />
                            </div>
                            <label class="block">
                                <span class="sr-only">Choose photo</span>
                                <div class="input input-bordered flex items-center gap-2 border px-3 py-2">
                                    File:
                                    <span
                                        id="selected_file_name">{{ $staff->getFirstMedia('staff_image')->name }}</span>
                                </div>

                                <input class="hidden" type="file" name="image" onchange="loadFile(event)"
                                    class="file:bg-violet-50 file:text-violet-700 hover:file:bg-violet-100 block w-full text-sm text-slate-500 file:mr-4 file:rounded-full file:border-0 file:px-4 file:py-2 file:text-sm file:font-semibold" />
                            </label>
                        </div>
                        <div class="flex justify-end gap-4">
                            <a href="{{ route('admin.staffs.index') }}" class="btn-light btn">
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
    <x-admin.forms.tinymce-config column="content" />
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
