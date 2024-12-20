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
                    <div class="alert alert-error text-black">
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
                                @if (Auth::user()->category_id == 3)
                                    <input type="hidden" name="category_id" value="{{ $category->id }}">
                                @endif
                                <div class="join join-vertical lg:join-horizontal gap-4 w-full">
                                    <label class="join-item form-control w-full">
                                        <div class="label">
                                            <span class="label-text text-base text-black font-medium">
                                                @lang('admin.post.title')
                                            </span>
                                        </div>
                                        <input type="text" name="title" placeholder="Nhập tiêu đề bài viết..."
                                            value="{{ old('title') }}"
                                            class="border border-gray-300 bg-white text-black p-2 rounded-md w-full @error('title') input-error @enderror" />
                                        @error('title')
                                            <div class="text-red-500 text-sm">{{ $message }}</div>
                                        @enderror
                                    </label>
                                    <div class="join-item w-auto">
                                        <x-admin.forms.calendar />
                                    </div>
                                </div>
                                <label class="form-control w-full">
                                    <div class="label">
                                        <span class="label-text text-base text-black font-medium">
                                            Tác giả
                                        </span>
                                    </div>
                                    <input type="text" name="author" placeholder="Nhập tác giả."
                                        value="{{ old('author') }}"
                                        class="border border-gray-300 bg-white text-black p-2 rounded-md w-full @error('author') input-error @enderror" />
                                    @error('author')
                                        <div class="text-red-500 text-sm">{{ $message }}</div>
                                    @enderror
                                </label>
                                <label class="form-control w-full">
                                    <div class="label">
                                        <span class="label-text text-base text-black font-medium">
                                            Tóm tắt
                                        </span>
                                    </div>
                                    <textarea type="text" name="description" placeholder="Nhập tóm tắt bài viết..." value="{{ old('description') }}"
                                        class="border border-gray-300 bg-white text-black p-2 rounded-md w-full @error('description') input-error @enderror">
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
                                    <textarea name="content" id="content" class="form-input rounded-md shadow-sm mt-1 block w-full" rows="5"
                                        @error('content') input-error @enderror>{{ old('content') }}</textarea>
                                    @error('content')
                                        <div class="text-red-500 text-sm">{{ $message }}</div>
                                    @enderror
                                </label>
                                @if (Auth::user()->category_id == 3)
                                @else
                                    <label class="form-control w-full">
                                        <div class="label">
                                            <span class="label-text text-base text-black font-medium">Chọn danh
                                                mục</span>
                                        </div>
                                        <select name="category_id" @class([
                                            'border',
                                            'border-gray-300',
                                            'bg-white',
                                            'text-black',
                                            'p-2',
                                            'rounded-md',
                                            'input-error' => $errors->has('category_id'),
                                            'w-full',
                                        ])>
                                            <option value="">@lang('admin.categories.select_parent')</option>
                                            @foreach ($categories as $category)
                                                <x-admin.forms.select.category_post :category="$category" />
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
                                        <option value="0">Ẩn</option>
                                        <option value="1">Hiển thị</option>

                                    </select>
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
                                                <div class="inline-flex items-center pr-2">
                                                    <input id="{{ $type->value }}" type="radio" name="type"
                                                        value="{{ $type->value }}"
                                                        {{ old('type') == $type->value ?: '' }}
                                                        class="w-4 h-4 text-blue-700 bg-gray-100 border-gray-300 rounded focus:ring-blue-500">
                                                    <label for="{{ $type->value }}"
                                                        class="ms-2 text-black text-base cursor-pointer select-none">
                                                        {{ $type->value == 0 ? 'Tin mới' : 'Tin hot' }}
                                                    </label>
                                                </div>
                                            @endforeach
                                        </div>
                                        <button type="button" onclick="clearSelection()"
                                            class="px-4 py-2 bg-blue-100 text-blue-700 rounded-md hover:bg-blue-200 transition-colors duration-200 text-sm font-medium">
                                            Bỏ chọn
                                        </button>
                                    </div>
                                </label>
                                <!-- Grid layout cho Audio và Document -->
                                <div class="grid grid-cols-2 gap-4 mb-6">
                                    <!-- Audio Upload -->
                                    <div class="form-control w-full ">
                                        <div class="label">
                                            <span class="label-text text-base text-black font-medium">File âm
                                                thanh(tối đa
                                                10mb)</span>
                                        </div>
                                        <div class="relative border border-gray-300 bg-white">
                                            <div id="audioDropzone"
                                                class="dropzone flex flex-col items-center justify-center w-full h-[100px] px-4 py-3 bg-white border-2 border-dashed border-gray-300 rounded-lg hover:bg-gray-50 transition-all cursor-pointer">
                                                <div class="dropzone-content text-center">
                                                    <svg class="mx-auto h-8 w-8 text-gray-400" fill="none"
                                                        stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round"
                                                            stroke-width="2"
                                                            d="M9 19V6l12-3v13M9 19c0 1.105-1.343 2-3 2s-3-.895-3-2 1.343-2 3-2 3 .895 3 2zm12-3c0 1.105-1.343 2-3 2s-3-.895-3-2 1.343-2 3-2 3 .895 3 2zM9 10l12-3" />
                                                    </svg>
                                                    <p class="mt-1 text-sm text-gray-500">MP3, WAV, OGG (Tối đa 10MB)
                                                    </p>
                                                </div>
                                                <div class="dropzone-preview hidden w-full">
                                                    <div
                                                        class="flex items-center justify-between p-2 bg-blue-50 rounded-lg">
                                                        <div class="flex items-center">
                                                            <div>
                                                                <p
                                                                    class="text-sm font-medium text-gray-900 truncate file-name max-w-[150px]">
                                                                    filename.mp3</p>
                                                                <p class="text-xs text-gray-500 file-size">0 MB</p>
                                                            </div>
                                                        </div>
                                                        <button type="button"
                                                            class="remove-file text-gray-400 hover:text-gray-500 ml-2">
                                                            <svg class="w-5 h-5" fill="none" stroke="currentColor"
                                                                viewBox="0 0 24 24">
                                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                                    stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                                                            </svg>
                                                        </button>
                                                    </div>
                                                </div>
                                            </div>
                                            <input type="file" id="audioInput" name="audio"
                                                accept=".mp3,.wav,.ogg" class="hidden" />
                                        </div>
                                    </div>

                                    <!-- Document Upload -->
                                    <div class="form-control w-full">
                                        <div class="label">
                                            <span class="label-text text-base text-black font-medium">File tài
                                                liệu(tối đa
                                                10mb)</span>
                                        </div>
                                        <div class="relative border border-gray-300 bg-white">
                                            <div id="documentDropzone"
                                                class="dropzone flex flex-col items-center justify-center w-full h-[100px] px-4 py-3 bg-white border-2 border-dashed border-gray-300 rounded-lg hover:bg-gray-50 transition-all cursor-pointer">
                                                <div class="dropzone-content text-center">
                                                    <svg class="mx-auto h-8 w-8 text-gray-400" fill="none"
                                                        stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round"
                                                            stroke-width="2"
                                                            d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                                                    </svg>
                                                    <p class="mt-1 text-sm text-gray-500">PDF, DOC, DOCX, XLS, XLSX
                                                        (Tối đa 10MB)</p>
                                                </div>
                                                <div class="dropzone-preview hidden w-full">
                                                    <div
                                                        class="flex items-center justify-between p-2 bg-blue-50 rounded-lg">
                                                        <div class="flex items-center">
                                                            <div>
                                                                <p
                                                                    class="text-sm font-medium text-gray-900 truncate file-name max-w-[150px]">
                                                                    document.pdf</p>
                                                                <p class="text-xs text-gray-500 file-size">0 MB</p>
                                                            </div>
                                                        </div>
                                                        <button type="button"
                                                            class="remove-file text-gray-400 hover:text-gray-500 ml-2">
                                                            <svg class="w-5 h-5" fill="none" stroke="currentColor"
                                                                viewBox="0 0 24 24">
                                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                                    stroke-width="2" d="M6 18L18 6M6 6l12 12" />
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

                                <!-- Image Upload với Preview full size -->
                                <div class="form-control">
                                    <div class="label flex items-center justify-between">
                                        <span class="label-text text-base text-black font-medium">Hình ảnh(tối đa
                                            10mb)</span>
                                        <!-- Thông tin file sẽ hiển thị ở đây khi có ảnh -->
                                        <div class="file-info hidden">
                                            <span class="text-sm text-gray-600 file-name mr-2"></span>
                                            <span class="text-sm text-gray-500 file-size"></span>
                                        </div>
                                    </div>
                                    <div class="relative border border-gray-300 bg-white h-[200px]">
                                        <!-- Giảm chiều cao xuống -->
                                        <div id="imageDropzone" class="dropzone group relative ">
                                            <!-- Content khi chưa có ảnh -->
                                            <div
                                                class="dropzone-content flex flex-col items-center justify-center  text-center p-6 bg-white border-2 border-dashed border-gray-300 rounded-lg hover:bg-gray-50 transition-all cursor-pointer">
                                                <svg class="mx-auto h-12 w-12 text-gray-400" fill="none"
                                                    stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                        stroke-width="2"
                                                        d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                                </svg>
                                                <p class="mt-4 text-gray-600">Kéo thả hình ảnh hoặc click để chọn</p>
                                                <p class="mt-2 text-sm text-gray-500">PNG, JPG, JPEG (Tối đa 10MB)</p>
                                            </div>

                                            <!-- Preview khi có ảnh -->
                                            <div class="dropzone-preview hidden ">
                                                <div
                                                    class="relative flex items-center justify-center  bg-white border-2 border-dashed border-gray-300 rounded-lg p-4">
                                                    <!-- Ảnh preview -->
                                                    <img src="" alt="Preview" class="preview-image"
                                                        style="max-width: 100%; max-height: 100%; object-fit: contain" />

                                                    <!-- Nút xóa -->
                                                    <button type="button"
                                                        class="remove-file absolute top-2 right-2 p-2 text-gray-500 hover:text-gray-700 bg-white rounded-full shadow-sm">
                                                        <svg class="w-5 h-5" fill="none" stroke="currentColor"
                                                            viewBox="0 0 24 24">
                                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                                stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                                                        </svg>
                                                    </button>
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
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
        <script>
            // Format file size helper
            function formatFileSize(bytes) {
                if (bytes === 0) return '0 Bytes';
                const k = 1024;
                const sizes = ['Bytes', 'KB', 'MB', 'GB'];
                const i = Math.floor(Math.log(bytes) / Math.log(k));
                return parseFloat((bytes / Math.pow(k, i)).toFixed(2)) + ' ' + sizes[i];
            }

            // Clear radio selection
            function clearSelection() {
                const radioButtons = document.getElementsByName('type');
                radioButtons.forEach(radio => radio.checked = false);
            }

            function initImageDropzone() {
                const dropzone = document.getElementById('imageDropzone');
                const input = document.getElementById('imageInput');
                const content = dropzone.querySelector('.dropzone-content');
                const preview = dropzone.querySelector('.dropzone-preview');
                const previewImage = preview.querySelector('.preview-image');
                const fileName = preview.querySelector('.file-name');
                const fileSize = preview.querySelector('.file-size');

                // Xử lý khi chọn file
                input.addEventListener('change', (e) => {
                    const file = e.target.files[0];
                    if (file) {
                        handleImageFile(file);
                    }
                });

                function handleImageFile(file) {
                    // Kiểm tra định dạng
                    if (!file.type.match('image.*')) {
                        Swal.fire({
                            icon: 'error',
                            title: 'Lỗi',
                            text: 'Vui lòng chọn file ảnh (PNG, JPG, JPEG)'
                        });
                        return;
                    }

                    // Kiểm tra dung lượng
                    if (file.size > 10 * 1024 * 1024) {
                        Swal.fire({
                            icon: 'error',
                            title: 'Lỗi',
                            text: 'Dung lượng ảnh không được vượt quá 10MB'
                        });
                        return;
                    }

                    // Hiển thị preview
                    const reader = new FileReader();
                    reader.onload = function(e) {
                        previewImage.src = e.target.result;

                        // Cập nhật và hiển thị thông tin file ở label
                        const fileInfo = dropzone.closest('.form-control').querySelector('.file-info');
                        const fileName = fileInfo.querySelector('.file-name');
                        const fileSize = fileInfo.querySelector('.file-size');

                        fileName.textContent = file.name;
                        fileSize.textContent = `(${formatFileSize(file.size)})`;
                        fileInfo.classList.remove('hidden');

                        content.style.display = 'none';
                        preview.style.display = 'block';
                        preview.classList.remove('hidden');
                    }
                    reader.readAsDataURL(file);
                }

                // Xử lý xóa ảnh
                const removeButton = preview.querySelector('.remove-file');
                removeButton.addEventListener('click', (e) => {
                    e.stopPropagation();
                    input.value = '';

                    // Reset và ẩn preview, hiện content
                    previewImage.src = '';
                    preview.style.display = 'none';
                    content.style.display = 'flex';
                    preview.classList.add('hidden');
                    const fileInfo = dropzone.closest('.form-control').querySelector('.file-info');
                    fileInfo.classList.add('hidden');
                });

                // Click để chọn file
                dropzone.addEventListener('click', () => input.click());
            }

            // Khởi tạo dropzone
            function initDropzone(dropzoneId, inputId, options = {}) {
                const dropzone = document.getElementById(dropzoneId);
                const input = document.getElementById(inputId);
                const preview = dropzone.querySelector('.dropzone-preview');
                const content = dropzone.querySelector('.dropzone-content');
                const previewImage = preview.querySelector('.preview-image');
                const fileName = preview.querySelector('.file-name');
                const fileSize = preview.querySelector('.file-size');

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
                    const files = e.dataTransfer.files;
                    if (files.length) {
                        handleFiles(files[0]);
                    }
                });

                // Xử lý khi chọn file
                input.addEventListener('change', (e) => {
                    if (e.target.files.length) {
                        handleFiles(e.target.files[0]);
                    }
                });

                // Xử lý file được chọn
                function handleFiles(file) {
                    // Kiểm tra định dạng file
                    if (!validateFileType(file)) {
                        Swal.fire({
                            icon: 'error',
                            title: 'Lỗi',
                            text: `Chỉ chấp nhận file ${options.fileTypes.join(', ')}`
                        });
                        input.value = '';
                        return;
                    }

                    // Kiểm tra dung lượng file
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
                        const reader = new FileReader();
                        reader.onload = (e) => {
                            previewImage.src = e.target.result;
                            fileName.textContent = file.name;
                            fileSize.textContent = formatFileSize(file.size);
                            content.classList.add('hidden');
                            preview.classList.remove('hidden');
                        };
                        reader.readAsDataURL(file);
                    } else {
                        fileName.textContent = file.name;
                        fileSize.textContent = formatFileSize(file.size);
                        content.classList.add('hidden');
                        preview.classList.remove('hidden');
                    }
                }

                // Validate định dạng file
                function validateFileType(file) {
                    return options.accept ? options.accept.includes(file.type) : true;
                }

                // Validate dung lượng file
                function validateFileSize(file) {
                    const maxSize = options.maxSize * 1024 * 1024; // Convert to bytes
                    return file.size <= maxSize;
                }

                // Xử lý xóa file
                const removeButton = preview.querySelector('.remove-file');
                if (removeButton) {
                    removeButton.addEventListener('click', (e) => {
                        e.stopPropagation();
                        input.value = '';
                        content.classList.remove('hidden');
                        preview.classList.add('hidden');
                        if (previewImage) {
                            previewImage.src = '';
                        }
                        // Thêm hiệu ứng fade
                        preview.style.opacity = '0';
                        setTimeout(() => {
                            preview.style.opacity = '1';
                        }, 200);
                    });
                }
            }

            // Khởi tạo tất cả dropzone khi trang load xong
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

                initImageDropzone();
            });

            // Xử lý form submit
            document.querySelector('form').addEventListener('submit', async (e) => {
                e.preventDefault();

                try {
                    // Kiểm tra các file input
                    const inputs = {
                        'audioInput': {
                            maxSize: 10,
                            name: 'âm thanh'
                        },
                        'documentInput': {
                            maxSize: 10,
                            name: 'tài liệu'
                        },
                        'imageInput': {
                            maxSize: 10,
                            name: 'ảnh'
                        }
                    };

                    for (const [inputId, config] of Object.entries(inputs)) {
                        const input = document.getElementById(inputId);
                        if (input.files.length > 0) {
                            const file = input.files[0];
                            if (file.size > config.maxSize * 1024 * 1024) {
                                throw new Error(`File ${config.name} không được vượt quá ${config.maxSize}MB`);
                            }
                        }
                    }

                    // Submit form nếu validate thành công
                    e.target.submit();

                } catch (error) {
                    Swal.fire({
                        icon: 'error',
                        title: 'Lỗi',
                        text: error.message
                    });
                }
            });
        </script>
    @endpushonce
</x-app-layout>
