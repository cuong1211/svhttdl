<x-app-layout>
    <div class="p-6">
        <div class="text-gray-800 text-normal font-semibold leading-tight">
            <span class="text-gray-800 text-normal flex items-center gap-2 font-semibold leading-tight">
                @lang('admin.documents.list')
            </span>
        </div>
        @if (session('icon') && session('heading') && session('message'))
        <div class="alert alert-{{ session('icon') === 'success' ? 'success' : 'danger' }}" role="alert">
            <strong>{{ session('heading') }}:</strong>
            {{ session('message') }}
        </div>
    @endif
        <div class="mt-6">
            <div class="overflow-hidden bg-white shadow-sm sm:rounded-lg">
                <div class="overflow-x-auto">
                    <div class="flex px-6 py-4">
                        <form action="{{ route('admin.documents.index') }}" method="GET" class="w-full">
                            <div class="flex items-center justify-between">
                                <div class="flex items-center">
                                    <label class="input input-bordered flex items-center gap-2">
                                        <input name="search" type="text" class="grow"
                                            placeholder="Search by name" style="border: unset"
                                            value="{{ request()->search }}" />
                                        <button type="submit">
                                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 16 16"
                                                fill="currentColor" class="h-4 w-4 opacity-70">
                                                <path fill-rule="evenodd"
                                                    d="M9.965 11.026a5 5 0 1 1 1.06-1.06l2.755 2.754a.75.75 0 1 1-1.06 1.06l-2.755-2.754ZM10.5 7a3.5 3.5 0 1 1-7 0 3.5 3.5 0 0 1 7 0Z"
                                                    clip-rule="evenodd" />
                                            </svg>
                                        </button>
                                    </label>
                                </div>
                                <a class="btn-ghosdt btn" href="{{ route('admin.documents.create') }}">
                                    <x-heroicon-s-plus class="size-4" />
                                    <span>@lang('admin.add')</span>
                                </a>
                            </div>
                        </form>
                    </div>
                    <table class="table">
                        <!-- head -->
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>@lang('admin.documents.name')</th>
                                <th>@lang('admin.documents.types')</th>
                                <th>@lang('admin.documents.signers')</th>
                                <th>@lang('admin.created_at')</th>
                                <th>@lang('admin.updated_at')</th>
                                <th>@lang('admin.funtion')</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($documents as $document)
                                <tr>
                                    <th>
                                        {{ $loop->index + 1 }}
                                    </th>
                                    <td>{{ $document->name }}</td>
                                    <td>{{ optional($document->types)->name }}</td>
                                    <td>{{ optional($document->signers)->name }}</td>
                                    <td>{{ $document->createdAtVi }}</td>
                                    <td>{{ $document->updatedAtVi }}</td>

                                    <td class="flex gap-3">
                                        <a href="{{ route('admin.documents.edit', $document->id) }}"><x-heroicon-s-pencil-square
                                                class="size-4 text-green-600" /></a>
                                        <form id="delete-form-{{ $document->id }}"
                                            action="{{ route('admin.documents.destroy', ['document' => $document->id]) }}"
                                            method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <button type="button" onclick="confirmDelete({{ $document->id }})">
                                                <x-heroicon-o-trash class="size-4 text-red-500" />
                                            </button>
                                        </form>

                                        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
                                        <script>
                                            $(document).ready(function() {
                                                setTimeout(function() {
                                                    $(".alert").fadeOut(2000);
                                                }, 3000); // thông báo sẽ ẩn sau 3 giây
                                            });

                                            function confirmDelete(categoryId) {
                                                if (confirm('Are you sure you want to delete this category?')) {
                                                    document.getElementById('delete-form-' + categoryId).submit();
                                                }
                                            }
                                        </script>

                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <div class="mt-4">
            {{--            {{ $documents->links('pagination.web-tailwind') }} --}}
        </div>
    </div>
</x-app-layout>
