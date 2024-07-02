<x-app-layout>
    <div class="p-6">
        <div class="text-gray-800 text-normal font-semibold leading-tight">
            <span class="text-gray-800 text-normal flex items-center gap-2 font-semibold leading-tight">
                @lang('admin.departments.list')
                <x-heroicon-m-arrow-small-right class="size-4" />
                @lang('admin.add')
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
                    <form action="{{ route('admin.departments.store') }}" method="POST"
                        class="space-y-4 needs-validation" novalidate>
                        @csrf
                        <label class="form-control w-full">
                            <div class="label">
                                <span class="label-text text-base text-black font-medium">@lang('admin.departments.name')</span>
                            </div>
                            <input type="text" name="name" placeholder="name..." @class([
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
                                <option value="">@lang('admin.select')</option>
                                @foreach (App\Enums\DepartmentTypeEnum::cases() as $type)
                                    <option @selected($type->value == old('type')) value="{{ $type->value }}">
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
                            ])></textarea>

                        </label>

                        <div class="flex justify-end gap-4">
                            <a href="{{ route('admin.departments.index') }}" class="btn-light btn">
                                @lang('admin.btn.cancel')
                            </a>
                            <button type="submit" class="btn bg-blue-700 ml-2 text-white">
                                @lang('admin.btn.submit')
                            </button>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>
</x-app-layout>
