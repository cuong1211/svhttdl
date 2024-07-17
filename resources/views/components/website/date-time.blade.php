<div class="BG_Menu">
    <div class="wrapper">
        <div class="UL_Menu_Date">
            {{-- get time now with format l, d/m/Y in vietnamese --}}
            {{ \Carbon\Carbon::now()->translatedFormat('l, d/m/Y') }}
        </div>
        @if (request()->routeIs('home.child.*'))
            <div class="Menu_Mini">
                <ul class="UL_Menu_Mini" style="display: block;">
                    <li class="LI_Menu_Mini_hd">
                        <a href="{{ route('home') }}"><b><i style="color: #fff; font-size: 10px; "> Trang chủ
                                    Sở VHTTDL Bắc Kạn</i></b></a>
                    </li>
                </ul>
            </div>
        @else
            <div class="Menu_Mini">
                <ul class="UL_Menu_Mini" style="display: block;">
                    <li class="LI_Menu_Mini_hd">
                        <a href="{{ route('faq.index') }}" style="color:white">&ensp;&ensp;&ensp;&ensp;Hỏi
                            đáp</a>
                    </li>
                    <li class="LI_Menu_Mini">|</li>
                    <li class="LI_Menu_Mini_lh">
                        <a href="{{ route('contact.index') }}">&ensp;&ensp;&ensp;&ensp;Liên hệ</a>
                    </li>
                </ul>
            </div>
        @endif
    </div>
</div>
