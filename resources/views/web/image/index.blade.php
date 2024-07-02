<x-website-layout>
    @include('web.image.css')
    <div class="panel panel-primary" style="border: 1px solid #FDC215; border-radius: 6px;">
        <div class="panel-heading bg-blue-skhcn no-border no-border-radius">
            <h3 class="panel-title">
                <i class="fa fa-list-alt"></i> <b style="font-size: 14px;">Album ảnh</b>
            </h3>
            <div class="clearfix"></div>
        </div>
        <div class="galery">
            @foreach ($albums as $albums)
                <div class="du_an_galery_top">
                    <div class="hinh_anh_galery">
                        <a href="{{ route('image.show', ['album' => $albums->id]) }}" title="{{ $albums->name }}"><img
                                src="{{ $albums->getFirstMedia('album_thumb')->getUrl('') }}">
                        </a>
                    </div><a href="{{ route('image.show', ['album' => $albums->id]) }}" title="{{ $albums->name }}">
                    </a>
                    <div class="tieu_de_galery_"><a href="{{ route('image.show', ['album' => $albums->id]) }}"
                            title="{{ $albums->name }}">
                        </a>
                        <h4
                            style="color: #fdc215; font-size: 14px; text-align: center; font-weight: bold; margin-top: 7px; overflow: ;  white-space: wrap; text-overflow: ellipsis;">
                            <a href="{{ route('image.show', ['album' => $albums->id]) }}" title="{{ $albums->name }}"><b
                                    style="color: #06009e;">Tên Album: </b></a>
                            <p class="content"><a href="{{ route('image.show', ['album' => $albums->id]) }}"
                                    title="{{ $albums->name }}"></a><a
                                    href="{{ route('image.show', ['album' => $albums->id]) }}"
                                    title="{{ $albums->name }}">{{ $albums->name }}</a></p>
                        </h4>
                    </div>
                    <div class="du_an_galery_bottom">
                        <b style="color: #06009e;">Ngày đăng:</b> {{ $albums->created_at->format('d/m/Y') }}
                    </div>
                </div>
            @endforeach
            <div style="clear:both"></div>
            <ul class="pagination" style="float: left;">
                <li class="active"><a>1</a></li>
            </ul>



        </div>
    </div>
</x-website-layout>
