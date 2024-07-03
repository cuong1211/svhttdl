<x-app-layout>
    <div class="p-6">
        <div class="text-black text-normal font-semibold leading-tight">
            <span class="text-black text-normal flex items-center gap-2 font-semibold leading-tight">
                {{ app()->getLocale() === 'en' ? $category->title_en : $category->title }}
                <x-heroicon-m-arrow-small-right class="size-4" />
                @lang('admin.edit')
            </span>
        </div>
        <div class="mt-6">
            <div class="overflow-hidden bg-white shadow-sm sm:rounded-lg">
                <div class="bg-white p-4 shadow sm:rounded-lg sm:p-8">
                    <div class="space-y-4">
                        <form
                            action="{{ route('admin.categories.posts.update', ['category' => $category->id, 'post' => $post->id]) }}"
                            method="POST" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            <input type="hidden" name="category_id" value="{{ $category->id }}">

                            <div class="space-y-4">
                                <div class="flex gap-4">
                                    <label class="form-control w-full">
                                        <div class="label">
                                            <span
                                                class="label-text text-base text-black font-medium">@lang('admin.post.title')</span>
                                        </div>
                                        <input type="text" name="title" placeholder="Nhập tên"
                                            value="{{ old('title', $post->title) }}" @class([
                                                'border',
                                                'border-gray-300',
                                                'bg-white',
                                                'text-black',
                                                'p-2',
                                                'rounded-md',
                                                'w-full',
                                                'input-error' => $errors->has('title'),
                                            ]) />
                                    </label>
                                    <x-admin.forms.calendar :publish_at="$post->published_at" />
                                </div>
                                <label class="form-control w-full">
                                    <div class="label">
                                        <span class="label-text text-base text-black font-medium">Mô tả</span>
                                    </div>
                                    <input type="text" name="description" placeholder="Nhập mô tả"
                                        value="{{ old('description', $post->description) }}"
                                        @class([
                                            'border',
                                            'border-gray-300',
                                            'bg-white',
                                            'text-black',
                                            'p-2',
                                            'rounded-md',
                                            'w-full',
                                            'input-error' => $errors->has('title'),
                                        ]) />
                                </label>
                                <label class="form-control w-full">
                                    <div class="label">
                                        <span class="label-text text-base text-black font-medium">Tác giả</span>
                                    </div>
                                    <textarea type="text" name="author" placeholder="Nhập tên" value="{{ old('author', $post->author) }}"
                                        @class([
                                            'border',
                                            'border-gray-300',
                                            'bg-white',
                                            'text-black',
                                            'p-2',
                                            'rounded-md',
                                            'w-full',
                                            'input-error' => $errors->has('title'),
                                        ])>
                                        {{ $post->author }}
                                    </textarea>
                                </label>
                                <label class="form-control w-full">
                                    <div class="label">
                                        <span
                                            class="label-text text-base text-black font-medium">@lang('admin.content')</span>
                                    </div>
                                    <textarea name="content" id="content" class="form-input rounded-md shadow-sm mt-1 block w-full" rows="5">{{ old('content', $post->content) }}</textarea>
                                </label>
                                <label class="form-control w-full">
                                    <div class="label">
                                        <span
                                            class="label-text text-base text-black font-medium">@lang('admin.post.tag')</span>
                                    </div>
                                    <input type="text" name="tags" id="tags"
                                        value="{{ old('tags', $tagNames) }}"
                                        placeholder="Enter tags separated by spaces" @class([
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
                                @foreach (App\Enums\PostTypeEnum::cases() as $type)
                                    <div class="flex items-center mb-4">
                                        <input id="{{ $type->value }}" type="checkbox" value="{{ $type->value }}"
                                            name="type" {{ $post->type == $type->value ? 'checked' : '' }}
                                            class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                                        <label for="{{ $type->value }}"
                                            class="ms-2 text-sm font-medium text-gray-900 dark:text-gray-300">{{ $type->value }}</label>

                                    </div>
                                @endforeach
                                {{-- duck --}}
                                <div class="flex items-center space-x-6">
                                    <div class="shrink-0">
                                        @if ($post->getFirstMedia('featured_image'))
                                            <img id="preview_img" class="h-16 w-16 rounded-full object-cover"
                                                src="{{ $post->getFirstMedia('featured_image')->getUrl('') }}"
                                                alt="{{ $post->getFirstMedia('featured_image')->name }}" />
                                        @endif
                                    </div>
                                    <label class="block">
                                        <span class="sr-only">Choose photo</span>
                                        <div
                                            class="input border border-gray-300 bg-white text-gray-900 p-2 rounded-md flex items-center gap-2 px-3 py-2">
                                            File:
                                            @if($post->getFirstMedia('featured_image'))
                                                <span id="selected_file_name">{{ $post->getFirstMedia('featured_image')->name }}</span>
                                            @endif
                                        </div>

                                        <input class="hidden" type="file" name="image" onchange="loadFile(event)"
                                            class="file:bg-violet-50 file:text-violet-700 hover:file:bg-violet-100 block w-full text-sm text-slate-500 file:mr-4 file:rounded-full file:border-0 file:px-4 file:py-2 file:text-sm file:font-semibold" />
                                    </label>
                                </div>
                                <div class="flex justify-end gap-4">
                                    <a href="{{ route('admin.categories.posts.index', ['slug' => $category->slug]) }}"
                                        class="btn-light btn text-white">@lang('admin.btn.cancel')</a>
                                    <button type="submit" class="btn btn-success ml-2">
                                        @lang('admin.btn.submit')
                                    </button>
                                </div>
                            </div>
                        </form>
                        @if ($errors->any())
                            <div class="alert alert-danger">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif
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
