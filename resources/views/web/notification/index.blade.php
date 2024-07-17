<x-website-layout>
    <div class="col-lg-12">
        <div class="portlet-body">
            <div id="ajaxCrudDatatable">
                <div id="crud-datatable" class="grid-view" data-krajee-grid="kvGridInit_0b96d585">
                    <div class="panel panel-primary">
                        <div class="panel-heading bg-blue-skhcn no-border no-border-radius">

                            <h3 class="panel-title">
                                <i class="glyphicon glyphicon-list"></i> <b style="font-size: 14px;">Danh sách Thông
                                    báo</b>
                            </h3>
                            <br>
                            <div class="clearfix"></div>
                        </div>
                        <div id="crud-datatable-container" class="table-responsive kv-grid-container">
                            <table border="1" cellspacing="0" cellpadding="4" id="table_articles"
                                style="width: 100%; text-align: center;">
                                <tr>
                                    <td width="50" style="background:#007bff ; color: #fff;"><strong>STT</strong>
                                    </td>
                                    <td style="background:#007bff ; color: #fff;"><strong>Tiêu đề</strong></td>
                                    <td style="background:#007bff ; color: #fff;"><strong>Ngày đăng</strong></td>
                                    <td style="background:#007bff ; color: #fff;"><strong>Chi tiết</strong></td>
                                </tr>
                                @foreach ($notis as $noti)
                                    <tr style="color: #333333;">
                                        <td style="font-size: 13px;">{{ $notis->firstItem() + $loop->index }}</td>
                                        <td style="text-align: left; margin-left: 10px; font-size: 13px; width: 55%;">
                                            <a href="{{ route('noti.show', ['Announcement' => $noti->slug]) }}"
                                                target="blank" style="color:#000;">{{ $noti->title }}</a>
                                        </td>
                                        <td style="font-size: 13px;">
                                            {{ $noti->published_at->translatedFormat('d/m/Y h:i:s') }}</td>
                                        <td style="font-size: 13px;"><a class="fa fa-info"
                                                href="{{ route('noti.show', ['Announcement' => $noti->slug]) }}"></a></td>
                                    </tr>
                                @endforeach

                            </table>
                        </div>
                        <div class="kv-panel-after"></div>
                        {{ $notis->render('web.paginate') }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-website-layout>
