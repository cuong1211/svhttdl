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
                @foreach ($albums as $album)
                    <div class="du_an_galery_top">
                        <div class="hinh_anh_galery">
                            <a href="{{ route('image.show', ['album' => $album->id]) }}" title="{{ $album->name }}">
                                @if ($album->getFirstMedia('album_thumb'))
                                    <img src="{{ $album->getFirstMedia('album_thumb')->getUrl('') }}">
                                @else
                                    <img src="{{ asset($album->image) }}">
                                @endif
                            </a>
                        </div><a href="{{ route('image.show', ['album' => $album->id]) }}" title="{{ $album->name }}">
                        </a>
                        <div class="tieu_de_galery_"><a href="{{ route('image.show', ['album' => $album->id]) }}"
                                title="{{ $album->name }}">
                            </a>
                            <h4
                                style="color: #fdc215; font-size: 14px; text-align: center; font-weight: bold; margin-top: 7px; overflow: ;  white-space: wrap; text-overflow: ellipsis;">
                                <a href="{{ route('image.show', ['album' => $album->id]) }}"
                                    title="{{ $album->name }}"><b style="color: #06009e;">Tên Album: </b></a>
                                <p class="content"><a href="{{ route('image.show', ['album' => $album->id]) }}"
                                        title="{{ $album->name }}"></a><a
                                        href="{{ route('image.show', ['album' => $album->id]) }}"
                                        title="{{ $album->name }}">{{ $album->name }}</a></p>
                            </h4>
                        </div>
                        <div class="du_an_galery_bottom">
                            <b style="color: #06009e;">Ngày đăng:</b> {{ $album->created_at->format('d/m/Y') }}
                        </div>
                    </div>
                @endforeach
                <div style="clear:both"></div>
                {{ $albums->render('web.paginate') }}



            </div>
        </div>
    </x-website-layout>
