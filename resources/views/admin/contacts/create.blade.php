<x-app-layout>
    <div class="p-6">
        <div class="text-gray-800 text-normal font-semibold leading-tight">
            <span class="text-gray-800 text-normal flex items-center gap-2 font-semibold leading-tight">
                @lang('admin.contacts')
                <x-heroicon-m-arrow-small-right class="size-4" />
                @lang('admin.add')
            </span>
        </div>
        <div class="mt-6">
            <div class="overflow-hidden bg-white shadow-sm sm:rounded-lg">
                <div class="bg-white px-8 pb-8 pt-0 shadow sm:rounded-lg">
                    <form action="{{ route('admin.contacts.store') }}" method="POST" class="space-y-4 needs-validation"
                        novalidate>
                        @csrf
                        <label class="form-control w-full">
                            <div class="label">
                                <span class="label-text">@lang('admin.contacts.name')</span>
                            </div>
                            <input type="text" name="name" placeholder="Put name"
                                @class([
                                    'input',
                                    'input-bordered',
                                    'input-error' => $errors->has('name'),
                                    'w-full',
                                ]) />
                        </label>
                        <label class="form-control w-full">
                            <div class="label">
                                <span class="label-text">@lang('admin.contacts.email')</span>
                            </div>
                            <input type="text" name="email" placeholder="email..."
                                @class([
                                    'input',
                                    'input-bordered',
                                    'input-error' => $errors->has('email'),
                                    'w-full',
                                ]) />
                        </label>
                        <label class="form-control w-full">
                            <div class="label">
                                <span class="label-text">@lang('admin.contacts.phone')</span>
                            </div>
                            <input type="text" name="phone" placeholder="0987...."
                                @class([
                                    'input',
                                    'input-bordered',
                                    'input-error' => $errors->has('phone'),
                                    'w-full',
                                ]) />
                        </label>
                        <label class="form-control w-full">
                                <div class="label min-h">
                                    <span class="label-text">@lang('admin.contacts.content')</span>
                                </div>
                                <textarea name="content" id="content" placeholder="Type here" @class([
                                    'w-full',
                                    'input',
                                    'input-bordered',
                                    'input-error' => $errors->has('content'),
                                    'min-h-52',
                                ])> {{ old('content') }}</textarea>
                                @error('content')
                                    <p class="mt-2 text-xs text-red-500">{{ $message }}</p>
                                @enderror
                            </label>
                        <div class="flex justify-end gap-4">
                                <a href="{{ route('admin.contacts.index') }}" class="btn-light btn">@lang('admin.btn.cancel')
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
</x-app-layout>
