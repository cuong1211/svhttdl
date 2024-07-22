<x-app-layout>
    <div class="p-6">
        <div class="text-black text-normal font-semibold leading-tight">
            <span class="text-black text-normal flex items-center gap-2 font-semibold leading-tight">
                @lang('admin.documents.list')
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
                    <form action="{{ route('admin.documents.update', $document->id) }}" method="POST"
                        class="space-y-4 needs-validation" novalidate enctype="multipart/form-data">
                        @csrf
                        @method('PUT') <!-- Đảm bảo sử dụng method PUT hoặc PATCH cho update -->
                        <label class="form-control w-full">
                            <div class="label">
                                <span class="label-text text-base text-black font-medium">@lang('admin.documents.name')</span>
                            </div>
                            <input type="text" name="name" placeholder="Tên văn bản..."
                                value="{{ old('name', $document->name ?? '') }}" @class([
                                    'border',
                                    'border-gray-300',
                                    'bg-white',
                                    'text-black',
                                    'p-2',
                                    'rounded-md',
                                    'input-error' => $errors->has('name'),
                                    'w-full',
                                ]) />
                        </label>
                        <div class="flex gap-4">
                            <input type="hidden" name="user_id" value="{{ auth()->id() }}">
                            <label class="form-control w-full">
                                <span class="label">
                                    <span class="label-text text-base text-black font-medium">@lang('admin.document.reference.number')</span>
                                </span>
                                <input type="text" name="reference_number" placeholder="Ví dụ: 05/KH-SVHTTDL"
                                    @class([
                                        'border',
                                        'border-gray-300',
                                        'bg-white',
                                        'text-black',
                                        'p-2',
                                        'rounded-md',
                                        'input-error' => $errors->has('reference_number'),
                                        'w-full',
                                    ])
                                    value="{{ old('reference_number', $document->reference_number ?? '') }}" />
                            </label>
                            <x-admin.forms.document name="published_at" :publish_at="$document->published_at" />
                        </div>

                        <label class="form-control w-full">
                            <div class="label">
                                <span class="label-text text-base text-black font-medium">@lang('admin.content')</span>
                            </div>
                            <textarea name="content" id="content" class="form-input rounded-md shadow-sm mt-1 block w-full" rows="5">{{ old('content', $post->content ?? '') }}</textarea>

                        </label>
                        <label class="form-control w-full">
                            <div class="label" for="type_id">
                                <span class="label-text text-base text-black font-medium">Loại văn bản</span>
                            </div>
                            <select name="type_id" id="type_id" @class([
                                'border',
                                'border-gray-300',
                                'bg-white',
                                'text-black',
                                'p-2',
                                'rounded-md',
                                'input-error' => $errors->has('type_id'),
                                'w-full',
                            ])>

                                @foreach ($types as $type)
                                    <option value="{{ $type->id }}"
                                        {{ $document->type_id == $type->id ? 'selected' : '' }}>
                                        {{ $type->name }}
                                    </option>
                                @endforeach
                            </select>
                            @error('type_id')
                                <p class="text-red-500 text-xs italic">{{ $message }}</p>
                            @enderror
                        </label>
                        <label class="form-control w-full">
                            <div class="label" for="tag_id">
                                <span class="label-text text-base text-black font-medium">Thể loại</span>
                            </div>
                            <select name="tag_id" id="tag_id" @class([
                                'border',
                                'border-gray-300',
                                'bg-white',
                                'text-black',
                                'p-2',
                                'rounded-md',
                                'input-error' => $errors->has('tag_id'),
                                'w-full',
                            ])>

                                @foreach ($signers as $signer)
                                    <option value="{{ $signer->id }}"
                                        {{ $document->tag_id == $signer->id ? 'selected' : '' }}>
                                        {{ $signer->name }}
                                    </option>
                                @endforeach
                            </select>
                            @error('tag_id')
                                <p class="text-red-500 text-xs italic">{{ $message }}</p>
                            @enderror
                        </label>
                        <label class="form-control w-full">
                            <div class="label">
                                <span class="label-text text-base text-black font-medium">@lang('admin.notes')</span>
                            </div>
                            <input type="text" name="notes" placeholder="Nhập nội dung ghi chú..."
                                @class([
                                    'border',
                                    'border-gray-300',
                                    'bg-white',
                                    'text-black',
                                    'p-2',
                                    'rounded-md',
                                    'input-error' => $errors->has('notes'),
                                    'w-full',
                                ]) value="{{ old('notes', $document->notes ?? '') }}" />
                        </label>
                        <div class="flex items-center space-x-6">
                            <label class="block">
                                <div class="input border-gray-300 text-black p-2 rounded-md bg-white border ">
                                    Tệp tin hiện tại:
                                    @if ($document->getFirstMedia('document_file'))
                                        <a href="{{ $document->getFirstMedia('document_file')->getUrl() }}"
                                            target="_blank">{{ $document->getFirstMedia('document_file')->name }}</a>
                                    @else
                                        <a href="{{ asset('/' . $document->document_file) }}"
                                            target="_blank">{{ $document->document_file }}</a>
                                    @endif
                                </div>
                                <span class="sr-only">Chọn tệp tin...</span>
                                <input type="file" name="document_file" id="document_file" onchange="loadFile(event)"
                                    value="{{ old('document_file', $document->document_file ?? '') }}"
                                    class="file-input file-input-bordered w-full max-w-xs bg-white text-black" />
                            </label>
                        </div>
                        <div class="flex justify-end gap-4">
                            <a href="{{ route('admin.documents.index') }}" class="btn-light btn">
                                @lang('admin.btn.cancel')
                            </a>
                            <button type="submit" class="btn bg-blue-700 text-white ml-2">
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

        <script>
            var loadFile = function(event) {
                var input = event.target
                var file = input.files[0]
                var type = file.type
                const allowedExtensions = /(\.pdf)$/i;
                const maxFileSize = 5 * 1024 * 1024; // 5MB in bytes

                if (!allowedExtensions.exec(input.value)) {
                    Swal.fire({
                        icon: "error",
                        title: "Oops...",
                        text: "Chỉ chấp nhận tệp tin PDF.",
                    });
                    input.value = '';
                    return false;
                }

                if (input.files[0].size > maxFileSize) {
                    Swal.fire({
                        icon: "error",
                        title: "Oops...",
                        text: "Dung lượng tệp tin không được vượt quá 5MB.",
                    });
                    input.value = '';
                    return false;
                }
            }
        </script>
    @endpushonce
</x-app-layout>
