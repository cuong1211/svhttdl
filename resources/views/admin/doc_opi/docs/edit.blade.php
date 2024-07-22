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
                    <form action="{{ route('admin.docs-opis.update', $docs->id) }}" method="POST"
                        class="space-y-4 needs-validation" novalidate enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="join join-vertical lg:join-horizontal gap-4 w-full">
                            <label class="form-control w-full">
                                <div class="label">
                                    <span class="label-text text-base text-black font-medium">@lang('admin.documents.name')</span>
                                </div>
                                <input type="text" name="name" placeholder="Tên văn bản..."
                                    value="{{ $docs->name }}" @class([
                                        'border',
                                        'border-gray-300',
                                        'bg-white',
                                        'text-black',
                                        'p-2',
                                        'rounded-md',
                                        'input-error' => $errors->has('name'),
                                        'w-full',
                                    ]) />
                                <div class="flex items-center space-x-6">
                                    <label class="block">

                                        <div class="label">
                                            <span class="label-text text-base text-black font-medium">Tệp tin</span>
                                        </div>
                                        <div class="input border-gray-300 text-black p-2 rounded-md bg-white border ">
                                            Tệp tin hiện tại:
                                            @if ($docs->getFirstMedia('document_file'))
                                                <a class="text-black"
                                                    href="{{ $docs->getFirstMedia('document_file')->getUrl() }}"
                                                    target="_blank">{{ $docs->getFirstMedia('document_file')->name }}</a>
                                            @else
                                                <a href="{{ asset('/' . $docs->document_file) }}"
                                                    target="_blank">{{ $docs->document_file }}</a>
                                            @endif
                                        </div>
                                        <span class="sr-only">Chọn tệp tin...</span>
                                        <input type="file" name="document_file" id="document_file"
                                            value="{{ $docs->document_file }}"
                                            class="file-input file-input-bordered w-full max-w-xs bg-white text-black" />
                                    </label>
                                </div>
                            </label>
                            <div class="join-item">
                                <label class="form-control w-full">
                                    <div class="gap-5 join join-vertical md:join-horizontal">
                                        <x-admin.forms.document :field="'document.start_at'" :name="'start_at'" :publish_at="$docs->start_date" />
                                    </div>
                                </label>
                                <label class="form-control w-full">
                                    <div class="gap-5 join join-vertical md:join-horizontal">
                                        <x-admin.forms.document_end :field="'document.end_at'" :name="'end_at'"
                                            :publish_at="$docs->end_date" />
                                    </div>
                                </label>
                            </div>
                        </div>
                        <label class="form-control w-full">
                            <div class="label">
                                <span class="label-text text-base text-black font-medium">@lang('admin.content')</span>
                            </div>
                            <textarea name="content" id="content" class="form-input rounded-md shadow-sm mt-1 block w-full" rows="5">
{!! $docs->content->tohtml() !!}</textarea>

                        </label>
                        <label class="form-control w-full">
                            <div class="label">
                                <span class="label-text text-base text-black font-medium">@lang('admin.notes')</span>
                            </div>
                            <input type="text" name="note" placeholder="Nhập nội dung ghi chú..."
                                @class([
                                    'border',
                                    'border-gray-300',
                                    'bg-white',
                                    'text-black',
                                    'p-2',
                                    'rounded-md',
                                    'input-error' => $errors->has('note'),
                                    'w-full',
                                ]) value="{{ old('note', $docs->notes ?? '') }}" />
                        </label>

                        <div class="flex justify-end gap-4">
                            <a href="{{ route('admin.documents.index') }}" class="btn-light text-white btn">
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
