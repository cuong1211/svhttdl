{{-- duck --}}
<x-app-layout>
    <div class="p-6">
        <div class="text-black text-normal font-semibold leading-tight">
            <span class="text-black text-normal flex items-center gap-2 font-semibold leading-tight">
                @lang('admin.categories.list')
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
                    <form action="{{ route('admin.menus.update', $selectedMenu) }}" method="POST"
                        class="space-y-4 needs-validation" novalidate>
                        @csrf
                        @method('PUT')
                        @foreach (request()->query() as $key => $value)
                            <input type="hidden" name="{{ $key }}" value="{{ $value }}">
                        @endforeach
                        @error('title')
                            <div class="alert alert-error">
                                {{ $message }}
                            </div>
                            @endif
                            <input type="hidden" name="user_id" value="{{ auth()->id() }}">
                            <label class="form-control w-full">
                                <div class="label">
                                    <span class="label-text text-base text-black font-medium">@lang('admin.menus.order')</span>
                                </div>
                                <input type="number" min="0" max="99" name="order"
                                    value="{{ $selectedMenu->order }}" @class([
                                        'border',
                                        'border-gray-300',
                                        'bg-white',
                                        'text-black',
                                        'p-2',
                                        'rounded-md',
                                        'input-error' => $errors->has('order'),
                                        'w-full',
                                    ]) />
                            </label>

                            <label class="form-control w-full">
                                <div class="label">
                                    <span class="label-text text-base text-black font-medium">@lang('admin.categories.title')</span>
                                </div>
                                <input type="text" name="title" value="{{ $selectedMenu->title }}"
                                    @class([
                                        'border',
                                        'border-gray-300',
                                        'bg-white',
                                        'text-black',
                                        'p-2',
                                        'rounded-md',
                                        'input-error' => $errors->has('title'),
                                        'w-full',
                                    ]) />
                            </label>

                            <label class="form-control w-full">
                                <div class="label">
                                    <span class="label-text text-base text-black font-medium">@lang('admin.menus.title_en')</span>
                                </div>
                                <input type="text" name="title_en" value="{{ $selectedMenu->title_en }}"
                                    @class([
                                        'border',
                                        'border-gray-300',
                                        'bg-white',
                                        'text-black',
                                        'p-2',
                                        'rounded-md',
                                        'input-error' => $errors->has('title_en'),
                                        'w-full',
                                    ]) />
                            </label>
                            <label class="form-control w-full">
                                <div class="label">
                                    <span class="label-text text-base text-black font-medium">@lang('admin.menus.url')</span>
                                </div>
                                <input type="text" name="link" placeholder="Url" @class([
                                    'border',
                                    'border-gray-300',
                                    'bg-white',
                                    'text-black',
                                    'p-2',
                                    'rounded-md',
                                    'input-error' => $errors->has('link'),
                                    'w-full',
                                ])
                                    value="{{ $selectedMenu->link }}" />
                            </label>
                            <label class="form-control w-full">
                                <div class="label">
                                    <span class="label-text text-base text-black font-medium">@lang('admin.categories.parent')</span>
                                </div>
                                <select name="parent_id" @class([
                                    'border',
                                    'border-gray-300',
                                    'bg-white',
                                    'text-black',
                                    'p-2',
                                    'rounded-md',
                                    'w-full',
                                ])>
                                    <option value="">@lang('admin.categories.select_parent')</option>
                                    @foreach ($menus as $category)
                                        <x-admin.forms.select.category :category="$category" :selectedCategory="$selectedMenu" />
                                    @endforeach
                                </select>
                            </label>

                            <label class="form-control w-full">
                                <div class="label">
                                    <span class="label-text text-base text-black font-medium">@lang('admin.categories.in_menu')</span>
                                </div>
                                <select name="in_menu" @class([
                                    'border',
                                    'border-gray-300',
                                    'bg-white',
                                    'text-black',
                                    'p-2',
                                    'rounded-md',
                                    'w-full',
                                ])>
                                    <option value="0" {{ $selectedMenu->in_menu ? 'selected' : '' }}>
                                        @lang('admin.false')
                                    </option>
                                    <option value="1" {{ $selectedMenu->in_menu ? 'selected' : '' }}>
                                        @lang('admin.true')
                                    </option>
                                </select>
                            </label>

                            <div class="flex justify-end gap-4">
                                <a href="{{ route('admin.menus.index', request()->query()) }}"
                                    class="btn-light btn text-white">@lang('admin.btn.cancel')</a>
                                <button type="submit" class="btn bg-blue-700 text-white ml-2">@lang('admin.btn.submit')</button>
                            </div>
                        </form>

                    </div>
                </div>
            </div>
        </div>
    </x-app-layout>
