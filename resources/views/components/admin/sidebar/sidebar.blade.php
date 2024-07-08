<aside class="w-80 flex-none overflow-y-auto bg-blue-700 transition-width" id="sidebar">
    <div class="h-auto items-end border-blue-950 text-white">
        <h1 class="sticky top-0 flex items-center divide-x bg-blue-900 p-3 shadow">
            <span class="font-roboto text-xl font-extrabold tracking-wider">Sở-VHTTDL</span>
            <span class="text-blue-500"> Quản trị hệ thống</span>
        </h1>

        <div class="p-2">
            <ul class="menu w-full rounded-box">
                @if (Auth::user()->category_id == 1)
                    <li><a href="{{ route('dashboard') }}">@lang('admin.dashboard')</a></li>
                    <li>
                        <a @class([
                            'active' => request()->routeIs('admin.announcements.*'),
                        ]) href="{{ route('admin.announcements.index') }}">
                            @lang('admin.announcements')
                        </a>
                    </li>
                    <li>
                        <details @if (request()->routeIs('admin.categories.*', 'admin.posts.*')) open @endif
                            class="{{ request()->routeIs('admin.categories.*', 'admin.posts.*') ? 'active' : '' }}">
                            <summary>@lang('admin.categories')</summary>
                            <ul class="menu">
                                <li>
                                    <a class="{{ request()->routeIs('admin.categories.index') ? 'active' : '' }}"
                                        href="{{ route('admin.categories.index') }}">
                                        @lang('admin.categories.list')
                                    </a>
                                </li>
                                @foreach ($categories as $category)
                                    <x-admin.sidebar.category :category="$category" />
                                @endforeach

                            </ul>
                        </details>
                    </li>
                    <li>
                        <details @if (request()->routeIs('admin.albums.*', 'admin.photos.*', 'admin.videos.*', 'admin.cooperations.*')) open @endif
                            class="{{ request()->routeIs('admin.albums.*', 'admin.photos.*', 'admin.videos.*', 'admin.cooperations.*') ? 'open' : '' }}">
                            <summary>@lang('admin.album')</summary>
                            <ul>
                                <li>
                                    <a class="{{ request()->routeIs('admin.albums.*') ? 'active' : '' }}"
                                        href="{{ route('admin.albums.index') }}">
                                        @lang('admin.albums.all')
                                    </a>
                                </li>
                                <li>
                                    <a class="{{ request()->routeIs('admin.photos.*') ? 'active' : '' }}"
                                        href="{{ route('admin.photos.index') }}">
                                        @lang('admin.photos.all')
                                    </a>
                                </li>
                                <li>
                                    <a class="{{ request()->routeIs('admin.videos.*') ? 'active' : '' }}"
                                        href="{{ route('admin.videos.index') }}">
                                        @lang('admin.videos.all')
                                    </a>
                                </li>
                                <li>
                                    <a class="{{ request()->routeIs('admin.cooperations.*') ? 'active' : '' }}"
                                        href="{{ route('admin.cooperations.index') }}">
                                        @lang('admin.cooperations.all')
                                    </a>
                                </li>
                            </ul>
                        </details>
                    </li>
                    <li>
                        <details @if (request()->routeIs('admin.departments.*', 'admin.staffs.*', 'admin.positions.*')) open @endif
                            class="{{ request()->routeIs('admin.departments.*', 'admin.staffs.*', 'admin.positions.*') ? 'open' : '' }}">
                            <summary>@lang('admin.teaching_staff')</summary>
                            <ul>
                                <li>
                                    <a class="{{ request()->routeIs('admin.staffs.*') ? 'active' : '' }}"
                                        href="{{ route('admin.staffs.index') }}">
                                        @lang('admin.staffs.list')
                                    </a>
                                </li>
                                <li>
                                    <a class="{{ request()->routeIs('admin.departments.*') ? 'active' : '' }}"
                                        href="{{ route('admin.departments.index') }}">
                                        @lang('admin.departments.list')
                                    </a>
                                </li>
                                <li>
                                    <a class="{{ request()->routeIs('admin.positions.*') ? 'active' : '' }}"
                                        href="{{ route('admin.positions.index') }}">
                                        @lang('admin.positions.list')
                                    </a>
                                </li>
                            </ul>
                        </details>
                    </li>
                    <li>
                        <a @class([
                            'active' => request()->routeIs('admin.contacts.*'),
                        ]) href="{{ route('admin.contacts.index') }}">
                            @lang('admin.contacts')
                        </a>
                    </li>
                    <li>
                        <a @class([
                            'active' => request()->routeIs('admin.faqs.*'),
                        ]) href="{{ route('admin.faqs.index') }}">
                            @lang('admin.faqs')
                        </a>
                    </li>
                    <li>
                        <details @if (request()->routeIs('admin.types.*', 'admin.documents.*', 'admin.signers.*')) open @endif
                            class="{{ request()->routeIs('admin.types.*', 'admin.documents.*', 'admin.signers.*') ? 'open' : '' }}">
                            <summary>@lang('admin.document')</summary>
                            <ul>
                                <li>
                                    <a class="{{ request()->routeIs('admin.documents.*') ? 'active' : '' }}"
                                        href="{{ route('admin.documents.index') }}">
                                        @lang('admin.documents.list')
                                    </a>
                                </li>
                                <li>
                                    <a class="{{ request()->routeIs('admin.types.*') ? 'active' : '' }}"
                                        href="{{ route('admin.types.index') }}">
                                        @lang('admin.types.list')
                                    </a>
                                </li>
                                <li>
                                    <a class="{{ request()->routeIs('admin.signers.*') ? 'active' : '' }}"
                                        href="{{ route('admin.signers.index') }}">
                                        Thể loại
                                    </a>
                                </li>
                            </ul>
                        </details>
                    </li>
                    <li>
                        <details @if (request()->routeIs('admin.menus.*', 'admin.ads.*', 'admin.addons.*')) open @endif
                            class="{{ request()->routeIs('admin.menus.*', 'admin.ads.*', 'admin.addons.*') ? 'open' : '' }}">
                            <summary>Tùy chỉnh</summary>
                            <ul>
                                <li>
                                    <a @class(['active' => request()->routeIs('admin.menus.*')]) href="{{ route('admin.menus.index') }}">
                                        @lang('admin.menus')
                                    </a>
                                </li>

                                <li>
                                    <a @class(['active' => request()->routeIs('admin.ads.*')]) href="{{ route('admin.ads.index') }}">
                                        Quản lý quảng cáo
                                    </a>
                                </li>
                                <li>
                                    <a @class(['active' => request()->routeIs('admin.banners.*')]) href="{{ route('admin.banners.index') }}">
                                        Quản lý banner
                                    </a>
                                </li>
                                <li>
                                    <a @class(['active' => request()->routeIs('admin.addons.*')]) href="{{ route('admin.addons.index') }}">
                                        Quản lý Addons
                                    </a>
                                </li>
                            </ul>
                        </details>
                    </li>
                    <li>
                        <details @if (request()->routeIs('admin.menus.*', 'admin.ads.*', 'admin.addons.*')) open @endif
                            class="{{ request()->routeIs('admin.menus.*', 'admin.ads.*', 'admin.addons.*') ? 'open' : '' }}">
                            <summary>Tài khoản</summary>
                            <ul>
                                <li>
                                    <a @class(['active' => request()->routeIs('admin.users.*')]) href="{{ route('admin.users.index') }}">
                                        Quản lý tài khoản
                                    </a>
                                </li>

                                <li>
                                    <a @class(['active' => request()->routeIs('admin.roles.*')]) href="{{ route('admin.roles.index') }}">
                                        Quản lý quyền hạn
                                    </a>
                                </li>
                            </ul>
                        </details>
                    </li>
                @elseif(Auth::user()->category_id == 2)
                    <li>
                        <details @if (request()->routeIs('admin.categories.*', 'admin.posts.*')) open @endif
                            class="{{ request()->routeIs('admin.categories.*', 'admin.posts.*') ? 'active' : '' }}">
                            <summary>@lang('admin.categories')</summary>
                            <ul class="menu">
                                @foreach ($categories as $category)
                                    <x-admin.sidebar.category :category="$category" />
                                @endforeach

                            </ul>
                        </details>
                    </li>
                @else
                    <li>
                        <details @if (request()->routeIs('admin.categories.*', 'admin.posts.*')) open @endif
                            class="{{ request()->routeIs('admin.categories.*', 'admin.posts.*') ? 'active' : '' }}">
                            <summary>@lang('admin.categories')</summary>
                            <ul class="menu">
                                @foreach ($menu as $menu)
                                    <x-admin.sidebar.category :category="$menu" />
                                    {{-- <x-admin.sidebar.new-category :category="$menu" /> --}}
                                @endforeach
                            </ul>
                        </details>
                    </li>
                @endif

            </ul>
        </div>
    </div>
</aside>
