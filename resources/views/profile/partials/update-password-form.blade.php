<section>
    <header>
        <h2 class="text-gray-900 text-lg font-medium">
            @lang('admin.update_password')
        </h2>

        <p class="text-gray-600 mt-1 text-sm">
            {{ __('Đảm bảo tài khoản của bạn đang sử dụng mật khẩu dài, ngẫu nhiên để giữ an toàn.') }}
        </p>
    </header>

    <form method="post" action="{{ route('password.update') }}" class="mt-6 space-y-6">
        @csrf
        @method('PUT')
@foreach (request()->query() as $key => $value)
                            <input type="hidden" name="{{ $key }}" value="{{ $value }}">
                        @endforeach

        <div>
            <x-input-label for="update_password_current_password" :value="__('Mật khẩu hiện tại')" class="font-semibold" />
            <x-text-input id="update_password_current_password" name="current_password" type="password"
                class="mt-1 block w-full" autocomplete="current-password" />
            <x-input-error :messages="$errors->updatePassword->get('current_password')" class="mt-2" />
        </div>

        <div>
            <x-input-label for="update_password_password" :value="__('Mật khẩu mới')" class="font-semibold" />
            <x-text-input id="update_password_password" name="password" type="password" class="mt-1 block w-full"
                autocomplete="new-password" />
            <x-input-error :messages="$errors->updatePassword->get('password')" class="mt-2" />
        </div>

        <div>
            <x-input-label for="update_password_password_confirmation" :value="__('Nhập lại mật khẩu')" class="font-semibold" />
            <x-text-input id="update_password_password_confirmation" name="password_confirmation" type="password"
                class="mt-1 block w-full" autocomplete="new-password" />
            <x-input-error :messages="$errors->updatePassword->get('password_confirmation')" class="mt-2" />
        </div>

        <div class="flex items-center gap-4">
            <x-primary-button>{{ __('Lưu') }}</x-primary-button>

            @if (session('status') === 'password-updated')
                <p x-data="{ show: true }" x-show="show" x-transition x-init="setTimeout(() => (show = false), 2000)"
                    class="text-gray-600 text-sm">
                    {{ __('Đã lưu.') }}
                </p>
            @endif
        </div>
    </form>
</section>
