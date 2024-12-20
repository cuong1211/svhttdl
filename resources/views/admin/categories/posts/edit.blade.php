<x-app-layout>
    <div class="p-6">
        <div class="text-black text-normal font-semibold leading-tight">
            <span class="text-black text-normal flex items-center gap-2 font-semibold leading-tight">
                {{ app()->getLocale() === 'en' ? $selectedCategory->title_en : $selectedCategory->title }}
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
                <div class="bg-white p-4 shadow sm:rounded-lg sm:p-8">
                    <div class="space-y-4">
                        <form
                            action="{{ route('admin.categories.posts.update', ['category' => $categoryId, 'post' => $post->id]) }}"
                            method="POST" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            @foreach (request()->query() as $key => $value)
                                <input type="hidden" name="{{ $key }}" value="{{ $value }}">
                            @endforeach
                            @if (Auth::user()->category_id == 3)
                                <input type="hidden" name="category_id" value="{{ $post->category_id }}">
                            @endif
                            <div class="space-y-4">
                                <div class="flex gap-4">
                                    <label class="form-control w-full">
                                        <div class="label">
                                            <span
                                                class="label-text text-base text-black font-medium">@lang('admin.post.title')</span>
                                        </div>
                                        <input type="text" name="title" placeholder="Nhập tên"
                                            @class([
                                                'border',
                                                'border-gray-300',
                                                'bg-white',
                                                'text-black',
                                                'p-2',
                                                'rounded-md',
                                                'w-full',
                                                'input-error' => $errors->has('title'),
                                            ]) value="{{ $post->title }}" />
                                        @error('title')
                                            <div class="text-red-500 text-sm">{{ $message }}</div>
                                        @enderror
                                    </label>
                                    <x-admin.forms.calendar :publish_at="$post->published_at" />
                                </div>
                                <label class="form-control w-full">
                                    <div class="label">
                                        <span class="label-text text-base text-black font-medium">Tác giả</span>
                                    </div>
                                    <input type="text" name="author" placeholder="Nhập tác giả"
                                        value="{{ $post->author }}" @class([
                                            'border',
                                            'border-gray-300',
                                            'bg-white',
                                            'text-black',
                                            'p-2',
                                            'rounded-md',
                                            'w-full',
                                            'input-error' => $errors->has('author'),
                                        ]) />
                                    @error('author')
                                        <div class="text-red-500 text-sm">{{ $message }}</div>
                                    @enderror
                                </label>
                                <label class="form-control w-full">
                                    <div class="label">
                                        <span class="label-text text-base text-black font-medium">Mô tả</span>
                                    </div>
                                    <textarea type="text" name="description" placeholder="Nhập tóm tắt"
                                        value="{{ old('description', $post->description) }}" @class([
                                            'border',
                                            'border-gray-300',
                                            'bg-white',
                                            'text-black',
                                            'p-2',
                                            'rounded-md',
                                            'w-full',
                                            'input-error' => $errors->has('description'),
                                        ])>
{{ $post->description }}
                                    </textarea>
                                    @error('description')
                                        <div class="text-red-500 text-sm">{{ $message }}</div>
                                    @enderror
                                </label>
                                <label class="form-control w-full">
                                    <div class="label">
                                        <span
                                            class="label-text text-base text-black font-medium">@lang('admin.content')</span>
                                    </div>
                                    <textarea name="content" id="content" class="form-input rounded-md shadow-sm mt-1 block w-full" rows="5">{{ old('content', $post->content) }}</textarea>
                                    @error('content')
                                        <div class="text-red-500 text-sm">{{ $message }}</div>
                                    @enderror
                                </label>
                                @if (Auth::user()->category_id == 3)
                                @else
                                    <label class="form-control w-full">
                                        <div class="label">
                                            <span
                                                class="label-text text-base text-black font-medium">@lang('admin.categories.parent')</span>
                                        </div>
                                        <select name="category_id" @class([
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
                                                <x-admin.forms.select.category_post :category="$category"
                                                    :selectedCategory="$selectedCategory" />
                                            @endforeach
                                        </select>
                                        @error('category_id')
                                            <div class="text-red-500 text-sm">{{ $message }}</div>
                                        @enderror
                                    </label>
                                @endif
                                <label class="form-control w-full">
                                    <div class="label">
                                        <span class="label-text text-base text-black font-medium">Trạng thái</span>
                                    </div>
                                    <select name="state" @class([
                                        'border',
                                        'border-gray-300',
                                        'bg-white',
                                        'text-black',
                                        'p-2',
                                        'rounded-md',
                                        'w-full',
                                    ])>
                                        <option value="0" {{ $post->state == 0 ? 'selected' : '' }}>Ẩn</option>
                                        <option value="1" {{ $post->state == 1 ? 'selected' : '' }}>Hiển thị
                                        </option>

                                    </select>
                                    @error('state')
                                        <div class="text-red-500 text-sm">{{ $message }}</div>
                                    @enderror
                                </label>
                                <label class="form-control w-full">
                                    <div class="label" for="tags">
                                        <span class="label-text text-base text-black font-medium">Bài viết thuộc các
                                            nhóm tin</span>
                                    </div>

                                    <div class="space-y-4">
                                        <!-- Button clear -->

                                        <!-- Radio options -->
                                        <div class="space-y-3">
                                            @foreach (App\Enums\PostTypeEnum::cases() as $type)
                                                <div class="inline-flex items-center">
                                                    <input id="{{ $type->value }}" type="radio" name="type"
                                                        value="{{ $type->value }}"
                                                        {{ $post->type === $type->value ? 'checked' : '' }}
                                                        class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500">
                                                    <label for="{{ $type->value }}"
                                                        class="ms-2 text-base font-medium text-black cursor-pointer select-none">
                                                        {{ $type->value === 0 ? 'Tin mới' : 'Tin hot' }}
                                                    </label>
                                                </div>
                                            @endforeach
                                        </div>
                                        <button type="button" onclick="clearSelection()"
                                            class="px-4 py-2 bg-blue-100 text-blue-700 rounded-md hover:bg-blue-200 transition-colors duration-200 text-sm font-medium">
                                            Bỏ chọn
                                        </button>
                                    </div>
                                    <!-- Grid cho Audio và Document -->
                                    <div class="grid grid-cols-2 gap-4 mb-6">
                                        <!-- Audio Upload -->
                                        <div class="form-control w-full">
                                            <div class="label flex justify-between items-center">
                                                <span class="label-text text-base text-black font-medium">File âm
                                                    thanh(tối đa
                                                    10mb)</span>
                                            </div>
                                            <div class="relative border border-gray-300 bg-white">
                                                <div id="audioDropzone"
                                                    class="dropzone flex flex-col items-center justify-center w-full h-[100px] px-4 py-3 bg-white border-2 border-dashed border-gray-300 rounded-lg hover:bg-gray-50 transition-all cursor-pointer">
                                                    <!-- Content khi chưa có file mới -->
                                                    <div
                                                        class="dropzone-content text-center {{ $post->getFirstMedia('audio') ? 'hidden' : '' }}">
                                                        <svg class="mx-auto h-8 w-8 text-gray-400" fill="none"
                                                            stroke="currentColor" viewBox="0 0 24 24">
                                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                                stroke-width="2"
                                                                d="M9 19V6l12-3v13M9 19c0 1.105-1.343 2-3 2s-3-.895-3-2 1.343-2 3-2 3 .895 3 2zm12-3c0 1.105-1.343 2-3 2s-3-.895-3-2 1.343-2 3-2 3 .895 3 2zM9 10l12-3" />
                                                        </svg>
                                                        <p class="mt-1 text-sm text-gray-500">MP3, WAV, OGG (Tối đa
                                                            10MB)</p>
                                                    </div>

                                                    <!-- Preview file hiện tại hoặc file mới -->
                                                    <div
                                                        class="dropzone-preview w-full {{ $post->getFirstMedia('audio') ? '' : 'hidden' }}">
                                                        <div
                                                            class="flex items-center justify-between p-2 bg-blue-50 rounded-lg">
                                                            <div class="flex items-center">
                                                                <div>
                                                                    <p
                                                                        class="text-base font-bold truncate file-name max-w-[150px]" style="color: #524f4f">
                                                                        {{ $post->getFirstMedia('audio') ? $post->getFirstMedia('audio')->name : '' }}
                                                                    </p>
                                                                    @php
                                                                        $fileSize = $post->getFirstMedia('audio')
                                                                            ?->size;
                                                                        $formattedSize = '';
                                                                        if ($fileSize) {
                                                                            if ($fileSize >= 1048576) {
                                                                                $formattedSize =
                                                                                    round($fileSize / 1048576, 2) .
                                                                                    ' MB';
                                                                            } elseif ($fileSize >= 1024) {
                                                                                $formattedSize =
                                                                                    round($fileSize / 1024, 2) . ' KB';
                                                                            } else {
                                                                                $formattedSize = $fileSize . ' bytes';
                                                                            }
                                                                        }
                                                                    @endphp
                                                                    <p class="text-xs text-gray-500 file-size" style="color: #524f4f">
                                                                        {{ $formattedSize }}</p>
                                                                </div>
                                                            </div>
                                                            <button type="button"
                                                                class="remove-file text-gray-400 hover:text-gray-500 ml-2" style="color: #524f4f">
                                                                <svg class="w-5 h-5" fill="none"
                                                                    stroke="currentColor" viewBox="0 0 24 24">
                                                                    <path stroke-linecap="round"
                                                                        stroke-linejoin="round" stroke-width="2"
                                                                        d="M6 18L18 6M6 6l12 12" />
                                                                </svg>
                                                            </button>
                                                        </div>
                                                    </div>
                                                </div>
                                                <input type="file" id="audioInput" name="audio"
                                                    accept=".mp3,.wav,.ogg" class="hidden" />
                                            </div>
                                        </div>

                                        <!-- Document Upload - Tương tự như Audio -->
                                        <div class="form-control w-full">
                                            <div class="label flex justify-between items-center">
                                                <span class="label-text text-base text-black font-medium">File tài
                                                    liệu(tối đa
                                                    10mb)</span>
                                            </div>
                                            <div class="relative border border-gray-300 bg-white">
                                                <div id="documentDropzone"
                                                    class="dropzone flex flex-col items-center justify-center w-full h-[100px] px-4 py-3 bg-white border-2 border-dashed border-gray-300 rounded-lg hover:bg-gray-50 transition-all cursor-pointer">
                                                    <!-- Content khi chưa có file mới -->
                                                    <div
                                                        class="dropzone-content text-center {{ $post->getFirstMedia('document') ? 'hidden' : '' }}">
                                                        <svg class="mx-auto h-8 w-8 text-gray-400" fill="none"
                                                            stroke="currentColor" viewBox="0 0 24 24">
                                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                                stroke-width="2"
                                                                d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                                                        </svg>
                                                        <p class="mt-1 text-sm text-gray-500" >PDF, DOC, DOCX, XLS, XLSX
                                                            (Tối đa 10MB)</p>
                                                    </div>

                                                    <!-- Preview file hiện tại hoặc file mới -->
                                                    <div
                                                        class="dropzone-preview w-full {{ $post->getFirstMedia('document') ? '' : 'hidden' }}">
                                                        <div
                                                            class="flex items-center justify-between p-2 bg-blue-50 rounded-lg">
                                                            <div class="flex items-center">
                                                                <div>
                                                                    <p
                                                                        class="text-sm font-medium text-gray-900 truncate file-name max-w-[150px]" style="color: #524f4f">
                                                                        {{ $post->getFirstMedia('document') ? $post->getFirstMedia('document')->name : '' }}
                                                                    </p>
                                                                    @php
                                                                        $post->getFirstMedia('document')?->size;
                                                                        $formattedSizedocs = '';
                                                                        if ($fileSize) {
                                                                            if ($fileSize >= 1048576) {
                                                                                $formattedSizedocs =
                                                                                    round($fileSize / 1048576, 2) .
                                                                                    ' MB';
                                                                            } elseif ($fileSize >= 1024) {
                                                                                $formattedSizedocs =
                                                                                    round($fileSize / 1024, 2) . ' KB';
                                                                            } else {
                                                                                $formattedSizedocs =
                                                                                    $fileSize . ' bytes';
                                                                            }
                                                                        }
                                                                    @endphp
                                                                    <p class="text-xs text-gray-500 file-size" style="color: #524f4f">
                                                                        {{ $formattedSizedocs }}</p>
                                                                </div>
                                                            </div>
                                                            <button type="button"
                                                                class="remove-file text-gray-400 hover:text-gray-500 ml-2">
                                                                <svg class="w-5 h-5" fill="none"
                                                                    stroke="currentColor" viewBox="0 0 24 24">
                                                                    <path stroke-linecap="round"
                                                                        stroke-linejoin="round" stroke-width="2"
                                                                        d="M6 18L18 6M6 6l12 12" />
                                                                </svg>
                                                            </button>
                                                        </div>
                                                    </div>
                                                </div>
                                                <input type="file" id="documentInput" name="document"
                                                    accept=".pdf,.doc,.docx,.xls,.xlsx" class="hidden" />
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Image Upload -->
                                    <div class="form-control w-full">
                                        <div class="label flex justify-between items-center">
                                            <span class="label-text text-base text-black font-medium">Hình ảnh(tối đa
                                                10mb)</span>
                                            @if ($post->getFirstMedia('featured_image'))
                                                <span
                                                    class="text-sm text-gray-600" style="color: #524f4f">{{ $post->getFirstMedia('featured_image')->name }}</span>
                                            @endif
                                        </div>
                                        <div class="relative border border-gray-300 bg-white h-[200px]">
                                            <div id="imageDropzone" class="dropzone group relative w-full h-full">
                                                <div
                                                    class="dropzone-preview flex items-center justify-center h-full bg-white border-2 border-dashed border-gray-300 rounded-lg">
                                                    <!-- Hiển thị ảnh hiện tại -->
                                                    <img id="preview_img" class="max-w-full max-h-full object-contain"
                                                        src="{{ $post->getFirstMedia('featured_image') ? $post->getFirstMedia('featured_image')->getUrl() : asset($post->image) }}"
                                                        alt="Preview" />

                                                    <!-- Overlay với hướng dẫn khi hover -->
                                                    <div
                                                        class="absolute inset-0 bg-black/50 opacity-0 group-hover:opacity-100 transition-all flex items-center justify-center text-center">
                                                        <div class="text-white">
                                                            <p>Click hoặc kéo thả để thay đổi ảnh</p>
                                                            <p class="text-sm mt-2">PNG, JPG, JPEG (Tối đa 10MB)</p>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <input type="file" id="imageInput" name="image"
                                                accept="image/png,image/jpeg,image/jpg" class="hidden" />
                                        </div>
                                    </div>
                                    <div class="flex justify-end gap-4">
                                        <a href="{{ route('admin.categories.posts.index', ['category' => $categoryId] + request()->query()) }}"
                                            class="btn-light btn text-white">@lang('admin.btn.cancel')</a>
                                        <button type="submit" class="btn bg-blue-700 text-white ml-2">
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


        <script>
            function initDropzone(dropzoneId, inputId, options = {}) {
                const dropzone = document.getElementById(dropzoneId);
                const input = document.getElementById(inputId);
                const preview = dropzone.querySelector('.dropzone-preview');
                const content = dropzone.querySelector('.dropzone-content');

                // Click để chọn file
                dropzone.addEventListener('click', () => input.click());

                // Xử lý kéo thả
                dropzone.addEventListener('dragover', (e) => {
                    e.preventDefault();
                    dropzone.classList.add('border-blue-500', 'bg-blue-50/50');
                });

                dropzone.addEventListener('dragleave', () => {
                    dropzone.classList.remove('border-blue-500', 'bg-blue-50/50');
                });

                dropzone.addEventListener('drop', (e) => {
                    e.preventDefault();
                    dropzone.classList.remove('border-blue-500', 'bg-blue-50/50');
                    const file = e.dataTransfer.files[0];
                    if (file) handleFiles(file);
                });

                // Xử lý khi chọn file
                input.addEventListener('change', (e) => {
                    const file = e.target.files[0];
                    if (file) handleFiles(file);
                });

                function handleFiles(file) {
                    // Kiểm tra định dạng
                    if (!validateFileType(file)) {
                        Swal.fire({
                            icon: 'error',
                            title: 'Lỗi',
                            text: `Chỉ chấp nhận file ${options.fileTypes.join(', ')}`
                        });
                        input.value = '';
                        return;
                    }

                    // Kiểm tra dung lượng
                    if (!validateFileSize(file)) {
                        Swal.fire({
                            icon: 'error',
                            title: 'Lỗi',
                            text: `File không được vượt quá ${options.maxSize}MB`
                        });
                        input.value = '';
                        return;
                    }

                    // Hiển thị preview
                    if (options.isImage) {
                        const img = preview.querySelector('img');
                        img.src = URL.createObjectURL(file);
                        img.onload = () => URL.revokeObjectURL(img.src);
                    } else {
                        const fileName = preview.querySelector('.file-name');
                        const fileSize = preview.querySelector('.file-size');
                        fileName.textContent = file.name;
                        fileSize.textContent = formatFileSize(file.size);
                        if (content) content.classList.add('hidden');
                        preview.classList.remove('hidden');
                    }
                }

                // Validate file type
                function validateFileType(file) {
                    return options.accept ? options.accept.includes(file.type) : true;
                }

                // Validate file size
                function validateFileSize(file) {
                    const maxSize = options.maxSize * 1024 * 1024;
                    return file.size <= maxSize;
                }

                // Xử lý xóa file
                const removeButton = preview.querySelector('.remove-file');
                if (removeButton) {
                    removeButton.addEventListener('click', (e) => {
                        e.stopPropagation();
                        input.value = '';
                        if (options.isImage) {
                            // Với ảnh, giữ nguyên preview ảnh cũ
                            preview.querySelector('img').src = preview.querySelector('img').dataset.originalSrc;
                        } else {
                            if (content) content.classList.remove('hidden');
                            preview.classList.add('hidden');
                        }
                    });
                }
            }

            // Khởi tạo khi trang load xong
            document.addEventListener('DOMContentLoaded', () => {
                // Dropzone cho audio
                initDropzone('audioDropzone', 'audioInput', {

                    maxSize: 10,
                    fileTypes: ['.mp3', '.wav', '.ogg']
                });

                // Dropzone cho document
                initDropzone('documentDropzone', 'documentInput', {
                    accept: [
                        'application/pdf',
                        'application/msword',
                        'application/vnd.openxmlformats-officedocument.wordprocessingml.document',
                        'application/vnd.ms-excel',
                        'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet'
                    ],
                    maxSize: 10,
                    fileTypes: ['.pdf', '.doc', '.docx', '.xls', '.xlsx']
                });

                // Dropzone cho image
                initDropzone('imageDropzone', 'imageInput', {
                    accept: ['image/jpeg', 'image/png', 'image/jpg'],
                    maxSize: 10,
                    fileTypes: ['.jpg', '.jpeg', '.png'],
                    isImage: true
                });
            });

            function formatFileSize(bytes) {
                if (bytes === 0) return '0 Bytes';
                const k = 1024;
                const sizes = ['Bytes', 'KB', 'MB', 'GB'];
                const i = Math.floor(Math.log(bytes) / Math.log(k));
                return parseFloat((bytes / Math.pow(k, i)).toFixed(2)) + ' ' + sizes[i];
            }

            function clearSelection() {
                const radioButtons = document.getElementsByName('type');
                radioButtons.forEach(radio => radio.checked = false);
            }
        </script>
    @endpushonce
</x-app-layout>
