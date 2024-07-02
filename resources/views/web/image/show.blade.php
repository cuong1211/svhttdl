<x-website-layout>
    @include('web.image.css')
    @push('styles')
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
    @endpush
    <div class="panel panel-primary" style="border: 1px solid #FDC215; border-radius: 6px;">
        <div class="panel-heading bg-blue-skhcn no-border no-border-radius">
            <h3 class="panel-title">
                <i class="fa fa-arrow-left"></i> <b style="font-size: 14px;">
                    <a href="{{ route('image.index') }}" style="color:white">Về thư viện ảnh
                    </a></b>
            </h3>
            <div class="clearfix"></div>
        </div>
        <h2
            style="text-align: center; font-family: Kodchasan; font-size: 20px; color: #262d73; line-height: 28px; margin: 10px;">
            {{ $albums }}</h2>
        <div class="galery">
            @foreach ($images as $images)
                <div class="du_an_galery_top">
                    <div class="hinh_anh_galery">
                        <a class="modal-content" data-image={{ $images->getFirstMedia('album_photo')->getUrl('') }}
                            data-toggle="modal" data-target="#myModal">
                            <img class="example-image" src="{{ $images->getFirstMedia('album_photo')->getUrl('') }}">
                        </a>
                    </div>
                    <div class="tieu_de_galery_">
                        <h2 style="color: #1F4EB4; font-size: 16px; text-align: center; margin-top: 7px; width: 270px;">
                            {{ $images->name }}
                        </h2>
                    </div>
                </div>
            @endforeach
            <div style="clear:both"></div>
            <ul class="pagination" style="float: left;">
                <li class="active"><a>1</a></li>
            </ul>
        </div>
    </div>
    <div id="myModal" class="modal fade" role="dialog">
        <div class="modal-dialog modal-lg">
            <!-- Modal content-->
            <div class="modal-content" style="width: 100%">

                <div class="modal-body">
                    <img src="" alt="" style="width: 100%">
                </div>

            </div>

        </div>
    </div>
    <script>
        $(document).on("click", ".modal-content", function() {
            var image = $(this).data('image');
            $(".modal-body img").attr("src", image);
        });
    </script>
</x-website-layout>
