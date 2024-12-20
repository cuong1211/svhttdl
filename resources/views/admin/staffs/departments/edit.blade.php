<x-app-layout>
    <div class="p-6">
        <div class="text-black text-normal font-semibold leading-tight">
            <span class="text-black text-normal flex items-center gap-2 font-semibold leading-tight">
                @lang('admin.departments.list')
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
                    <form action="{{ route('admin.departments.update', $department) }}" method="POST"
                        class="space-y-4 needs-validation" novalidate>
                        @csrf
                        @method('PUT')
                        @foreach (request()->query() as $key => $value)
                            <input type="hidden" name="{{ $key }}" value="{{ $value }}">
                        @endforeach

                        <label class="form-control w-full">
                            <div class="label">
                                <span class="label-text text-base text-black font-medium">@lang('admin.departments.name')</span>
                            </div>
                            <input type="text" name="name" value="{{ $department->name }}"
                                @class([
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
                                <span class="label-text text-base text-black font-medium">Loại phòng ban</span>
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
                                <option value="">Chọn phòng ban</option>
                                @foreach (App\Enums\DepartmentTypeEnum::cases() as $type)
                                    <option value="{{ $type->value }}"
                                        {{ $department->type == $type->value ? 'selected' : '' }}>
                                        {{ $type->value }}
                                    </option>
                                @endforeach
                            </select>
                        </label>
                        <label class="form-control w-full">
                            <div class="label">
                                <span class="label-text text-base text-black font-medium">@lang('admin.departments.description')</span>
                            </div>
                            <textarea name="description" id="description" cols="30" rows="10" @class([
                                'border',
                                'border-gray-300',
                                'bg-white',
                                'text-black',
                                'p-2',
                                'rounded-md',
                                'input-error' => $errors->has('description'),
                                'w-full',
                            ])>
{!! $department->description !!}</textarea>
                        </label>
                        <div class="flex justify-end gap-4">
                            <a href="{{ route('admin.departments.index', request()->query()) }}"
                                class="btn-light btn text-white">@lang('admin.btn.cancel')</a>
                            <button type="submit" class="btn bg-blue-700 text-white ml-2">@lang('admin.btn.submit')</button>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>
    @push('bottom_scripts')
        <x-admin.forms.tinymce-config column="description" />
    @endpush
</x-app-layout>
