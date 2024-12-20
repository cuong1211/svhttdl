<x-website-layout>
    @push('styles')
        <style>
            .article-header {
                display: flex;
                justify-content: space-between;
                align-items: center;
                margin-bottom: 20px;
            }

            .reading-controls {
                display: flex;
                gap: 10px;
                align-items: center;
            }

            .text-control {
                background: none;
                border: 1px solid #ccc;
                padding: 2px 8px;
                cursor: pointer;
                border-radius: 4px;
            }

            .text-control:hover {
                background: #f0f0f0;
            }

            .read-article,
            .control-button {
                background: none;
                border: 1px solid #ccc;
                padding: 4px 10px;
                cursor: pointer;
                border-radius: 4px;
            }

            .read-article:hover,
            .control-button:hover {
                background: #f0f0f0;
            }

            .content img {
                height: 370px;
                width: 600px;
            }

            p {
                font-size: 16px;
                line-height: 1.5;
            }

            .author-info {
                margin-top: 30px;
                text-align: right;
                font-size: 15px;
                color: #666;
                font-style: italic;
            }

            .author-info span {
                font-weight: 500;
                color: #333;
            }

            .content img {
                height: 370px;
                width: 600px;
            }

            p {
                font-size: 16px;
                line-height: 1.5;
            }

            .author-info {
                margin-top: 30px;
                text-align: right;
                font-size: 15px;
                color: #333;
                font-weight: bold;
            }

            .author-info span {
                font-weight: 700;
                /* hoặc bold */
                color: #000;
            }

            .text-control,
            .read-article,
            .control-button {
                width: 36px;
                height: 36px;
                display: inline-flex;
                align-items: center;
                justify-content: center;
                background: white;
                border: 1px solid #e5e7eb;
                border-radius: 4px;
                padding: 0;
            }

            .text-control:hover,
            .read-article:hover,
            .control-button:hover {
                background: #f3f4f6;
            }

            .text-control svg,
            .read-article svg,
            .control-button svg {
                color: #374151;
            }

            /* Style cho file preview */
            .pdf-preview {
                border: 1px solid #e5e7eb;
                border-radius: 4px;
                overflow: hidden;
                margin-top: 1rem;
            }

            .pdf-preview iframe {
                width: 100%;
                height: 600px;
                border: none;
            }
        </style>
        <style>
            .Around_News_Detail {
                transition: all 0.3s ease;
            }

            .Around_News_Detail.dark-mode {
                background-color: #1a1a1a;
            }

            /* Chỉnh màu cho các phần tử con trong dark mode */
            .Around_News_Detail.dark-mode .News_Time_Post {
                color: white;
            }

            .Around_News_Detail.dark-mode .News_Detail_Title {
                color: #ffffff;
            }

            .Around_News_Detail.dark-mode .content {
                color: #ffffff;
            }

            .Around_News_Detail.dark-mode .document-section>div {
                background: #2d3748 !important;
                border-color: #4a5568 !important;
            }

            .Around_News_Detail.dark-mode .document-section h3 {
                color: #ffffff !important;
            }

            .Around_News_Detail.dark-mode .author-info {
                color: #ffffff;
            }

            .Around_News_Detail.dark-mode .author-info span {
                color: #ffffff;
            }

            /* Giữ nguyên màu nút tải xuống */
            .Around_News_Detail.dark-mode a[download] {
                background: #0056b3;
                color: white;
            }

            /* Đảm bảo phần preview PDF vẫn dễ nhìn */
            .Around_News_Detail.dark-mode iframe {
                background: white;
            }
        </style>
    @endpush
    <div class="article-header flex justify-between items-center">
        <ul class="UL_Link_Menu">
            <li class="Lv_1">
                <a href="index-2.html">Trang chủ</a>
            </li>
            <li class="Lv_3">
                <span class="Arrow_Link_Menu"></span>
                <a href="javascript:void(0)" disable>Tin tức - sự kiện</a>
            </li>
            <li class="Lv_3">
                <span class="Arrow_Link_Menu"></span>
                <a href="{{ route('news.child', ['Id' => $category->id]) }}" disable>{{ $post->category->title }}</a>
            </li>
        </ul>

        <div class="reading-controls">
            <!-- Nút tăng giảm cỡ chữ -->
            <button class="text-control" onclick="changeTextSize('decrease')" title="Giảm cỡ chữ">
                <svg viewBox="0 0 24 24" width="20" height="20" stroke="currentColor" fill="none"
                    stroke-width="2">
                    <line x1="5" y1="12" x2="19" y2="12" />
                </svg>
            </button>
            <button class="text-control" onclick="changeTextSize('increase')" title="Tăng cỡ chữ">
                <svg viewBox="0 0 24 24" width="20" height="20" stroke="currentColor" fill="none"
                    stroke-width="2">
                    <line x1="12" y1="5" x2="12" y2="19" />
                    <line x1="5" y1="12" x2="19" y2="12" />
                </svg>
            </button>

            <!-- Nút phát âm thanh -->
            <button class="read-article" onclick="readArticle()" id="readBtn" title="Đọc bài viết">
                <svg viewBox="0 0 24 24" width="20" height="20" fill="none" stroke="currentColor"
                    stroke-width="2">
                    <path d="M11 5L6 9H2v6h4l5 4V5z" />
                    <path d="M19.07 4.93a10 10 0 0 1 0 14.14M15.54 8.46a5 5 0 0 1 0 7.07" />
                </svg>
            </button>

            <!-- Nút pause (mặc định ẩn) -->
            <button class="control-button hidden" onclick="pauseReading()" id="pauseBtn" title="Tạm dừng"
                style="display: none;">
                <svg viewBox="0 0 24 24" width="20" height="20" fill="none" stroke="currentColor"
                    stroke-width="2">
                    <rect x="6" y="4" width="4" height="16" />
                    <rect x="14" y="4" width="4" height="16" />
                </svg>
            </button>
            <button class="control-button" onclick="toggleDarkMode()" title="Chuyển đổi chế độ sáng/tối">
                <svg viewBox="0 0 24 24" width="20" height="20" stroke="currentColor" fill="none"
                    stroke-width="2">
                    <path d="M21 12.79A9 9 0 1 1 11.21 3 7 7 0 0 0 21 12.79z" />
                </svg>
            </button>
        </div>
    </div>

    <div class="Around_News_Detail">
        <div class="Around_News_Content">
            <div style="float: left; width: 100%;">
                <span class="News_Time_Post">
                    Ngày đăng: {{ $post->published_post_date }} / Lượt xem: {{ $post->view }}
                </span>
            </div>
            <div class="title">
                <h1 class="News_Detail_Title">
                    {{ $post->title }}
                </h1>
            </div>
            <div id="divArticleDescription">
                <div class="content" style="object-fit: cover;">
                    {!! $post->content !!}
                    @if ($post->getFirstMedia('audio'))
                        <div class="audio-section mt-4" style="display: none;"> <!-- Thêm style display: none -->
                            <h3 class="text-lg font-semibold mb-2">File âm thanh:</h3>
                            <audio controls class="w-full">
                                <source src="{{ $post->getFirstMedia('audio')->getUrl() }}" type="audio/mpeg">
                                Trình duyệt của bạn không hỗ trợ phát audio.
                            </audio>
                        </div>
                    @endif

                    @if ($post->author)
                        <div class="author-info">
                            Tác giả: <span>{{ $post->author }}</span>
                        </div>
                    @endif
                    @if ($post->getFirstMedia('document'))
                        <div class="document-section" style="margin-top: 2rem;">
                            @php
                                $extension = pathinfo($post->getFirstMedia('document')->file_name, PATHINFO_EXTENSION);
                                $documentUrl = $post->getFirstMedia('document')->getUrl();
                                $fileName = $post->getFirstMedia('document')->name;
                            @endphp

                            <div style="background: #f8f9fa; border: 1px solid #e9ecef; border-radius: 8px;">
                                <div
                                    style="padding: 1rem; border-bottom: 1px solid #e9ecef; display: flex; justify-content: space-between; align-items: center;">
                                    <div>
                                        <h3 style="font-size: 0.875rem; color: black; margin: 0;">TÀI LIỆU ĐÍNH KÈM
                                        </h3>
                                    </div>
                                    <a href="{{ $documentUrl }}" download
                                        style="background: #0056b3; color: white; padding: 8px 16px; border-radius: 4px; text-decoration: none; font-size: 0.875rem;">
                                        Tải xuống
                                    </a>
                                </div>

                                @if ($extension == 'pdf')
                                    <div>
                                        <iframe src="{{ $documentUrl }}#toolbar=0"
                                            style="width: 100%; height: 600px; border: 1px solid #dee2e6; border-radius: 4px;">
                                        </iframe>
                                    </div>
                                @else
                                    <div style="padding: 2rem; text-align: center; color: #6c757d;">
                                        <p style="font-size: 1rem; margin-bottom: 0.5rem;">
                                            File {{ strtoupper($extension) }} không hỗ trợ xem trước
                                        </p>
                                        <p style="font-size: 0.875rem; color: #adb5bd;">
                                            Vui lòng tải xuống để xem nội dung
                                        </p>
                                    </div>
                                @endif
                            </div>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>

    <div class="border_content_fullwidth">
        <div style="">
            <div class="groupnews_head bg_blue">
                <span class="group_header_link">Bài viết cùng chuyên mục</span>
            </div>
            <div class="groupnews_content">
                <ul class="othernews_fullwidth">
                    @foreach ($otherPosts as $otherPosts)
                        <li>
                            <a href="{{ route('news.show', $otherPosts) }}">
                                <span>{{ $otherPosts->title }}({{ $otherPosts->published_post_date }})</span>
                            </a>
                        </li>
                    @endforeach
                </ul>
            </div>
        </div>
    </div>
    @push('scripts')
        <script>
            const defaultFontSize = 16;

            function changeTextSize(action) {
                // Chọn tất cả các phần tử p và span trong content
                const contentElements = document.querySelectorAll(
                    '.Around_News_Content p, .Around_News_Content span, .Around_News_Content div, .Around_News_Content h1, .Around_News_Content h2, .Around_News_Content h3, .Around_News_Content h4, .Around_News_Content h5, .Around_News_Content h6'
                );

                contentElements.forEach(element => {
                    const currentSize = parseInt(window.getComputedStyle(element).fontSize);

                    if (action === 'increase' && currentSize < 24) {
                        element.style.fontSize = (currentSize + 2) + 'px';
                    } else if (action === 'decrease' && currentSize > 12) {
                        element.style.fontSize = (currentSize - 2) + 'px';
                    }
                });
            }

            function resetTextSize() {
                const contentElements = document.querySelectorAll(
                    '.Around_News_Content p, .Around_News_Content span, .Around_News_Content div, .Around_News_Content h1, .Around_News_Content h2, .Around_News_Content h3, .Around_News_Content h4, .Around_News_Content h5, .Around_News_Content h6'
                );
                contentElements.forEach(element => {
                    element.style.fontSize = defaultFontSize + 'px';
                });
            }
            let audio = null;

            function readArticle() {
                const audioElement = document.querySelector('audio');
                if (audioElement) {
                    // Nếu có file audio, phát file audio
                    if (audio === null) {
                        audio = audioElement;
                    }
                    audio.play();
                    document.getElementById('readBtn').style.display = 'none';
                    document.getElementById('pauseBtn').style.display = 'inline-block';
                } else {
                    alert('Không có file âm thanh cho bài viết này!');
                }
            }

            function pauseReading() {
                if (audio) {
                    audio.pause();
                } else {
                    window.speechSynthesis.pause();
                }
                document.getElementById('readBtn').style.display = 'inline-block';
                document.getElementById('pauseBtn').style.display = 'none';
            }

            // Thêm event listener cho audio
            document.addEventListener('DOMContentLoaded', function() {
                const audioElement = document.querySelector('audio');
                if (audioElement) {
                    audioElement.addEventListener('ended', function() {
                        document.getElementById('readBtn').style.display = 'inline-block';
                        document.getElementById('pauseBtn').style.display = 'none';
                    });
                }
            });

            function toggleDarkMode() {
                const content = document.querySelector('.Around_News_Detail');
                content.classList.toggle('dark-mode');

                // Lưu trạng thái
                localStorage.setItem('newsDarkMode', content.classList.contains('dark-mode'));
            }

            // Khôi phục trạng thái dark mode khi load trang
            document.addEventListener('DOMContentLoaded', function() {
                const isDarkMode = localStorage.getItem('newsDarkMode') === 'true';
                if (isDarkMode) {
                    document.querySelector('.Around_News_Detail').classList.add('dark-mode');
                }
            });
            // Thêm log để debug
            document.addEventListener('DOMContentLoaded', function() {
                console.log('Content elements:', document.querySelectorAll('.content p, .content span, .content div'));
            });
        </script>
    @endpush
</x-website-layout>
