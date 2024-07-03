<x-app-layout>
    <div class="p-6">
        <div class="text-black text-normal font-semibold leading-tight">
            <span class="text-black text-normal flex items-center gap-2 font-semibold leading-tight">
                {{ app()->getLocale() === 'en' ? $category->title_en : $category->title }}
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
                    <div class="space-y-4">
                        <form action="{{ route('admin.categories.posts.store', $category->id) }}" method="POST"
                            enctype="multipart/form-data">
                            @csrf

                            <div class="space-y-4">
                                <input type="hidden" name="category_id" value="{{ $category->id }}">

                                <div class="flex gap-4">
                                    <label class="form-control w-full">
                                        <div class="label">
                                            <span class="label-text text-base text-black font-medium">
                                                @lang('admin.post.title')
                                            </span>
                                        </div>
                                        <input type="text" name="title" placeholder="Nhập tên"
                                            value="{{ old('title') }}"
                                            class="border border-gray-300 bg-white text-black p-2 rounded-md w-full @error('title') input-error @enderror" />
                                        @error('title')
                                            <div class="text-red-500 text-sm">{{ $message }}</div>
                                        @enderror
                                    </label>
                                    <div class="flex">
                                        <x-admin.forms.calendar />
                                    </div>
                                </div>

                                <label class="form-control w-full">
                                    <div class="label">
                                        <span
                                            class="label-text text-base text-black font-medium text-base text-black font-medium">@lang('admin.content')</span>
                                    </div>
                                    <textarea name="content" id="content" class="form-input rounded-md shadow-sm mt-1 block w-full" rows="5">{{ old('content', $post->content ?? '') }}</textarea>

                                </label>
                                <label class="form-control w-full">
                                    <div class="label" for="tags">
                                        <span
                                            class="label-text text-base text-black font-medium text-base text-black font-medium">@lang('admin.post.tag')</span>
                                    </div>
                                    <input type="text" name="tags" id="tags" value="{{ old('tags') }}"
                                        placeholder="Nhập tag bài viết" @class([
                                            'border',
                                            'border-gray-300',
                                            'bg-white',
                                            'text-black',
                                            'p-2',
                                            'rounded-md',
                                            'input-error' => $errors->has('tags'),
                                            'w-full',
                                            'h-fit',
                                        ]) />
                                </label>
                                <label class="form-control w-full">
                                    <div class="label" for="tags">
                                        <span
                                            class="label-text text-base text-black font-medium text-base text-black font-medium">Bài
                                            viết thuộc các nhóm tin</span>
                                    </div>
                                    @foreach (App\Enums\PostTypeEnum::cases() as $type)
                                        <div class="flex items-center mb-4">
                                            <input id="{{ $type->value }}" type="checkbox" value="{{ $type->value }}"
                                                class="w-4 h-4 text-blue-700 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                                            <label for="{{ $type->value }}"
                                                class="ms-2  text-black dark:text-gray-300 text-base">{{ $type->value }}</label>

                                        </div>
                                    @endforeach

                                </label>
                                <div class="flex items-center space-x-6">
                                    <label class="form-control w-full">
                                        <div class="label" for="tags">
                                            <span class="label-text text-base text-black font-medium">Thumbnail</span>
                                        </div>
                                        <span class="sr-only">Choose photo</span>
                                        <input type="file" name="image" onchange="loadFile(event)"
                                            class="file:bg-violet-50 file:text-violet-700 hover:file:bg-violet-100 block w-full text-sm text-slate-500 file:mr-4 file:rounded-full file:border-0 file:px-4 file:py-2 file:text-sm file:font-semibold" />
                                    </label>
                                </div>
                                <div class="shrink-0">
                                    <img id="preview_img" class="h-32 w-32 object-cover rounded"
                                        src="https://lh3.googleusercontent.com/a-/AFdZucpC_6WFBIfaAbPHBwGM9z8SxyM1oV4wB4Ngwp_UyQ=s96-c"
                                        alt="Current photo" />
                                </div>

                                <div class="flex justify-end gap-4">
                                    <a href="{{ route('admin.categories.posts.index', $category->slug) }}"
                                        class="btn-light btn text-white">@lang('admin.btn.cancel')</a>
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
        <x-admin.forms.tinymce-config column="content" />
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@yaireo/tagify/dist/tagify.css" />
        <script src="https://cdn.jsdelivr.net/npm/@yaireo/tagify/dist/tagify.min.js"></script>
        <script>
            var input = document.querySelector('input[name=tags]');
            var tagify = new Tagify(input, {
                delimiters: " ",
                pattern: /[^ ]+/,
            });
            var existingTags = @json($tags);
            tagify.addTags(existingTags);
            tagify.on('add', function(e) {
                if (e.detail.data.value.indexOf(' ') > -1) {
                    var splitTags = e.detail.data.value.split(' ');
                    splitTags.forEach(function(tag) {
                        tagify.addTags(tag.trim());
                    });
                    tagify.removeTag(e.detail.data.value);
                }
            });
        </script>
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
