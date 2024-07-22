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
                margin-left: 10px; 
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
        </style>
    @endpush
    <script src="https://www.google.com/recaptcha/api.js?hl=vi"></script>
    <div class="col-lg-12">
        <div class="panel panel-primary">
            <div id="demo1" class="collapse">
                <div id="lienhe">
                    <div style="font-size: 16px; text-align: center">
                        <h2>SỞ VĂN HÓA, THỂ THAO & DU LỊCH TỈNH BẮC KẠN</h2>
                        <strong>Địa chỉ: </strong> Tổ 7, phường Nguyễn Thị Minh Khai, thành phố Bắc Kạn, tỉnh Bắc Kạn
                        <br>
                        <strong>Điện thoại: </strong>0209.3872.652; <br>
                        <strong>Email: </strong>svhttdl@backan.gov.vn
                    </div>
                    <div style="text-align: center; font-size: 20px; color: #0013C8; padding-top:10px; ">
                        <h2 style="font-weight: bold; font-family: Times New Roman;">LIÊN HỆ </h2>
                    </div>
                    <div class="form">
                        <form method="post" action="{{ route('contact.store') }}">
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
                                    <input style="height: 20px;" type="text" name="phone" placeholder="1234567890">
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
                            <div class="g-recaptcha" data-sitekey="6LcPBrojAAAAAE9KlDVhspZHiLZtwxZQnmSuTCTU"
                                style="margin-left: 10px;">
                                <div style="width: 304px; height: 78px;">
                                    <div><iframe title="reCAPTCHA" width="304" height="78" role="presentation"
                                            name="a-d7s9106k610t" frameborder="0" scrolling="no"
                                            sandbox="allow-forms allow-popups allow-same-origin allow-scripts allow-top-navigation allow-modals allow-popups-to-escape-sandbox allow-storage-access-by-user-activation"
                                            src="https://www.google.com/recaptcha/api2/anchor?ar=1&amp;k=6LcPBrojAAAAAE9KlDVhspZHiLZtwxZQnmSuTCTU&amp;co=aHR0cHM6Ly9zb3ZodHRkbC5iYWNrYW4uZ292LnZuOjQ0Mw..&amp;hl=vi&amp;v=rKbTvxTxwcw5VqzrtN-ICwWt&amp;size=normal&amp;cb=850ft27z93zr"></iframe>
                                    </div>
                                    <textarea id="g-recaptcha-response" name="g-recaptcha-response" class="g-recaptcha-response"
                                        style="width: 250px; height: 40px; border: 1px solid rgb(193, 193, 193); margin: 10px 25px; padding: 0px; resize: none; display: none;"></textarea>
                                </div><iframe style="display: none;"></iframe>
                            </div>
                            <br>
                            <input type="submit" value="Gửi liên hệ" class="btn1 blue">
                        </form>
                        <br>
                        <br>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <iframe
        src="https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d8600.455617662767!2d105.84422204042693!3d22.15542304622473!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x0%3A0x2576094c478ea43f!2zU-G7nyBWxINuIGjDs2EsIFRo4buDIHRoYW8gdsOgIER1IGzhu4tjaCBC4bqvYyBL4bqhbg!5e0!3m2!1svi!2s!4v1671508661808!5m2!1svi!2s"
        width="100%" height="550" style="border:0;" allowfullscreen="" loading="lazy"
        referrerpolicy="no-referrer-when-downgrade"></iframe>
</x-website-layout>
