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
    <link rel="stylesheet" href="../cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="mix/appaa4caa4c.css?id=aca541bc3119d366502f">
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCRbbI-IH80_-AgZbiq1lKAkcOoavIWTEc"></script>

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
                        <a href="modules/bando_dulich.html">BẢN ĐỒ DU LỊCH TỈNH BẮC KẠN</a>
                    </div>
                    <div>
                        <iframe scrolling="no" src="map/du_lich2.html"
                            style="border: 0px none; height: 350px; width: 100%; border: 1px solid #d3d3d3;"
                            allowfullscreen="true">
                        </iframe>
                    </div>
                </div>

                <div class="notification-box">
                    <div class="notification-header" style="text-align: center;">
                        <a href="index788c.html?com=video">VIDEO</a>
                    </div>
                    <div>
                        <iframe src="https://drive.google.com/file/d/1FAmbegjkoxRpFnu-j4c7D0XkgtL3NZDJ/preview"
                            width="100%" height="auto" allowfullscreen="true"></iframe>
                    </div>
                </div>
                <div>
                    <div class="notification-box">
                        <div class="notification-header">
                            <svg xmlns="http://www.w3.org/2000/svg" style="color:#ddd;" width="20"
                                fill="#fff" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9" />
                            </svg>
                            <a href="indexe13f.html?com=thong-bao">THÔNG BÁO MỚI</a>
                        </div>
                        <div class="notification-body">
                            <ul id="notification">
                                <li><a href="index2527.html?com=thongbao_ct&amp;id_tb=46">Thông báo Về việc phát động
                                        Cuộc thi Ảnh đẹp Du lịch Bắc Kạn năm 2024</a>
                                </li>
                                <li><a href="indexfe02.html?com=thongbao_ct&amp;id_tb=45">Thông báo về việc thuê môi
                                        trường rừng để kinh doanh du lịch trong Khu Bảo tồn loài - sinh cảnh Nam Xuân
                                        Lạc</a>
                                </li>
                                <li><a href="index3458.html?com=thongbao_ct&amp;id_tb=44">Kế hoạch công tác năm 2024 -
                                        Thư viện tỉnh Bắc Kạn</a>
                                </li>
                                <li><a href="index8003.html?com=thongbao_ct&amp;id_tb=43">Kế hoạch công tác năm 2024 -
                                        TT Huấn luyện thi đấu TDTT</a>
                                </li>
                                <li><a href="index38a0.html?com=thongbao_ct&amp;id_tb=42">Thông báo tuyển dụng viên
                                        chức, chỉ tiêu năm 2023</a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>

                <div id="reception-btn" style="margin-bottom: 5px;">
                    <a href="index1d06.html?com=gopy-duthao">
                        <img style="width:100%;" src="upload/images/lien_ket_linnk/duthao.png" alt="">
                    </a>
                </div>
                <div id="reception-btn" style="margin-bottom: 5px;">
                    <a href="https://hscvsovh.backan.gov.vn/sovhttdl/qlvb/lichct.nsf">
                        <img style="width:100%;" src="upload/images/lien_ket_linnk/lich_ct.png" alt="">
                    </a>
                </div>
                <div id="reception-btn" style="margin-bottom: 5px;">
                    <a
                        href="https://mail.backan.gov.vn/owa/auth/logon.aspx?replaceCurrent=1&amp;url=https%3a%2f%2fmail.backan.gov.vn%2fowa%2f">
                        <img style="width:100%;" src="upload/images/lien_ket_linnk/hom_thu.png" alt="">
                    </a>
                </div>
                <div id="reception-btn" style="margin-bottom: 5px;">
                    <a href="indexe610.html?com=lien-he">
                        <img style="width:100%;" src="upload/images/lien_ket_linnk/duong_day_nong.png"
                            alt="">
                    </a>
                </div>
                <div id="reception-btn" style="margin-bottom: 5px;">
                    <a href="index95f5.html?com=danhmuc_tin&amp;id_category=10">
                        <img style="width:100%;" src="upload/images/lien_ket_linnk/tt_hc.png" alt="">
                    </a>
                </div>
                <div id="reception-btn" style="margin-bottom: 5px;">
                    <a href="index62ce.html?com=danhmuc_tin&amp;id_category=25">
                        <img style="width:100%;" src="upload/images/lien_ket_linnk/cong_khai.png" alt="">
                    </a>
                </div>
                <div id="reception-btn" style="margin-bottom: 5px;">
                    <a href="index56c7.html?com=danhmuc_tin&amp;id_category=22">
                        <img style="width:100%;" src="upload/images/lien_ket_linnk/hoatdong_doanthe.png"
                            alt="">
                    </a>
                </div>
                <div id="reception-btn" style="margin-bottom: 5px;">
                    <a href="index4a48.html?com=danhmuc_tin&amp;id_category=21">
                        <img style="width:100%;" src="upload/images/lien_ket_linnk/phobien_phapluat.png"
                            alt="">
                    </a>
                </div>
                <div id="reception-btn" style="margin-bottom: 5px;">
                    <a href="index93d0.html?com=galery">
                        <img style="width:100%;" src="upload/images/lien_ket_linnk/tv_anh.png" alt="">
                    </a>
                </div>
                <div id="reception-btn" style="margin-bottom: 5px;">
                    <a href="indexa1ec.html?com=danhmuc_tin&amp;id_category=26">
                        <img style="width:100%;" src="upload/images/chuyendoiso.png" alt="">
                    </a>
                </div>
                <div id="reception-btn" style="margin-bottom: 5px;">
                    <a href="#">
                        <img style="width:100%;" src="#" alt="">
                    </a>
                </div>
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

</body>



<!-- Mirrored from sovhttdl.backan.gov.vn/ by HTTrack Website Copier/3.x [XR&CO'2014], Sat, 15 Jun 2024 03:41:38 GMT -->

</html>
