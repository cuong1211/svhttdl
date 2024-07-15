<x-app-layout>
    <div class="p-6">
        <div class="text-black text-normal font-semibold leading-tight">
            <span class="text-black text-normal flex items-center gap-2 font-semibold leading-tight">
                @lang('admin.staffs.list')
                <x-heroicon-m-arrow-small-right class="size-4" />
                @lang('admin.edit')
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
                <div class="bg-white px-8 pb-8 pt-0 shadow sm:rounded-lg">
                    <form action="{{ route('admin.users.update', $user->id) }}" method="POST"
                        class="space-y-4 needs-validation" novalidate enctype="multipart/form-data">
                        @csrf
                        @method('PUT') <!-- Đảm bảo sử dụng method PUT hoặc PATCH cho update -->
                        <label class="form-control w-full">
                            <div class="label">
                                <span class="label-text text-base text-black font-medium">@lang('admin.staffs.name')</span>
                            </div>
                            <input type="text" name="name" value="{{ old('name', $user->name) }}"
                                placeholder="name..." @class([
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
                        <label class="form-control w-full">
                            <div class="label">
                                <span class="label-text text-base text-black font-medium">Tên hiển thị</span>
                            </div>
                            <input type="text" name="display_name"
                                value="{{ old('display_name', $user->display_name) }}" @class([
                                    'border',
                                    'border-gray-300',
                                    'bg-white',
                                    'text-black',
                                    'p-2',
                                    'rounded-md',
                                    'input-error' => $errors->has('display_name'),
                                    'w-full',
                                ]) />
                            @error('display_name')
                                <p class="text-red-500 text-xs italic">{{ $message }}</p>
                            @enderror
                        </label>
                        <label class="form-control w-full">
                            <div class="label">
                                <span class="label-text text-base text-black font-medium">Email</span>
                            </div>
                            <input type="text" name="email" value="{{ old('email', $user->email) }}"
                                @class([
                                    'border',
                                    'border-gray-300',
                                    'bg-white',
                                    'text-black',
                                    'p-2',
                                    'rounded-md',
                                    'input-error' => $errors->has('email'),
                                    'w-full',
                                ]) />
                            @error('email')
                                <p class="text-red-500 text-xs italic">{{ $message }}</p>
                            @enderror
                        </label>
                        <label class="form-control w-full">
                            <div class="label" for="departments">
                                <span class="label-text text-base text-black font-medium">@lang('admin.departments')</span>
                            </div>
                            <select name="department_id" id="departments" @class([
                                'border',
                                'border-gray-300',
                                'bg-white',
                                'text-black',
                                'p-2',
                                'rounded-md',
                                'input-error' => $errors->has('department_id'),
                                'w-full',
                            ])>
                                <option value="0">Chọn phòng ban</option>
                                @foreach ($departments as $department)
                                    <option value="{{ $department->id }}"
                                        {{ $user->department_id == $department->id ? '' : 'selected' }}>
                                        {{ $department->name }}</option>
                                @endforeach
                            </select>
                            @error('department_id')
                                <p class="text-red-500 text-xs italic">{{ $message }}</p>
                            @enderror
                        </label>
                        <label class="form-control w-full">
                            <div class="label" for="category_id">
                                <span class="label-text text-base text-black font-medium">Loại tài khoản</span>
                            </div>
                            <select name="category_id" id="category_id" @class([
                                'border',
                                'border-gray-300',
                                'bg-white',
                                'text-black',
                                'p-2',
                                'rounded-md',
                                'input-error' => $errors->has('category_id'),
                                'w-full',
                            ])>
                                <option value="0">Chọn</option>
                                @foreach ($role as $role)
                                    <option value="{{ $role->id }}"
                                        {{ $user->category_id == $role->id ? '' : 'selected' }}>
                                        {{ $role->name }}
                                    </option>
                                @endforeach
                            </select>
                            @error('category_id')
                                <p class="text-red-500 text-xs italic">{{ $message }}</p>
                            @enderror
                        </label>
                        <label class="form-control w-full">
                            <div class="label" for="state">
                                <span class="label-text text-base text-black font-medium">Trạng thái</span>
                            </div>
                            <select name="state" id="state" @class([
                                'border',
                                'border-gray-300',
                                'bg-white',
                                'text-black',
                                'p-2',
                                'rounded-md',
                                'input-error' => $errors->has('state'),
                                'w-full',
                            ])>
                                <option value="0" {{ $user->state == 0 ? '' : 'selected' }}>Ẩn</option>
                                <option value="1" {{ $user->state == 1 ? '' : 'selected' }}>Kích hoạt</option>
                            </select>
                            @error('state')
                                <p class="text-red-500 text-xs italic">{{ $message }}</p>
                            @enderror
                        </label>
                        <label class="form-control w-full">
                            <div class="label">
                                <span class="label-text text-base text-black font-medium">Mật khẩu</span>
                            </div>
                            <input type="text" name="password" placeholder="Mật khẩu..."
                                @class([
                                    'border',
                                    'border-gray-300',
                                    'bg-white',
                                    'text-black',
                                    'p-2',
                                    'rounded-md',
                                    'input-error' => $errors->has('password'),
                                    'w-full',
                                ]) />
                        </label>
                        <label class="form-control w-full">
                            <div class="label">
                                <span class="label-text text-base text-black font-medium">Nhập lại mật khẩu</span>
                            </div>
                            <input type="text" name="password_confirmation" placeholder="Nhập lại mật khẩu..."
                                @class([
                                    'border',
                                    'border-gray-300',
                                    'bg-white',
                                    'text-black',
                                    'p-2',
                                    'rounded-md',
                                    'input-error' => $errors->has('password_confirmation'),
                                    'w-full',
                                ]) />
                        </label>
                        <label class="form-control w-full">
                            <div class="label">
                                <span class="label-text text-base text-black font-medium">SĐT</span>
                            </div>
                            <input type="text" name="phone" value="{{ old('phone', $user->phone) }}"
                                @class([
                                    'border',
                                    'border-gray-300',
                                    'bg-white',
                                    'text-black',
                                    'p-2',
                                    'rounded-md',
                                    'input-error' => $errors->has('phone'),
                                    'w-full',
                                ]) />
                        </label>
                        <label class="form-control w-full">
                            <div class="label">
                                <span class="label-text text-base text-black font-medium">Địa chỉ</span>
                            </div>
                            <input type="text" name="address" value="{{ old('address', $user->address) }}"
                                @class([
                                    'border',
                                    'border-gray-300',
                                    'bg-white',
                                    'text-black',
                                    'p-2',
                                    'rounded-md',
                                    'input-error' => $errors->has('address'),
                                    'w-full',
                                ]) />
                        </label>
                        <div class="flex justify-end gap-4">
                            <a href="{{ route('admin.users.index') }}" class="btn-light btn">
                                @lang('admin.btn.cancel')
                            </a>
                            <button type="submit" class="btn bg-blue-700 text-white ml-2 text-white">
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

                var output = document.getElementById('preview_img')

                output.src = URL.createObjectURL(event.target.files[0])
                output.onload = function() {
                    URL.revokeObjectURL(output.src) // free memory
                }
            }
        </script>
    @endpushonce
</x-app-layout>
