<x-website-layout>
    @include('web.faq.css')
    @push('styles')
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
    @endpush
    <div class="col-lg-12">
        <div class="panel panel-primary">
            <div class="panel-heading bg-blue-skhcn no-border no-border-radius">
                <div class="caption">
                    <span><i class="fa fa-search"></i> Tìm kiếm</span>
                </div>
            </div>
            <div class="panel-body">
                <form action="{{ route('faq.index') }}" method="GET"
                    style="margin-top: 20px; text-align: center;">
                    <label><b>Nội dung:</b></label>
                    <input style="width: 200px;" type="text" name="search" id="string" value="">

                    <button type="submit" class="btn btn-primary" id="button">Tìm kiếm</button>

                    <button type="button" class="btn bg-blue-700 text-white"
                        onclick="window.location.href='{{route('faq.index')}}'">Hủy</button>

                </form>
            </div>
        </div>

    </div>
    <div class="col-lg-12">
        <a href="{{ route('faq.create') }}" class="btn btn-primary justify-end flex">Đặt câu
            hỏi</a>
    </div>
    <div class="col-lg-12">
        <div class="portlet-body">
            <div id="ajaxCrudDatatable">
                <div id="crud-datatable" class="grid-view" data-krajee-grid="kvGridInit_0b96d585">
                    <div class="panel panel-primary">
                        <div class="panel-heading bg-blue-skhcn no-border no-border-radius">

                            <h3 class="panel-title">
                                <i class="glyphicon glyphicon-list"></i> <b style="font-size: 14px;">Danh sách Hỏi -
                                    Đáp</b>
                            </h3>
                            <div class="clearfix"></div>
                        </div>
                        <div id="crud-datatable-container" class="table-responsive kv-grid-container">
                            <table border="1" cellspacing="0" cellpadding="4" id="table_articles"
                                style="width: 100%; text-align: center;">

                                <tbody>
                                    @foreach ($faqs as $item)
                                        <tr style="color: #333333; ">
                                            <td style="text-align: left; margin-left: 10px;">
                                                <a href="{{ route('faq.show', ['faq' => $item->id]) }}"
                                                    style="text-decoration: none;"><span
                                                        style="color: #1E4283; font-size: 15px;"><b>{{ $item->title }}</b></span></a><br>
                                                <span style="text-align: justify;">{!! $item->question !!}</span><br>
                                                <span style="float: right;">{{ $item->name }} ({{ $item->email }}) -
                                                    {{ $item->address }}</span>

                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        <div class="kv-panel-after"></div>
                        {{ $faqs->render('web.paginate') }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-website-layout>
