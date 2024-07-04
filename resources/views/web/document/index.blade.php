<x-website-layout>
    <style>
        .w3-blue,
        .w3-hover-blue:hover {
            color: #fff !important;
            background-color: #2196F3 !important;
        }

        .w3-bar {
            width: 100%;
            overflow: hidden;
        }

        .w3-bar .w3-button {
            white-space: normal;
        }

        .w3-bar .w3-bar-item {
            padding: 8px 16px;
            float: left;
            width: auto;
            border: none;
            display: block;
            outline: 0;
            background-color: inherit;
            color: inherit;
        }
    </style>
    <ul class="UL_Link_Menu">
        <li class="Lv_1">
            <a href="index-2.html">Trang chủ</a>
        </li>
        <li class="Lv_2">
            <span class="Arrow_Link_Menu"></span>
            <a>Văn bản</a>
        </li>
    </ul>
    <div class="Around_News_Detail">
        <div class="Around_News_Content">
            <div class="w3-bar w3-blue">
                <button class="w3-bar-item w3-button" onclick="openCity('Tab1')"><b>Văn bản mới</b></button>
                <button class="w3-bar-item w3-button" onclick="openCity('Tab2')"><b>Văn bản QPPL</b></button>
                <button class="w3-bar-item w3-button" onclick="openCity('Tab3')"><b>Văn bản QPPL cấp tỉnh & Trung
                        ương</b></button>
            </div>

            <div id="Tab1" class="w3-container city">
                <br>
                <table border="1" cellspacing="0" cellpadding="4" id="table_articles"
                    style="width: 100%; text-align: center;">
                    <tr>
                        <td width="50" style="background:#2A3F54 ; color: #fff;"><strong>STT</strong></td>
                        <td style="background:#2A3F54 ; color: #fff;"><strong>Số hiệu</strong></td>
                        <td style="background:#2A3F54 ; color: #fff;"><strong>Tên văn bản</strong></td>
                        <td style="background:#2A3F54 ; color: #fff;"><strong>Ngày ban hành</strong></td>
                        <td style="background:#2A3F54 ; color: #fff;text-align: center;"><strong>Tải về</strong></td>
                    </tr>
                    @php
                        $index = 1;
                    @endphp
                    @foreach ($docs as $item)
                        <tr style="color: #333333; ">
                            <td>{{ $index }}</td>
                            <td style="text-align: left; margin-left: 10px; text-align: justify;"><a
                                    href="index141a.html?com=chitiet_vb&amp;id_vanban=26">{{ $item->reference_number }}</a>
                            </td>
                            <td style="text-align: left; margin-left: 10px; text-align: justify;"><a
                                    href="index141a.html?com=chitiet_vb&amp;id_vanban=26">{{ $item->name }}</a></td>
                            <td style="text-align: left; margin-left: 10px; text-align: justify;"><a
                                    href="index141a.html?com=chitiet_vb&amp;id_vanban=26">{{ $item->published_at->translatedFormat('d/m/Y') }}</a>
                            </td>
                            <td>
                                @if ($item->getFirstMedia('document_file'))
                                    <a class="fa fa-download" target="_blank"
                                        href="{{ $item->getFirstMedia('document_file')->getUrl() }}"></a>
                                @else
                                {{-- make url form host + $item->document_file --}}
                                    <a class="fa fa-download" target="_blank"
                                        href="{{ asset('/' . $item->document_file) }}"></a>
                                @endif
                            </td>
                        </tr>
                        @php
                            $index++;
                        @endphp
                    @endforeach

                </table>
            </div>

            <!-- Similar modification for Tab2 and Tab3 -->

            <script>
                function openCity(cityName) {
                    var i;
                    var x = document.getElementsByClassName("city");
                    for (i = 0; i < x.length; i++) {
                        x[i].style.display = "none";
                    }
                    document.getElementById(cityName).style.display = "block";
                }
            </script>
        </div>
    </div>
</x-website-layout>
