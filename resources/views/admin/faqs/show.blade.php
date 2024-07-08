<x-app-layout>
    <div class="p-6">
        <div class="text-black text-normal font-semibold leading-tight">
            <span class="text-black text-normal flex items-center gap-2 font-semibold leading-tight">
                @lang('admin.faqs')
                <x-heroicon-m-arrow-small-right class="size-4" />
                @lang('admin.faqs.show')
            </span>
        </div>
        <div class="mt-6">
            <a href="{{ route('admin.faqs.index') }}"
                class="bg-gray-300 text-black hover:bg-gray-400 active:bg-gray-500 focus:border-gray-500 focus:ring-gray-300 inline-flex items-center rounded-md px-4 py-2 text-xs font-semibold uppercase tracking-widest transition focus:outline-none focus:ring disabled:opacity-25">
                <x-heroicon-o-arrow-left class="mr-2 size-4" />
                @lang('admin.back')
            </a>
            <div class="overflow-hidden bg-white shadow-sm sm:rounded-lg">
                <div class="border-gray-200 border-b bg-white p-6">
                    <div class="grid grid-cols-1 gap-4 md:grid-cols-2">
                        <div class="col-span-1">
                            <h3 class="text-black text-lg font-medium leading-6">@lang('admin.contacts.name'):</h3>
                            <p class="text-black mt-1 max-w-2xl text-base">{{ $faq->name }}</p>
                        </div>
                        <div class="col-span-1">
                            <h3 class="text-black text-lg font-medium leading-6">@lang('admin.contacts.email'):</h3>
                            <p class="text-black mt-1 max-w-2xl text-base">{{ $faq->email }}</p>
                        </div>
                        <div class="col-span-1">
                            <h3 class="text-black text-lg font-medium leading-6">@lang('admin.contacts.phone'):</h3>
                            <p class="text-black mt-1 max-w-2xl text-base">{{ $faq->phone }}</p>
                        </div>
                        <div class="col-span-1">
                            <h3 class="text-black text-lg font-medium leading-6">@lang('admin.contacts.read_at'):</h3>
                            <p class="text-black mt-1 max-w-2xl text-base">
                                {{ $faq->read_at ? $faq->read_at : 'Not read yet' }}</p>
                        </div>
                    </div>
                    <div class="">
                        <label class="form-control w-full">
                            <div class="label">
                                <span class="label-text text-base text-black font-medium">@lang('admin.faqs.question'):</span>
                            </div>
                            <div class="w-full border border-gray-300 bg-white text-black font-medium p-2 rounded-md">
                                {!! $faq->question !!}
                            </div>
                            <p class="text-black mt-1 mb-2 max-w-2xl text-base">
                                @lang('admin.faqs.created_at'): {{ $faq->createdAtVi }}
                            </p>
                        </label>
                        <form action="{{ route('admin.faqs.update', $faq) }}" method="POST">
                            @method('PUT')
                            @csrf
                            <div class="flex">
                                <h3 class="text-black text-lg font-medium leading-6">
                                    @lang('admin.faqs.answer')
                                    :
                                </h3>
                                <p class="text-black ml-auto mt-1 max-w-2xl text-sm">
                                    @lang('admin.faqs.answer_at')
                                    :{{ $faq->answer_at ? $faq->answer_at : 'Not answer yet' }}
                                </p>
                            </div>

                            <input type="hidden" name="id" value="{{ $faq->id }}" />
                            <div class="mt-1 items-center text-sm">
                                <textarea name="answer" id="answer" class="form-input rounded-md shadow-sm mt-1 block w-full" rows="5">{{ $faq->answer ?: old('answer') }}</textarea>
                            </div>
                            <div class="mt-3 flex justify-end gap-4">
                                <button type="submit" class="btn bg-blue-700 ml-2 text-white">
                                    @lang('admin.btn.submit')
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @pushonce('bottom_scripts')
        <x-admin.forms.tinymce-config column="answer" />
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@yaireo/tagify/dist/tagify.css" />
        <script src="https://cdn.jsdelivr.net/npm/@yaireo/tagify/dist/tagify.min.js"></script>
    @endpushonce
</x-app-layout>
