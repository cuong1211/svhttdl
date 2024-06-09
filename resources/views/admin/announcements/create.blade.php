<x-app-layout>
    <div class="p-6">
        <div class="text-gray-800 text-normal font-semibold leading-tight">
            <span class="text-gray-800 text-normal flex items-center gap-2 font-semibold leading-tight">
                @lang('admin.announcements')
                <x-heroicon-m-arrow-small-right class="size-4" />
                @lang('admin.add')
            </span>
        </div>
        <div class="mt-6">
            <div class="overflow-hidden bg-white shadow-sm sm:rounded-lg">
                <div class="bg-white px-8 pb-8 pt-0 shadow sm:rounded-lg">
                    <form action="{{ route('admin.announcements.store') }}"
                          method="POST" class="space-y-4 needs-validation"
                        novalidate enctype="multipart/form-data">
                        @csrf
                        <div class="flex gap-4">
                            <label class="form-control w-full">
                                <span class="label">
                                    <span class="label-text">@lang('admin.post.title')</span>
                                </span>
                                <input type="text" name="title" placeholder="title" @class([
                                    'input',
                                    'input-bordered',
                                    'input-error' => $errors->has('title'),
                                    'w-full',
                                ]) />
                            </label>
                            <x-admin.forms.calendar />
                        </div>

                        <label class="form-control w-full">
                            <span class="label">
                                <span class="label-text">@lang('admin.content')</span>
                            </span>
                            <textarea name="content" id="content" class="hidden">
                                {{ old('content') }}
                            </textarea>
                        </label>

                        <div class="flex justify-end gap-4">
                            <a href="{{ route('admin.announcements.index') }}"
                                class="btn-light btn">@lang('admin.btn.cancel')
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
        <x-admin.forms.tinymce-config column="content"/>
    @endpushonce
</x-app-layout>
