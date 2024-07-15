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
        </style>
    @endpush
    <div class="col-lg-12">
        <div class="panel panel-primary">
            <div id="demo1" class="collapse">
                <div id="lienhe">
                    <div style="text-align: center; font-size: 20px; color: #0013C8; padding-top:10px; ">
                        <h2 style="font-weight: bold; font-family: Times New Roman;">Ý kiến của bạn đã được gửi thành
                            công</h2>
                        <a style="font-weight: bold; font-family: Times New Roman; color; white"
                            href="{{ route('doc_opi.index') }}">Quay lại trang văn bản đóng góp ý kiến</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-website-layout>
