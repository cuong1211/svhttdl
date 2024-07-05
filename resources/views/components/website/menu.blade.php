<div class="Menu">
    <div class="Center_Menu">
        <nav class="clearfix">
            <a href="#" id="pull">MENU</a>
            <ul class="UL_Menu_Index">
                @foreach($menus as $menu)
                <li class="Li_Menu"><a href="{{$menu->link}}" class="A_Menu"> {{ $menu->title }}</a><span class="BorderGradient"></span>
                    <ul class="UL_Menu_1 UL_News">
                        @foreach($menu->children as $child)
                        <li class="LI_Menu_1">
                            <a class="A_Menu_1"
                                href="{{ $child->link }}"> {{ $child->title }}</a>
                        </li>
                        @endforeach
                    </ul>
                </li>
                @endforeach
            </ul>
        </nav>
    </div>
</div>
