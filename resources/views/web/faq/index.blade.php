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
                <form id="form1" name="form1" method="get" action="index.php"
                    style="margin-top: 20px; text-align: center;">
                    <input type="hidden" name="com" value="hoi-dap">
                    <label><b>Nội dung:</b></label>
                    <input style="width: 200px;" type="text" name="string" id="string" value="">

                    <button type="submit" class="btn btn-primary" id="button">Tìm kiếm</button>

                    <button type="button" class="btn btn-success"
                        onclick="window.location.href='index.php?com=hoi-dap'">Hủy</button>

                </form>
            </div>
        </div>

    </div>
    <div class="col-lg-12">
        <a href="{{route('faq.create')}}" class="btn btn-primary" style="float: right; ">Đặt câu
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
                                    <tr style="color: #333333; ">
                                        <td style="text-align: left; margin-left: 10px;">
                                            <a href="index.php?com=chitiet-ch&amp;id_cauhoi=1"
                                                style="text-decoration: none;"><span
                                                    style="color: #1E4283; font-size: 15px;"><b>Hỏi về nhân sự phòng X
                                                        quang chẩn đoán răng hàm mặt</b></span></a><br>
                                            <span style="text-align: justify;">Xin hỏi để thành lập phòng Xquang nha
                                                khoa, ngoài các tiêu chuẩn về cơ sở vật chất thì tiêu chuẩn về nhân sự
                                                cần gì ạ?một bác sĩ răng hàm mặt có chứng chỉ an toàn bức xạ 2 nội dung
                                                thì có đủ đứng phòng xquang chưa?</span><br>
                                            <span style="float: right;">Vũ Hồng Quân (quanvu797@gmail.com) - Thái
                                                Nguyên</span>

                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        <div class="kv-panel-after"></div>
                        <div class="panel-footer">
                            <div class="kv-panel-pager">
                                <ul class="pagination" style="float: right;">
                                    <li class="active"><a href="index.php?com=hoi-dap&amp;page=1">1</a></li>
                                    <li><a href="index.php?com=hoi-dap&amp;page=2">2</a></li>
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
