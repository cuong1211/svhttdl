<x-app-layout>
    <div class="p-6">
        <div class="text-black text-normal font-semibold leading-tight">
            <span class="text-black text-normal flex items-center gap-2 font-semibold leading-tight">
                @lang('admin.signers.list')
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
                    <form action="{{ route('admin.signers.store') }}" method="POST" class="space-y-4 needs-validation"
                        novalidate>
                        @csrf
                        <label class="form-control w-full">
                            <div class="label">
                                <span class="label-text text-base text-black font-medium">@lang('admin.signers.name')</span>
                            </div>
                            <input type="text" name="name" placeholder="Tên thể loại..."
                                @class([
                                    'border',
                                    'border-gray-300',
                                    'bg-white',
                                    'text-black',
                                    'p-2',
                                    'rounded-md',
                                    'input-error' => $errors->has('name'),
                                    'w-full',
                                ]) value="{{ old('name') }}" />
                        </label>
                        <label class="form-control w-full">
                            <div class="label">
                                <span class="label-text text-base text-black font-medium">@lang('admin.signers.description')</span>
                            </div>
                            <textarea name="description" id="description" cols="30" rows="10" @class([
                                'border',
                                'border-gray-300',
                                'bg-white',
                                'text-black',
                                'p-2',
                                'rounded-md',
                                'input-error' => $errors->has('description'),
                                'w-full',
                            ])>{!! old('description') !!}</textarea>

                        </label>

                        <div class="flex justify-end gap-4">
                            <a href="{{ route('admin.signers.index',request()->query()) }}" class="btn-light btn">
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
</x-app-layout>
