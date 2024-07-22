<div class="Menu">
    <div class="Center_Menu">
        <nav class="clearfix">
            <a href="#" id="pull">MENU</a>
            <ul class="UL_Menu_Index">
                @foreach ($menus as $menu)
                    @php
                        if ($menu->link == null) {
                            $url = url('');
                        } else {
                            $url = filter_var($menu->url, FILTER_VALIDATE_URL) ? $menu->link : url($menu->link);
                        }
                    @endphp
                    <li class="Li_Menu"><a href="{{ $url }}" class="A_Menu"> {{ $menu->title }}</a><span
                            class="BorderGradient"></span>
                        <ul class="UL_Menu_1 UL_News">
                            @foreach ($menu->children as $child)
                                <li class="LI_Menu_1">
                                    <a class="A_Menu_1" href="{{ url($child->link) }}"> {{ $child->title }}</a>
                                </li>
                            @endforeach
                        </ul>
                    </li>
                @endforeach
                @if (request()->routeIs('home.child.*'))
                @else
                    <li class="Li_Menu">
                        <a href="{{ route('dashboard') }}" class="A_Menu">
                            <svg style="padding-bottom: 10px; transform: rotate(180deg);" width="30" height="30"
                                xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M11 16l-4-4m0 0l4-4m-4 4h14m-5 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h7a3 3 0 013 3v1">
                                </path>
                            </svg>
                        </a>
                        <span class="BorderGradient"></span>
                    </li>
                @endif
            </ul>
        </nav>
    </div>
</div>
