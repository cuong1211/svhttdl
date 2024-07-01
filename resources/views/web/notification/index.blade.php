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
                                @php
                                    $index = 1;
                                @endphp
                                @foreach ($noti as $noti)
                                    <tr style="color: #333333;">
                                        <td style="font-size: 13px;">{{ $index }}</td>
                                        <td style="text-align: left; margin-left: 10px; font-size: 13px; width: 55%;">
                                            <a href="{{ route('noti.show', ['Announcement' => $noti->slug]) }}"
                                                target="blank" style="color:#000;">{{ $noti->title }}</a>
                                        </td>
                                        <td style="font-size: 13px;">
                                            {{ $noti->published_at->translatedFormat('d/m/Y h:i:s') }}</td>
                                        <td style="font-size: 13px;"><a class="fa fa-info"
                                                href="{{ route('noti.show', ['Announcement' => $noti->slug]) }}"></a></td>
                                    </tr>
                                    @php
                                        $index++;
                                    @endphp
                                @endforeach

                            </table>
                        </div>
                        <div class="kv-panel-after"></div>
                        <div class="panel-footer">
                            <div class="kv-panel-pager">
                                <ul class="pagination" style="float: right;">
                                    <li class='active'><a href='index7986.html?com=thong-bao&amp;page=1'>1</a></li>
                                    <li><a href='index0985.html?com=thong-bao&amp;page=2'>2</a></li>
                                    <li><a href='index43e7.html?com=thong-bao&amp;page=3'>3</a></li>
                                </ul>
                            </div>
                            <div class="clearfix">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-website-layout>
