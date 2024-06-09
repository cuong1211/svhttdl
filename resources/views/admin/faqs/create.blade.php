<x-app-layout>
    <div class="p-6">
        <div class="text-gray-800 text-normal font-semibold leading-tight">
            <span class="text-gray-800 text-normal flex items-center gap-2 font-semibold leading-tight">
                @lang('admin.faqs')
                <x-heroicon-m-arrow-small-right class="size-4" />
                @lang('admin.add')
            </span>
        </div>
        <div class="mt-6">
            <div class="overflow-hidden bg-white shadow-sm sm:rounded-lg">
                <div class="bg-white px-8 pb-8 pt-0 shadow sm:rounded-lg">
                        <form action="{{ route('admin.faqs.store') }}" method="POST" class="needs-validation" novalidate>
                            @csrf
                            <div class="space-y-4">
                                <label class="form-control w-full">
                                        <div class="label">
                                            <span class="label-text">@lang('admin.faqs.name')</span>
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
                                            <span class="label-text">@lang('admin.faqs.email')</span>
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
                                            <span class="label-text">@lang('admin.faqs.phone')</span>
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
                                        <div class="label">
                                            <span class="label-text">@lang('admin.faqs.address')</span>
                                        </div>
                                        <input type="text" name="address" placeholder="address.."
                                        @class([
                                            'input',
                                            'input-bordered',
                                            'input-error' => $errors->has('address'),
                                            'w-full',
                                        ]) />
                                    </label>
                                <label class="form-control w-full">
                                    <div class="label">
                                        <span class="label-text">@lang('admin.faqs.question')</span>
                                    </div>
                                    <textarea name="question" id="question" class="hidden">
                                        {{ old('question') }}
                                    </textarea>
                                </label>

                                <div class="flex justify-end gap-4">
                                    <a href="{{ route('admin.faqs.index') }}" class="btn-light btn">@lang('admin.btn.cancel')
                                    </a>
                                    <button type="submit" class="btn btn-success ml-2">
                                        @lang('admin.btn.submit')
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @pushonce('bottom_scripts')
        <x-admin.forms.tinymce-config column="question"/>
    @endpushonce
</x-app-layout>
