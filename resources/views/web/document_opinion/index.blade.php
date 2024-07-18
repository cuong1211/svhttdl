<x-website-layout>
    <ul class="UL_Link_Menu">
        <li class="Lv_1">
            <a href="index-2.html">Trang chủ</a>
        </li>
        <li class="Lv_3">
            <span class="Arrow_Link_Menu"></span>
            <a>Lấy ý kiến cá nhân về các văn bản dự thảo</a>
        </li>
    </ul>
    <div class="col-lg-12" style="width: 100%; margin-top: 20px; line-height: 30px;">
        <p
            style="border-left: 4px solid #38BDF8; background: #F0F9FF;text-align: justify; padding: 10px; font-size: 16px; border-radius: 5px;">
            Nhằm đảm bảo các chủ trương, chính sách của tỉnh có tính khả thi cao, sát thực tiễn và đáp ứng nguyện vọng
            của nhân dân, đồng thời góp phần nâng cao hiệu lực, hiệu quả quản lý nhà nước; Sở Văn hóa, Thể thao và Du
            lịch tổ chức lấy ý kiến độc giả về các dự thảo văn bản quy phạm pháp luật trên Cổng Thông tin điện tử của
            Sở. Tất cả ý kiến đóng góp sẽ được tiếp thu, nghiên cứu, chọn lọc một cách nghiêm túc và khoa học trong quá
            trình hoàn thiện văn bản.</p>
        </br>
        <div class="col-lg-14">
            <div class="portlet-body" style="width: 100%;">
                <div id="ajaxCrudDatatable">
                    <div id="crud-datatable" class="grid-view" data-krajee-grid="kvGridInit_0b96d585">
                        <div class="panel panel-primary">

                            <div id="crud-datatable-container" class="table-responsive kv-grid-container">
                                <table border="1" cellspacing="0" cellpadding="4" id="table_articles"
                                    style="width: 100%; text-align: center;">
                                    <tr>
                                        <td width="50" style="background:#007bff ; color: #fff;">
                                            <strong>STT</strong>
                                        </td>
                                        <td style="background:#007bff ; color: #fff;"><strong>Tên văn bản</strong></td>
                                        <td style="background:#007bff ; color: #fff;"><strong>Ngày bắt đầu lấy ý
                                                kiến</strong></td>
                                        <td style="background:#007bff ; color: #fff;"><strong>Ngày hết hạn lấy ý
                                                kiến</strong></td>
                                        <td style="background:#007bff ; color: #fff;"><strong>Chi tiết</strong></td>
                                        <td style="background:#007bff ; color: #fff;text-align: center;">
                                            <strong></strong>
                                        </td>
                                    </tr>
                                    @foreach ($docs as $doc)
                                        <tr>
                                            <td>{{ $docs->firstItem() + $loop->index }}</td>
                                            <td>{{ $doc->name }}</td>
                                            <td>{{ $doc->startAtVi }}</td>
                                            <td>{{ $doc->endAtVi }}</td>
                                            <td>
                                                @if ($doc->getFirstMedia('document_file'))
                                                    <a class="fa fa-download" target="_blank"
                                                        href="{{ $doc->getFirstMedia('document_file')->getUrl() }}"></a>
                                                @else
                                                    {{-- make url form host + $item->document_file --}}
                                                    <a class="fa fa-download" target="_blank"
                                                        href="{{ asset('/' . $doc->document_file) }}"></a>
                                                @endif
                                            </td>
                                            <td><a href="{{ route('doc_opi.show', ['document_opinion' => $doc->id]) }}">Gửi ý kiến</a></td>
                                        </tr>
                                    @endforeach
                                </table>
                            </div>
                            {{ $docs->render('web.paginate') }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</x-website-layout>
