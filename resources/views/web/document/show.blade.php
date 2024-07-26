<x-website-layout>
    <div class="Around_News_Detail">
        <style>
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
                <td>Số hiệu</td>
                <td>{{ $doc->reference_number }}</td>
            </tr>
            <tr>
                <td>Ngày ban hành</td>
                <td>{{ $doc->published_at->translatedFormat('d/m/Y') }}</td>
            </tr>
            <tr>
                <td>Người ký</td>
                <td>{{ $doc->signer }}</td>
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
    <div class="border_content_fullwidth">
        <div style="">
            <div class="groupnews_head bg_blue">
                <span class="group_header_link">Văn bản khác</span>
            </div>
            <div class="groupnews_content">
                <ul class="othernews_fullwidth">
                    @foreach ($other_docs as $other_doc)
                        <li>
                            <a href="{{ route('document.show', $other_doc->id) }}">
                                <span>{{ $other_doc->name }}({{ $other_doc->published_at->translatedFormat('d/m/Y') }})</span>
                            </a>
                        </li>
                    @endforeach

                </ul>
            </div>
        </div>
    </div>
</x-website-layout>
