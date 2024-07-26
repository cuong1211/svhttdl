<x-website-layout>
    @push('styles')
        <style>
            #lienhe {
                width: 100%;
                margin: 0 auto;
                border: 1px solid #2dadc4;
                background: #c4e0e5;
                border-radius: 5px;

            }

            /* form */
            .form {
                width: 100%;
            }

            .top-form,
            .middle-form,
            .bottom-form {
                width: 100%;
                min-height: 25px;
                margin: 10px 0;
            }

            .form input[type="text"],
            .form textarea {
                border: 2px solid #fff;
                padding: 15px 5px;
                outline: none;
                border-radius: 2px;
                width: 100%;
                box-sizing: border-box;
                transition: all 0.2s ease;
            }

            .form input:focus,
            .form textarea:focus {
                border-color: #4ca1af;
                outline: none;
                box-shadow: inset 0 1px 1px rgba(0, 0, 0, 0.0125),
                    0 0 8px rgba(76, 161, 175, 0.5);
            }

            .form .label {
                margin-bottom: 5px;
            }

            /* top-contact */
            .top-form .inner-form {
                width: 28%;
                float: left;
                margin-right: 5%;
                margin-left: 10px;
            }

            .top-form .inner-form:last-child {
                margin-right: 0;
            }


            /* middle-form */
            .middle-form {
                clear: both;
                margin-left: 10px;
            }

            /* bottom-form */
            .bottom-form textarea {
                height: 120px;
                width: 98%;
            }

            .btn1 {
                color: #fff;
                display: inline-block;
                outline: none;
                cursor: pointer;
                text-align: center;
                text-decoration: none;
                font: 14px/100% Arial, Helvetica, sans-serif;
                padding: .5em 2em .55em;
                margin-left: 420px;
                text-shadow: 0 1px 1px rgba(0, 0, 0, .3);
                -webkit-border-radius: .5em;
                -moz-border-radius: .5em;
                border-radius: .5em;
                -webkit-box-shadow: 0 1px 2px rgba(0, 0, 0, .2);
                -moz-box-shadow: 0 1px 2px rgba(0, 0, 0, .2);
                box-shadow: 0 1px 2px rgba(0, 0, 0, .2);
                background: #0095d;
                border: solid 1px #0076a3;
                background: -webkit-gradient(linear, left top, left bottom, from(300adee), to(#0078a5));
            }

            /* blue */
            .blue {
                color: #d9eef7;
                border: solid 1px #0076a3;
                background: #0095cd;
                background: -webkit-gradient(linear, left top, left bottom, from(#00adee), to(#0078a5));
                background: -moz-linear-gradient(top, #00adee, #0078a5);
                filter: progid:DXImageTransform.Microsoft.gradient(startColorstr='#00adee', endColorstr='#0078a5');
            }

            .blue:hover {
                background: #007ead;
                background: -webkit-gradient(linear, left top, left bottom, from(#0095cc), to(#00678e));
                background: -moz-linear-gradient(top, #0095cc, #00678e);
                filter: progid:DXImageTransform.Microsoft.gradient(startColorstr='#0095cc', endColorstr='#00678e');
            }

            .blue:active {
                color: #80bed6;
                background: -webkit-gradient(linear, left top, left bottom, from(#0078a5), to(#00adee));
                background: -moz-linear-gradient(top, #0078a5, #00adee);
                filter: progid:DXImageTransform.Microsoft.gradient(startColorstr='#0078a5', endColorstr='#00adee');
            }

            table {
                width: 100%;
                border-collapse: collapse;
                box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
                background-color: #fff;
            }

            th,
            td {
                padding: 15px;
                text-align: left;
                border-bottom: 1px solid #ddd;
            }

            th {
                background-color: #3c6fef;
                color: white;
            }

            tr:hover {
                background-color: #f1f1f1;
            }
        </style>
    @endpush
    <div class="Around_News_Detail">
        <table>
            <tr>
                <th>Thông tin</th>
                <th></th>
            </tr>
            <tr>
                <td>Tên văn bản</td>
                <td>{{ $doc->name }}</td>
            </tr>
            <tr>
                <td>Ngày bắt đầu</td>
                <td>{{ $doc->startAtVi }}</td>
            </tr>
            <tr>
                <td>Ngày kết thúc</td>
                <td>{{ $doc->endAtVi }}</td>
            </tr>
            <tr>
                <td>Nội dung</td>
                <td>{!! $doc->content !!}</td>
            </tr>
            <tr>
                <td>Xem chi tiết</td>
                <td>
                    @if ($doc->getFirstMedia('document_file'))
                        <a class="fa fa-download" target="_blank"
                            href="{{ $doc->getFirstMedia('document_file')->getUrl() }}"></a>
                    @else
                        {{-- make url form host + $item->document_file --}}
                        <a class="fa fa-download" target="_blank" href="{{ asset('/' . $doc->document_file) }}"></a>
                    @endif
                </td>
            </tr>
        </table>
    </div>

    @php
        $currentDate = \Carbon\Carbon::now();
        $endDate = \Carbon\Carbon::parse($doc->end_date);
    @endphp

    @if ($currentDate->greaterThanOrEqualTo($endDate))
        <h3 style="color: red">Đã hết thời gian lấy ý kiến</h3>
    @else
        <h2>Đóng góp ý kiến</h2>
        <br>
        <div class="col-lg-12">
            <div class="panel panel-primary">
                <div id="demo1" class="collapse">
                    @if ($errors->any())
                        <div class="alert alert-error text-black">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                    <div id="lienhe">
                        <div class="form">
                            <form method="post"
                                action="{{ route('doc_opi.store', ['document_opinion' => $doc->id]) }}">
                                @csrf
                                <div class="top-form">
                                    <div class="inner-form">
                                        <div class="label" style="color:#000; font-size: 12px;">Họ và tên (*)</div>
                                        <input style="height: 20px;" type="text" name="name" required=""
                                            placeholder="Nguyễn Văn An">
                                    </div>
                                    <div class="inner-form">
                                        <div class="label" style="color:#000; font-size: 12px;">Email (*)</div>
                                        <input style="height: 20px;" type="text" name="email"
                                            placeholder="vanan@gmail.com">
                                    </div>
                                    <div class="inner-form">
                                        <div class="label" style="color:#000; font-size: 12px;">Điện thoại</div>
                                        <input style="height: 20px;" type="text" name="phone"
                                            placeholder="1234567890">
                                    </div>
                                </div>
                                <div class="top-form">
                                    <div class="inner-form">
                                        <div class="label" style="color:#000; font-size: 12px;">Địa chỉ </div>
                                        <input style="height: 20px;" type="text" name="address">
                                    </div>
                                </div>
                                <div class="middle-form">
                                    <div class="inner-form">
                                        <div class="label" style="color:#000; font-size: 12px;">Tiêu đề (*)</div>
                                        <input style="width: 98%;" type="text" name="title" required="">
                                    </div>
                                </div>
                                <div class="bottom-form" style="margin-left: 10px;">
                                    <div class="inner-form">
                                        <div class="label" style="color:#000; font-size: 12px;">Nội dung (*)</div>
                                        <textarea id="text" name="content" required=""></textarea>
                                    </div>
                                </div>
                                <input type="submit" value="Gửi câu hỏi" class="btn1 blue">
                            </form>
                            <br>
                            <br>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endif
    <br>

</x-website-layout>
