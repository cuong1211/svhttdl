<x-app-layout>
    <div class="p-6">
        <div class="text-gray-800 text-normal font-semibold leading-tight">
            <span class="text-gray-800 text-normal flex items-center gap-2 font-semibold leading-tight">
                @lang('admin.album')
                <x-heroicon-m-arrow-small-right class="size-4" />
                @lang('admin.edit')
            </span>
        </div>
        <div class="mt-6">
            <div class="overflow-hidden bg-white p-6 sm:rounded-lg">
                <form
                    action="{{ route('admin.albums.update', ['album' => $album->id]) }}"
                    method="POST"
                    class="space-y-4 needs-validation"
                    novalidate>
                        @csrf
                        @method('patch')
                        <label class="form-control w-full">
                            <div class="label">
                                <span class="label-text">@lang('admin.albums.name')</span>
                            </div>
                            <input
                                type="text"
                                name="name"
                                placeholder="Type here"
                                value="{{ old('name', $album->name) }}"
                                @class([
                                    'input',
                                    'input-bordered',
                                    'input-error' => $errors->has('name'),
                                    'w-full',
                                ])
                            />
                        </label>
                        <label class="form-control w-full">
                                <div class="label">
                                    <span class="label-text">@lang('admin.albums.type')</span>
                                </div>
                                <select
                                    name="type"
                                    required
                                    @class([
                                        'input',
                                        'input-bordered',
                                        'input-error' => $errors->has('type'),
                                        'w-full',
                                    ])
                                >
                                    @foreach (App\Enums\AlbumTypeEnum::cases() as $type)
                                        <option
                                            value="{{ $type->value }}"
                                            {{ $album->type == $type ? 'selected' : '' }}
                                        >
                                            @lang('admin.' . $type->value )
                                        </option>
                                    @endforeach
                                </select>
                            </label>
                        <div class="flex justify-end gap-4">
                            <a
                                href="{{ route('admin.albums.index') }}"
                                class="btn-light btn"
                                >@lang('admin.btn.cancel')
                            </a>
                            <button
                                type="submit"
                                class="btn btn-success ml-2"
                            >
                                @lang('admin.btn.submit')
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
