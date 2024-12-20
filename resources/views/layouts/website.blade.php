<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">


<!-- Mirrored from sovhttdl.backan.gov.vn/ by HTTrack Website Copier/3.x [XR&CO'2014], Sat, 15 Jun 2024 03:40:40 GMT -->
<!-- Added by HTTrack -->
<meta http-equiv="content-type" content="text/html;charset=UTF-8" /><!-- /Added by HTTrack -->

<head>
    <base href="{{ asset('frontend') }}/">
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ config('app.name', 'Sở văn hóa thể thao và du lịch tỉnh Bắc Kạn') }}</title>
    <!-- Your meta tags here -->
    <meta name='description' content='Trang thông tin điện tử Sở Văn hóa, Thể thao và Du lịch tỉnh Bắc Kạn' />
    <meta name='keywords' content='Trang thông tin điện tử Sở Văn hóa, Thể thao và Du lịch tỉnh Bắc Kạn' />

    <meta property="og:url" content="index.html" />
    <meta property="og:title" content="Sở Văn hóa, Thể thao và Du lịch tỉnh Bắc Kạn" />
    <meta property="og:image" content="images/logo.png" />
    <meta property="og:description" content="Trang thông tin Sở Văn hóa, Thể thao và Du lịch tỉnh Bắc Kạn" />

    <link rel="icon" href="images/science-symbol.ico" type="image/x-icon">
    <link rel="shortcut icon" href="images/science-symbol.ico" type="image/x-icon">
    <link rel="stylesheet" href="mix/appaa4caa4c.css?id=aca541bc3119d366502f">
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCRbbI-IH80_-AgZbiq1lKAkcOoavIWTEc"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <!-- Trong layout chính, thêm vào phần head -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/viewerjs/1.11.6/viewer.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/viewerjs/1.11.6/viewer.min.js"></script>
    @stack('styles')

    <style>
        #table_articles {
            font-family: "Trebuchet MS", Arial, Helvetica, sans-serif;
            border-collapse: collapse;
            width: 100%;
        }

        #table_articles td,
        #table_articles th {
            border: 1px solid #ddd;
            padding: 8px;
        }

        #table_articles tr:nth-child(even) {
            background-color: #f2f2f2;
        }

        #table_articles tr:hover {
            background-color: #ddd;
        }

        #table_articles th {
            padding-top: 12px;
            padding-bottom: 12px;
            text-align: left;
            background-color: #4CAF50;
            color: white;
        }

        .clickable {
            width: 100%;
            height: 100%;
            /*Important:*/

            position: relative;
        }

        .link-spanner {
            position: absolute;
            width: 100%;
            height: 100%;
            top: 0;
            left: 0;
            z-index: 1;
            /* edit: fixes overlap error in IE7/8,
           make sure you have an empty gif
        background-image: url('empty.gif');*/
        }

        .btn2 {
            color: #fff;
            display: inline-block;
            outline: none;
            cursor: pointer;
            text-align: center;
            text-decoration: none;
            font: 14px/100% Arial, Helvetica, sans-serif;
            padding: .5em 2em .55em;
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

        /*-----Phan trang ------*/
        .pagination {
            display: inline-block;
            padding-left: 0;
            margin: 20px 0;
            border-radius: 4px;
        }

        .pagination>li {
            display: inline;
        }

        .pagination>li>a,
        .pagination>li>span {
            position: relative;
            float: left;
            padding: 6px 12px;
            margin-left: -1px;
            line-height: 1.42857143;
            color: #337ab7;
            text-decoration: none;
            background-color: #fff;
            border: 1px solid #ddd;
        }

        .pagination>li:first-child>a,
        .pagination>li:first-child>span {
            margin-left: 0;
            border-top-left-radius: 4px;
            border-bottom-left-radius: 4px;
        }

        .pagination>li:last-child>a,
        .pagination>li:last-child>span {
            border-top-right-radius: 4px;
            border-bottom-right-radius: 4px;
        }

        .pagination>li>a:hover,
        .pagination>li>span:hover,
        .pagination>li>a:focus,
        .pagination>li>span:focus {
            color: #23527c;
            background-color: #eee;
            border-color: #ddd;
        }

        .pagination>.active>a,
        .pagination>.active>span,
        .pagination>.active>a:hover,
        .pagination>.active>span:hover,
        .pagination>.active>a:focus,
        .pagination>.active>span:focus {
            z-index: 2;
            color: #fff;
            cursor: default;
            background-color: #337ab7;
            border-color: #337ab7;
        }

        .pagination>.disabled>span,
        .pagination>.disabled>span:hover,
        .pagination>.disabled>span:focus,
        .pagination>.disabled>a,
        .pagination>.disabled>a:hover,
        .pagination>.disabled>a:focus {
            color: #777;
            cursor: not-allowed;
            background-color: #fff;
            border-color: #ddd;
        }

        .pagination-lg>li>a,
        .pagination-lg>li>span {
            padding: 10px 16px;
            font-size: 18px;
        }

        .pagination-lg>li:first-child>a,
        .pagination-lg>li:first-child>span {
            border-top-left-radius: 6px;
            border-bottom-left-radius: 6px;
        }

        .pagination-lg>li:last-child>a,
        .pagination-lg>li:last-child>span {
            border-top-right-radius: 6px;
            border-bottom-right-radius: 6px;
        }

        .pagination-sm>li>a,
        .pagination-sm>li>span {
            padding: 5px 10px;
            font-size: 12px;
        }

        .pagination-sm>li:first-child>a,
        .pagination-sm>li:first-child>span {
            border-top-left-radius: 3px;
            border-bottom-left-radius: 3px;
        }

        .pagination-sm>li:last-child>a,
        .pagination-sm>li:last-child>span {
            border-top-right-radius: 3px;
            border-bottom-right-radius: 3px;
        }
    </style>
    @stack('styles')
</head>

<body>

    <div class="main_content">

        <x-website.banner />
        <div class="bottom-line"></div>
        <x-website.menu />
        <x-website.date-time />


        <div class="MenuChildren"></div>

    </div>
    <div class="test only its not visible"></div>

    <div class="main_content">
        <div class="wrapper">
            <div class="Content_Left">
                {{ $slot }}
            </div>
            <script>
                var slideIndex = 0;
                var slideIndex_2 = 0;
                showSlides();

                function showSlides() {
                    var i;
                    var i_2;
                    var slides = document.getElementsByClassName("_banner");
                    var slides_2 = document.getElementsByClassName("_banner_2");

                    for (i = 0; i < slides.length; i++) {
                        slides[i].classList.add('hidden');
                    }
                    for (i = 0; i < slides_2.length; i++) {
                        slides_2[i].classList.add('hidden');
                    }

                    slideIndex++;
                    slideIndex_2++;

                    if (slideIndex > slides.length) {
                        slideIndex = 1
                    }
                    if (slideIndex_2 > slides_2.length) {
                        slideIndex_2 = 1
                    }

                    slides[slideIndex - 1].classList.remove('hidden');
                    slides_2[slideIndex_2 - 1].classList.remove('hidden');
                    setTimeout(showSlides, 4000);
                }
            </script>
            <div class="Content_Right">
                <div class="notification-box">
                    <div class="notification-header" style="text-align: center;">
                        <a href="https://thongtincoban.backan.gov.vn/map/du_lich2.php">BẢN ĐỒ DU LỊCH TỈNH BẮC KẠN</a>
                    </div>
                    <div>
                        <iframe scrolling="no" src="https://thongtincoban.backan.gov.vn/map/du_lich2.php"
                            style="border: 0px none; height: 350px; width: 100%; border: 1px solid #d3d3d3;"
                            allowfullscreen="true">
                        </iframe>
                    </div>
                </div>

                @if (request()->routeIs('home.child.*'))
                @else
                    <x-website.video />
                    <x-website.announcement />
                @endif
                <x-website.addon />
            </div>

        </div>
    </div>

    <div id="rs" style="display:none;">
        <div class="wrapper">
            <div class="box">
                <div class="header">
                    <h2>Lịch tiếp công dân</h2>
                    <img class="ribbon" src="images/m_design.webp" alt="">
                </div>
                <div class="body">
                    <p><span style="font-size: 14pt;">Sở Khoa học v&agrave; C&ocirc;ng nghệ th&ocirc;ng b&aacute;o lịch
                            tiếp c&ocirc;ng d&acirc;n năm 2021, như sau:</span>
                    </p>
                    <p style="text-align: justify;"><strong><span style="font-size: 14pt;">1. Lịch tiếp c&ocirc;ng
                                d&acirc;n</span></strong>
                        <br /><span style="font-size: 14pt;">- Tiếp c&ocirc;ng d&acirc;n định kỳ: Gi&aacute;m đốc Sở
                            Khoa học v&agrave; C&ocirc;ng nghệ tiếp c&ocirc;ng d&acirc;n định kỳ v&agrave;o ng&agrave;y
                            20 hằng th&aacute;ng, nếu tr&ugrave;ng v&agrave;o ng&agrave;y nghỉ, ng&agrave;y lễ sẽ tiếp
                            c&ocirc;ng d&acirc;n v&agrave;o ng&agrave;y l&agrave;m việc tiếp theo liền kề. Trường hợp
                            Gi&aacute;m đốc bận c&ocirc;ng việc đột xuất hoặc đi c&ocirc;ng t&aacute;c th&igrave; ủy
                            quyền cho Ph&oacute; Gi&aacute;m đốc Sở tiếp c&ocirc;ng d&acirc;n.</span>
                        <br /><span style="font-size: 14pt;">- Tiếp c&ocirc;ng d&acirc;n đột xuất: Gi&aacute;m đốc Sở
                            Khoa học v&agrave; C&ocirc;ng nghệ tiếp c&ocirc;ng d&acirc;n đột xuất theo từng vụ việc. -
                            Tiếp c&ocirc;ng d&acirc;n thường xuy&ecirc;n: Thanh tra Sở tiếp c&ocirc;ng d&acirc;n thường
                            xuy&ecirc;n v&agrave;o c&aacute;c ng&agrave;y l&agrave;m việc trong tuần.</span>
                    </p>
                    <p><strong><span style="font-size: 14pt;">2. Thời gian tiếp c&ocirc;ng d&acirc;n</span></strong>
                        <br /><span style="font-size: 14pt;">- Buổi s&aacute;ng: Từ 7h 30&rsquo; đến 11h
                            30&rsquo;</span>
                        <br /><span style="font-size: 14pt;">- Buổi chiều: Từ 13h 30&rsquo; đến 16h 30&rsquo;</span>
                    </p>
                    <p><strong><span style="font-size: 14pt;">3. Địa điểm tiếp c&ocirc;ng d&acirc;n:</span></strong>
                        <br /><span style="font-size: 14pt;">Tại ph&ograve;ng Tiếp c&ocirc;ng d&acirc;n, Số 63 -
                            L&ecirc; Qu&yacute; Đ&ocirc;n, Phường Nguyễn Tr&atilde;i</span>
                    </p>
                </div>
            </div>
        </div>
    </div>

    <x-website.footer />
    <script type="text/javascript" src="mix/appf26bf26b.js?id=a62ffff63c881fd78e8e"></script>
    <script>
        $("#notification").simplyScroll({
            orientation: 'vertical',
            auto: true,
            manualMode: 'loop',
            frameRate: 20,
            speed: 1
        });
    </script>
    <script>
        $(function() {
            $('#rs').on('click', function() {
                $(this).hide()
            })
            $('#reception-btn').on('click', function() {
                $('#rs').show()
            })
        })
    </script>
    @stack('scripts')
</body>

</html>
