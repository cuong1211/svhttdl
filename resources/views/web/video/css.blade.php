<style>
    .box-left-home {
        /*overflow: auto;*/
        margin-bottom: 20px;
    }

    .head-cm {
        width: 100%;
        border-bottom: 1px solid #D71921;
        margin-bottom: 20px;
    }

    .head-cm .xemthem {
        float: right;
        font: 400 13px Roboto, Arial, Tahoma;
        color: #be1e2d;
        display: block;
        padding-top: 12px;
    }

    .head-cm ul {
        display: inline-flex;
        list-style: none;
    }

    .head-cm ul li {}

    .head-cm ul li a {
        color: #404041;
        font: 400 13px/35px Roboto, Arial, Tahoma;
        padding: 0 15px;
        border-right: 1px solid #ddd;
    }

    .head-cm ul li:first-child {
        background: url('images/bg-chuyenmuc.png') no-repeat right top;
    }

    .head-cm ul li:first-child a {
        color: #FFF;
        font: 700 16px/35px Roboto, Arial, Tahoma;
        text-transform: uppercase;
        border-right: none;
        padding: 0 30px 0 20px;
    }

    .head-cm ul li:last-child a {
        border-right: none;
    }

    .box-top3 {
        overflow: hidden;
    }

    .box-top3 ul {}

    .box-top3 ul li {
        width: 30.71428571428571%;
        margin-right: 3.8%;
        float: left;
        position: relative;
        list-style: none;
    }

    .box-top3 ul li img {
        width: 100%;
        height: 125px;
    }

    .box-top3 ul li .bg-video {
        background: url('images/i-play-video.html') no-repeat bottom left;
    }

    .box-top3 ul li:nth-child(3n + 3) {
        margin-right: 0;
    }

    .box-top3 ul li a {
        text-align: justify;
        font: 600 14px/18px Roboto, Arial, Tahoma;
        color: #58595B;
        display: block;
    }

    .box-top3 ul li h3 a {
        padding: 10px 0;
    }

    .box-top3 ul li a.iconplay {
        width: 45px;
        height: 45px;
        position: absolute;
        left: 0;
        bottom: 0px;
        background: url(images/i-play-video-2.html) no-repeat;
        float: left;
    }

    .box-top3 ul li a.iconAlb {
        width: 45px;
        height: 45px;
        position: absolute;
        left: 0;
        top: 80px;
        background: url(images/viewAlb.html) no-repeat;
        float: left;
    }

    .box-top3 ul li a.audioPlay {
        width: 45px;
        height: 45px;
        position: absolute;
        left: 0;
        top: 80px;
        background: url(images/i-play-audio.html) no-repeat;
        float: left;
    }

    .boxhotmedia {
        overflow: auto;
        padding-bottom: 30px;
    }

    .topmedia {
        overflow: hidden;
        margin-bottom: 30px;
    }

    .top1-media {
        width: 61.14285714285714%;
        float: left;
        position: relative;
    }

    .top1-media img {
        width: 100%;
        height: 257px;
    }

    .top1-media h1 a {
        color: #414042;
        font: 700 18px/25px Roboto, Arial, Tahoma;
        display: block;
        margin: 10px 0;
    }

    .top1-media a.iconplay {
        width: 45px;
        height: 45px;
        position: absolute;
        left: 0;
        top: 212px;
        background: url(images/i-play-video-2.html) no-repeat;
        float: left;
    }

    .top3-media {
        width: 35.14285714285714%;
        float: right;
    }

    .top3-media .f1 {
        position: relative;
        margin-bottom: 10px;
    }

    .top3-media .f1 img {
        width: 246px;
        height: 144px;
    }

    .top3-media .f1 a.iconplay {
        width: 45px;
        height: 45px;
        position: absolute;
        left: 0;
        top: 99px;
        background: url(images/i-play-video-2.html) no-repeat;
        float: left;
    }

    .top3-media .f1 h2 a {
        color: #414042;
        font: 700 15px/18px Roboto, Arial, Tahoma;
        display: block;
        text-align: justify;
        margin-top: 5px;
    }

    .top3-media .f2 {}

    .top3-media .f2 ul li {
        width: 45%;
        float: left;
        position: relative;
        margin-right: 23px;
        list-style: none;
    }

    .top3-media .f2 ul li:last-child {
        margin-right: 0;
    }

    .top3-media .f2 h3 a {
        color: #58595B;
        font: 400 13px/15px Roboto, Arial, Tahoma;
        display: block;
        text-align: justify;
        margin-top: 5px;
    }

    .top3-media .f2 a.iconAlb {
        width: 45px;
        height: 45px;
        position: absolute;
        left: 0;
        top: 41px;
        background: url(images/viewAlb.html) no-repeat;
        float: left;
        background-size: 70%;
    }

    .top3-media .f2 img {
        width: 110px;
        height: 72px;
    }

    .top3-media ul li img {
        width: 215px;
    }

    .full-left .box-left-home:last-child {
        border-bottom: none;
    }

    .fix3n {
        border-bottom: 1px solid #ddd;
    }

    .fix3n li {
        min-height: 200px;
        margin-bottom: 10px;
    }

    .fix3n li:nth-child(3n) {
        margin-right: 0;
    }

    .fixalbumdetail {
        padding-bottom: 0;
        border-bottom: none;
        /*  width:702px; */
    }

    .fixalbumdetail .box-top3 li {
        min-height: 200px;
        list-style: none;
    }

    .info-album {
        overflow: auto;
        margin-bottom: 10px;
        border-bottom: 1px solid #ddd;
        padding-bottom: 10px;
    }

    .info-album h1 {
        color: #58595B;
        font: 600 16px/20px Roboto, Arial, Tahoma;
    }

    .info-album p {
        font: 400 13px/18px Roboto, Arial, Tahoma;
        margin: 5px 0;
    }

    .info-album div span {
        font: 400 13px/18px Roboto, Arial, Tahoma;
        margin-right: 20px;
    }

    .audiotop1 {
        position: relative;
    }

    .audiotop1 h1 a {
        color: #414042;
        font: 700 18px/23px Roboto, Arial, Tahoma;
        display: block;
        text-align: justify;
        margin: 10px 0;
    }

    .audiotop1 a.playaudiotop1 {
        width: 45px;
        height: 45px;
        position: absolute;
        left: 0;
        top: 347px;
        background: url(images/i-play-audio.html) no-repeat;
        float: left;
    }

    .video-other li {
        min-height: 240px !important;
    }

    .title-video {
        font: 700 18px/23px Roboto, Arial, Tahoma;
        padding: 10px 0;
    }

    .my-video-dimensions {
        width: 100% !important;
    }
</style>
