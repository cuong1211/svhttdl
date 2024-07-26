<x-app-layout>
    <div class="p-6">
        <div class="text-black text-normal font-semibold leading-tight text-black">
            <span class="text-black text-normal flex items-center gap-2 font-semibold leading-tight">
                @lang('admin.announcements')
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
                    <form action="{{ route('admin.announcements.update', ['announcement' => $announcement->id]) }}"
                        method="POST" class="space-y-4 needs-validation" novalidate enctype="multipart/form-data">
                        @csrf
                        @method('patch')
@foreach (request()->query() as $key => $value)
                            <input type="hidden" name="{{ $key }}" value="{{ $value }}">
                        @endforeach
                        @foreach (request()->query() as $key => $value)
                            <input type="hidden" name="{{ $key }}" value="{{ $value }}">
                        @endforeach
                        <div class="flex gap-4">
                            <label class="form-control w-full">
                                <div class="label">
                                    <span class="label-text text-base text-black font-medium">@lang('admin.post.title')</span>
                                </div>
                                <input type="text" name="title" placeholder="Nhập tên"
                                    value="{{ $announcement->title }}" @class([
                                        'border',
                                        'border-gray-300',
                                        'bg-white',
                                        'text-black',
                                        'p-2',
                                        'rounded-md',
                                        'input-error' => $errors->has('title'),
                                        'w-full',
                                    ]) />
                                @error('title')
                                    <div class="text-red-500 text-sm">{{ $message }}</div>
                                @enderror
                            </label>
                            <x-admin.forms.calendar :publish_at="$announcement->published_at" />
                        </div>
                        <label class="form-control w-full">
                            <div class="label">
                                <span class="label-text text-base text-black font-medium">@lang('admin.content')</span>
                            </div>
                            <textarea name="content" id="content" class="hidden">
                                {!! $announcement->content !!}
                            </textarea>
                            @error('content')
                                <div class="text-red-500 text-sm">{{ $message }}</div>
                            @enderror
                        </label>
                        <div class="flex justify-end gap-4">
                            <a href="{{ route('admin.announcements.index', request()->query()) }}"
                                class="btn-light btn">@lang('admin.btn.cancel')
                            </a>
                            <button type="submit" class="btn bg-blue-700  ml-2 text-white">
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
    @endpushonce
</x-app-layout>
