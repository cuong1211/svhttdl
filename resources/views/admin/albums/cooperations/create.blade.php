<x-app-layout>
    <div class="p-6">
        <div class="text-gray-800 text-normal font-semibold leading-tight">
            <span class="text-gray-800 text-normal flex items-center gap-2 font-semibold leading-tight">
                @lang('admin.cooperations.all')
                <x-heroicon-m-arrow-small-right class="size-4" />
                @lang('admin.add')
            </span>
        </div>
        <div class="mt-6">
            <div class="overflow-hidden bg-white shadow-sm sm:rounded-lg">
                <div class="bg-white px-8 pb-8 pt-0 shadow sm:rounded-lg">
                    <form action="{{ route('admin.cooperations.store') }}" method="POST" class="needs-validation"
                            novalidate enctype="multipart/form-data">
                            @csrf
                            <div class="space-y-4">
                                <label class="form-control w-full">
                                    <div class="label" for="album_id">
                                        <span class="label-text">@lang('admin.album')</span>
                                    </div>
                                    <select name="album_id" required @class([
                                        'input',
                                        'input-bordered',
                                        'input-error' => $errors->has('album_id'),
                                        'w-full',
                                    ])>
                                        <option value="">Select Album</option>
                                        @foreach ($albums as $album)
                                            <option value="{{ $album->id }}">{{ $album->name }}</option>
                                        @endforeach
                                    </select>
                                </label>
                                <label class="form-control w-full">
                                        <div class="label">
                                            <span class="label-text">@lang('admin.post.title')</span>
                                        </div>
                                        <input type="text" name="name" placeholder="title cooperation..."
                                            @class([
                                                'input',
                                                'input-bordered',
                                                'input-error' => $errors->has('name'),
                                                'w-full',
                                            ]) />
                                    </label>
                                <label class="form-control w-full">
                                    <div class="label">
                                        <span class="label-text">@lang('admin.cooperations.link')</span>
                                    </div>
                                    <input type="text" name="link_website" placeholder="link website..."
                                        @class([
                                            'input',
                                            'input-bordered',
                                            'input-error' => $errors->has('link_website'),
                                            'w-full',
                                        ])
                                    />
                                </label>
                                <label class="form-control w-full">
                                    <div class="label">
                                        <span class="label-text">@lang('admin.description')</span>
                                    </div>
                                    <textarea name="description" id="description" class="hidden" column="description">
                                        {{ old('description') }}
                                    </textarea>
                                </label>

                                <div class="flex items-center space-x-6">
                                    <div class="shrink-0">
                                        <img id="preview_img" class="h-16 w-16 rounded-full object-cover"
                                            src="https://lh3.googleusercontent.com/a-/AFdZucpC_6WFBIfaAbPHBwGM9z8SxyM1oV4wB4Ngwp_UyQ=s96-c"
                                            alt="Current cooperation" />
                                    </div>
                                    <label class="block">
                                        <span class="sr-only">Choose</span>
                                        <input type="file" name="image" onchange="loadFile(event)"
                                            class="file:bg-violet-50 file:text-violet-700 hover:file:bg-violet-100 block w-full text-sm text-slate-500 file:mr-4 file:rounded-full file:border-0 file:px-4 file:py-2 file:text-sm file:font-semibold" />
                                    </label>
                                </div>
                                <script>
                                    var loadFile = function(event) {
                                        var input = event.target
                                        var file = input.files[0]
                                        var type = file.type

                                        var output = document.getElementById('preview_img')

                                        output.src = URL.createObjectURL(event.target.files[0])
                                        output.onload = function() {
                                            URL.revokeObjectURL(output.src)
                                        }
                                    }
                                </script>
                            </div>
                            <div class="flex justify-end gap-4">
                                <a href="{{ route('admin.cooperations.index') }}"
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
        <x-admin.forms.tinymce-config column="description"/>
    @endpushonce
</x-app-layout>
