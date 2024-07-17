<x-app-layout>
    <div class="p-6">
        <div class="text-black text-normal font-semibold leading-tight">
            <span class="text-black text-normal flex items-center gap-2 font-semibold leading-tight">
                @lang('admin.documents.list')
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
                    <form action="{{ route('admin.documents.store') }}" method="POST" class="space-y-4 needs-validation"
                        novalidate enctype="multipart/form-data">
                        @csrf
                        <label class="form-control w-full">
                            <div class="label">
                                <span class="label-text text-base text-black font-medium">@lang('admin.documents.name')</span>
                            </div>
                            <input type="text" name="name" placeholder="Tên văn bản..."
                                value="{{ old('name') }}" @class([
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
                                    ]) value="{{ old('reference_number') }}" />
                            </label>
                            <x-admin.forms.document name="published_at" value="{{ old('published_at') }}" />
                        </div>

                        <label class="form-control w-full">
                            <div class="label">
                                <span class="label-text text-base text-black font-medium">@lang('admin.content')</span>
                            </div>
                            <textarea name="content" id="content" class="form-input rounded-md shadow-sm mt-1 block w-full" rows="5">{{ old('content', $post->content ?? '') }}</textarea>

                        </label>

                        <label class="form-control w-full">
                            <div class="label" for="type_id">
                                <span class="label-text text-base text-black font-medium">@lang('admin.documents.types')</span>
                            </div>
                            <select name="type_id" required @class([
                                'border',
                                'border-gray-300',
                                'bg-white',
                                'text-black',
                                'p-2',
                                'rounded-md',
                                'input-error' => $errors->has('type_id'),
                                'w-full',
                            ])>
                                <option value="">Chọn loại văn bản </option>
                                @foreach ($types as $type)
                                    <option value="{{ $type->id }}"
                                        {{ old('type_id') == $type->id ? 'selected' : '' }}>{{ $type->name }}</option>
                                @endforeach
                            </select>
                        </label>
                        <label class="form-control w-full">
                            <div class="label" for="tag_id">
                                <span class="label-text text-base text-black font-medium">@lang('admin.documents.signers')</span>
                            </div>
                            <select name="tag_id" required @class([
                                'border',
                                'border-gray-300',
                                'bg-white',
                                'text-black',
                                'p-2',
                                'rounded-md',
                                'input-error' => $errors->has('tag_id'),
                                'w-full',
                            ])>
                                <option value="">Chọn thể loại </option>
                                @foreach ($signers as $signer)
                                    <option value="{{ $signer->id }}"
                                        {{ old('tag_id') == $signer->id ? 'selected' : '' }}>{{ $signer->name }}
                                    </option>
                                @endforeach
                            </select>
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
                                <div class="label">
                                    <span class="label-text text-base text-black font-medium">File văn bản</span>
                                </div>
                                <span class="sr-only">Chọn tệp tin...</span>
                                <input type="file" name="document_file" onchange="loadFile(event)"
                                    value="{{ old('image', $document->document_file ?? '') }}"
                                    class="file:bg-violet-50 file:text-violet-700 hover:file:bg-violet-100 block w-full text-sm text-slate-500 file:mr-4 file:rounded-full file:border-0 file:px-4 file:py-2 file:text-sm file:font-semibold" />
                            </label>
                        </div>
                        <div class="flex justify-end gap-4">
                            <a href="{{ route('admin.documents.index') }}" class="btn-light btn text-white">
                                @lang('admin.btn.cancel')
                            </a>
                            <button type="submit" class="btn bg-blue-700 text-white ml-2 ">
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
                const allowedExtensions = /(\.pdf|\.doc)$/i;
                const maxFileSize = 5 * 1024 * 1024; // 5MB in bytes

                if (!allowedExtensions.exec(input.value)) {
                    alert('Vui lòng chọn tệp tin định dạng .pdf hoặc .doc.');
                    input.value = '';
                    return false;
                }

                if (input.files[0].size > maxFileSize) {
                    alert('Tệp tin tải lên không được vượt quá 5MB.');
                    input.value = '';
                    return false;
                }
            }
        </script>
    @endpushonce
</x-app-layout>
