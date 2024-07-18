<x-app-layout>
    <div class="p-6">
        <div class="text-black text-normal font-semibold leading-tight">
            <span class="text-black text-normal flex items-center gap-2 font-semibold leading-tight">
                @lang('admin.categories.list')
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
                    <form action="{{ route('admin.categories.store') }}" method="POST" class="space-y-4 needs-validation"
                        novalidate>
                        @csrf
                        <input type="hidden" name="user_id" value="{{ auth()->id() }}">
                        <label class="form-control w-full">
                            <div class="label">
                                <span class="label-text text-base text-black font-medium">@lang('admin.categories.title')</span>
                            </div>
                            <input type="text" name="title" placeholder="Title..." @class([
                                'border',
                                'border-gray-300',
                                'bg-white',
                                'text-black',
                                'p-2',
                                'rounded-md',
                                'input-error' => $errors->has('title'),
                                'w-full',
                            ])
                                value="{{ old('title') }}" />
                            @error('title')
                                <div class="text-red-500 text-sm">{{ $message }}</div>
                            @enderror
                        </label>
                        <label class="form-control w-full">
                            <div class="label">
                                <span class="label-text text-base text-black font-medium">@lang('admin.categories.title_en')</span>
                            </div>
                            <input type="text" name="title_en" placeholder="Title english(if have)"
                                @class([
                                    'border',
                                    'border-gray-300',
                                    'bg-white',
                                    'text-black',
                                    'p-2',
                                    'rounded-md',
                                    'input-error' => $errors->has('title_en'),
                                    'w-full',
                                ]) value="{{ old('title_en') }}" />
                        </label>
                        <label class="form-control w-full">
                            <div class="label">
                                <span class="label-text text-base text-black font-medium">@lang('admin.categories.parent')</span>
                            </div>
                            <select name="parent_id" @class([
                                'border',
                                'border-gray-300',
                                'bg-white',
                                'text-black',
                                'p-2',
                                'rounded-md',
                                'w-full',
                            ])>
                                <option value="">@lang('admin.categories.select_parent')</option>
                                @foreach ($categories as $category)
                                    <x-admin.forms.select.category :category="$category" />
                                @endforeach
                            </select>
                        </label>
                        <label class="form-control w-full">
                            <div class="label">
                                <span class="label-text text-base text-black font-medium">Phòng ban</span>
                            </div>
                            <select name="department_id" @class([
                                'border',
                                'border-gray-300',
                                'bg-white',
                                'text-black',
                                'p-2',
                                'rounded-md',
                                'w-full',
                            ])>
                                <option value="">Chọn phòng ban</option>
                                @foreach ($departments as $name => $index)
                                    <option value="{{$index}}">{{$name}}</option>
                                @endforeach
                            </select>
                        </label>
                        <label class="form-control w-full">
                            <div class="label">
                                <span class="label-text text-base text-black font-medium">@lang('admin.categories.in_menu')</span>
                            </div>
                            <select name="in_menu" @class([
                                'border',
                                'border-gray-300',
                                'bg-white',
                                'text-black',
                                'p-2',
                                'rounded-md',
                                'w-full',
                            ])>
                                <option @selected(old('in_menu') == 0) value="0">@lang('admin.false')</option>
                                <option @selected(old('in_menu') == 1) value="1">@lang('admin.true')</option>
                            </select>
                        </label>
                        <div class="flex justify-end gap-4">
                            <a href="{{ route('admin.categories.index') }}" class="btn-light btn text-white">
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
</x-app-layout>
