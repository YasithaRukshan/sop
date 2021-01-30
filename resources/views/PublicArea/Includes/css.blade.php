<!-- Google Fonts -->
<link href="https://fonts.googleapis.com/css?family=Josefin+Sans:300,300i,400,400i,600,600i,700,700i&display=swap"
    rel="stylesheet">
<link
    href="https://fonts.googleapis.com/css?family=Muli:300,300i,400,400i,500,500i,600,600i,700,700i,800,800i,900,900i&display=swap"
    rel="stylesheet">

<!-- Stylesheets -->
<link href="{{ asset('PublicArea/css/font-awesome-all.css') }}" rel="stylesheet">
<link href="{{ asset('PublicArea/css/flaticon.css') }}" rel="stylesheet">
<link href="{{ asset('PublicArea/css/owl.css') }}" rel="stylesheet">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css"
    integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
<link href="{{ asset('PublicArea/css/jquery.fancybox.min.css') }}" rel="stylesheet">
<link href="{{ asset('PublicArea/css/animate.css') }}" rel="stylesheet">
<link href="{{ asset('PublicArea/css/imagebg.css') }}" rel="stylesheet">
<link href="{{ asset('PublicArea/css/global.css') }}" rel="stylesheet">
<link href="{{ asset('PublicArea/css/header.css') }}" rel="stylesheet">
<link href="{{ asset('PublicArea/css/color.css') }}" rel="stylesheet">
<link href="{{ asset('PublicArea/css/style.css') }}" rel="stylesheet">
<link href="{{ asset('PublicArea/css/responsive.css') }}" rel="stylesheet">

{{-- font-awesome CSS --}}
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css"
    integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">

{{-- rangeslider CSS --}}
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/rangeslider.js/2.3.3/rangeslider.min.css">

<!-- select2 CSS-->
<link href="https://cdn.jsdelivr.net/npm/select2@4.0.12/dist/css/select2.min.css" rel="stylesheet" />
<link rel="stylesheet"
    href="https://cdnjs.cloudflare.com/ajax/libs/select2-bootstrap-theme/0.1.0-beta.10/select2-bootstrap.min.css">

<!-- query-ui CSS-->
<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
<link rel="stylesheet" href="https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/themes/ui-lightness/jquery-ui.css">

<!-- sptoast CSS-->
<link rel="stylesheet" href="{{ asset('PublicArea/css/sptoast.css') }}">


<style>
    @media only screen and (max-width: 1699px) {
        .banner-section .pattern-layer .pattern-1 {
            width: 84%;
        }
    }

    .main-header.style-five .logo-box .logo,
    .sticky-header.style-five .logo-box .logo {
        padding-top: 10px;
    }

    .sticky-header .logo-box {
        position: relative;
        float: left;
        padding: 0px !important;
        border: none !important;
    }

    .main-header img,
    .sticky-header img {
        height: 90px !important;
        max-width: auto !important;
    }

    .mbnScrolled {
        opacity: 1;
        background: #fff;
        left: 0px;
        top: 0px;
        box-shadow: 0 0 30px rgba(0, 0, 0, 0.20);
        width: 100%;
    }

    .banner-section .content-box h1 {
        position: relative;
        font-size: 60px;
        line-height: 66px;
        font-weight: 700;
        margin-bottom: 24px;
        color: #ffffff;
    }

    .banner-section .content-box p {
        font-size: 18px;
        line-height: 30px;
        margin-bottom: 40px;
        color: #ffffff;
    }

    .banner-section .pattern-layer .pattern-1 {
        height: 820px;
    }

    /*
    .main-menu .navigation>li>a:after {
        content: "";
    }

    .main-menu .navigation>li.current>a,
    .main-menu .navigation>li:hover>a {
        color: #a5fdf9;
    } */

    .main-menu .navigation>li.has-dropdown>a:after {
        content: "\f107";
    }

    .bg_sec_1 {
        background-color: #f6f6f6;
        padding-top: 80px;
        padding-bottom: 80px;
    }

    .bg_sec_2 {
        background-color: #ffffff;
        padding-top: 80px;
        padding-bottom: 80px;
    }

    .faq-page-section .content-box-one {
        position: relative;
        padding-bottom: 0px;
        border-bottom: 0;
        margin-bottom: 0;
    }

    .news-section .title-inner .pattern-layer .pattern-1 {
        width: 100vw;
    }


    .background-video-container {
        pointer-events: none;
        z-index: 10;
        position: absolute;
        top: 0rem;
        right: 0rem;
        bottom: 0rem;
        left: 0rem;
    }

    .background-video-container video {
        background-image: url("{{ asset('PublicArea/images/videobg.png') }}");
        background-size: container;
        height: auto;
        min-width: 100%;
        min-height: 100%;
        -webkit-transform: translateX(-50%) translateY(-50%);
        transform: translateX(-50%) translateY(-50%);
        width: auto;
        position: absolute;
        top: 50%;
        right: 0rem;
        bottom: 0rem;
        left: 50%;
        width: 114vw;
    }

    video::-webkit-media-controls-start-playback-button {
        display: none;
    }

    .banner-section {
        height: 100vh;
    }

    .sec-title {
        margin-bottom: 0px;
    }


    .main-menu .theme-btn {
        padding: 7px 30px !important;
    }

    .theme-btn-li {
        padding-top: 28px !important;
    }

    .sticky-header .theme-btn-li {
        padding-top: 15px !important;
    }

    @media only screen and (max-width: 599px) {
        .main-header {
            position: fixed !important;
        }

        .mbnScrolled {
            background: rgba(0, 0, 0, 0) !important;
        }

        .mbnScrolled .menu-area .mobile-nav-toggler .icon-bar {
            background: #ffffff !important;
        }


        .background-video-container video {
            width: auto;
        }

        .banner-section .content-box h1 {
            font-size: 2rem;
            line-height: 2.5rem;
            font-weight: 600;
            margin-bottom: 6px;
        }

        .banner-section .content-box p {
            font-size: 20px;
            line-height: 24px;
            margin-bottom: 30px;
            color: #ffffff;
        }

        .background-video-container video {
            background-image: url("{{ asset('PublicArea/images/background/bg1.png') }}");
            background-size: cover;
            height: 100vh;
            min-width: 100%;
            min-height: 100%;
            top: 50%;
        }

        .theme-btn {
            position: relative;
            display: inline-block;
            font-size: 14px;
            line-height: 17px;
            font-weight: 700 !important;
            font-family: 'Josefin Sans', sans-serif;
            color: #fff !important;
            background: transparent;
            padding: 7px 30px;
            text-align: center;
            cursor: pointer;
            background-size: 200% auto;
            border-radius: 5px;
            z-index: 1;
            transition: all 500ms ease;
        }

        .banner-section .content-box .btn-box .theme-btn.style-one {
            padding: 8px;
            border-radius: 3px;
            margin-right: 0px;
            font-weight: 700;
        }

        .banner-section .content-box .btn-box .theme-btn.style-two {
            padding: 8px;
            border-radius: 3px;
            margin-right: 0px;
            font-weight: 700;
            background: #f6f6f6;
        }
    }




    .rangeslider {
        position: relative;
        height: 4px;
        border-radius: 5px;
        width: 100%;
        background-color: gray;
    }

    .rangeslider__handle {
        transition: background-color .2s;
        box-sizing: border-box;
        width: 20px;
        height: 20px;
        border-radius: 100%;
        background-color: #0099FF;
        touch-action: pan-y;
        cursor: pointer;
        display: inline-block;
        position: absolute;
        z-index: 3;
        top: -8px;
        box-shadow: 0 1px 3px rgba(0, 0, 0, 0.5), inset 0 0 0 2px white;
    }

    .rangeslider__handle__value {
        transition: background-color .2s, box-shadow .1s, transform .1s;
        box-sizing: border-box;
        width: 120px;
        text-align: center;
        padding: 10px;
        background-color: #0099FF;
        border-radius: 5px;
        color: white;
        left: -51px;
        top: -55px;
        position: absolute;
        white-space: nowrap;
        border-top: 1px solid #007acc;
        box-shadow: 0 -4px 1px rgba(0, 0, 0, 0.07), 0 -5px 20px rgba(0, 0, 0, 0.3);
    }

    .rangeslider__handle__value:before {
        transition: border-top-color .2s;
        position: absolute;
        bottom: -10px;
        left: calc(50% - 10px);
        content: "";
        width: 0;
        height: 0;
        border-left: 10px solid transparent;
        border-right: 10px solid transparent;
        border-top: 10px solid;
        border-top-color: #0099FF;
    }

    .rangeslider__handle__value:after {
        content: "";
    }

    .rangeslider__fill {
        position: absolute;
        top: 0;
        z-index: 1;
        height: 100%;
        background-color: #0099FF;
        border-radius: 5px;
    }

    .rangeslider__labels {
        position: absolute;
        width: 100%;
        z-index: 2;
        display: flex;
        justify-content: space-between;
    }

    .rangeslider__labels__label {
        font-size: 0.75em;
        position: relative;
        padding-top: 15px;
        color: gray;
    }

    .rangeslider__labels__label:before {
        position: absolute;
        top: 0;
        left: 50%;
        transform: translateX(-50%);
        content: "";
        width: 1px;
        height: 9px;
        border-radius: 1px;
        background-color: rgba(128, 128, 128, 0.5);
    }

    .rangeslider__labels__label:first-child:before,
    .rangeslider__labels__label:last-child:before {
        height: 12px;
        width: 2px;
    }

    .rangeslider__labels__label:first-child:before {
        background-color: #0099FF;
    }

    .rangeslider__labels__label:last-child:before {
        background-color: gray;
    }

    .rangeslider__labels__label:first-child {
        transform: translateX(-48%);
    }

    .rangeslider__labels__label:last-child {
        transform: translateX(48%);
    }

    .rangeslider.rangeslider--active .rangeslider__handle,
    .rangeslider.rangeslider--active .rangeslider__handle * {
        background-color: #33adff;
    }

    .rangeslider.rangeslider--active .rangeslider__handle *:before {
        border-top-color: #33adff;
    }

    .rangeslider.rangeslider--active .rangeslider__handle__value {
        transform: translateY(-5px);
        box-shadow: 0 -3px 2px rgba(0, 0, 0, 0.04), 0 -9px 25px rgba(0, 0, 0, 0.15);
    }

    #wtiPriceParent .rangeslider__handle {
        background-color: #ff7b00;
    }


    #wtiPriceParent .rangeslider__handle__value {
        background-color: #ff7b00;
        border-top: 1px solid #cc6300;
    }


    #wtiPriceParent .rangeslider__handle__value:before {
        border-top-color: #ff7b00;
    }

    #wtiPriceParent .rangeslider__handle__value:after {
        content: " USD";
    }

    #wtiPriceParent .rangeslider__fill {
        background-color: #ff7b00;
    }


    #wtiPriceParent .rangeslider__labels__label:first-child:before {
        background-color: #ff7b00;
    }

    #wtiPriceParent .rangeslider.rangeslider--active .rangeslider__handle,
    #wtiPriceParent .rangeslider.rangeslider--active .rangeslider__handle * {
        background-color: #fa7c33;
    }

    #wtiPriceParent .rangeslider.rangeslider--active .rangeslider__handle *:before {
        border-top-color: #fa7c33;
    }


    #avgOilRecoveryParent .rangeslider__handle {
        background-color: #038b37;
    }


    #avgOilRecoveryParent .rangeslider__handle__value {
        background-color: #038b37;
        border-top: 1px solid #036327;
    }


    #avgOilRecoveryParent .rangeslider__handle__value:before {
        border-top-color: #038b37;
    }

    #avgOilRecoveryParent .rangeslider__handle__value:after {
        content: "";
    }

    #avgOilRecoveryParent .rangeslider__fill {
        background-color: #038b37;
    }


    #avgOilRecoveryParent .rangeslider__labels__label:first-child:before {
        background-color: #038b37;
    }

    #avgOilRecoveryParent .rangeslider.rangeslider--active .rangeslider__handle,
    #avgOilRecoveryParent .rangeslider.rangeslider--active .rangeslider__handle * {
        background-color: #036327;
    }

    #avgOilRecoveryParent .rangeslider.rangeslider--active .rangeslider__handle *:before {
        border-top-color: #036327;
    }

    .reve-value {
        font-size: 2rem;
        color: rgb(10, 10, 130);
        font-weight: 300;
        border-bottom: 2px solid;
    }

    .bg-size-contain {
        background-size: contain !important;
    }

    .bg-size-cover {
        background-size: cover !important;
    }

    .bg-size-auto {
        background-size: auto !important;
    }


    .bg-size-contain-60 {
        background-size: 58% !important;
    }

    .main-footer .widget-section .about-widget .widget-content .box {
        padding-left: 0px;
    }

    .main-footer .footer-top {
        background: #18003a;
    }

    /* Small devices (portrait tablets and large phones, 600px and up) */
    @media only screen and (max-width: 600px) {
        .two-column p {
            text-align: center;
        }

        .text p {
            text-align: center;
        }

        .bg-size-contain {
            background-size: 80% !important;
            padding: 100px 0px !important;
        }

        .bg-size-contain-60 {
            background-size: 60% !important;
            padding: 100px 0px !important;
        }

        .bg-size-cover {
            background-size: 100% !important;
            padding: 100px 0px !important;
        }

        .reve-value {
            font-size: 2.3rem;
            color: rgb(10, 10, 130);
            font-weight: 300;
            border-bottom: 2px solid;
        }

        .bg-size-auto {
            background-size: 80% !important;
            padding: 100px 0px !important;
        }

        .d-sml-none {
            margin-left: 125px;
        }

        .footer-column {
            padding-bottom: 2rem;
        }

        .footer-widget .widget-title h3 {
            text-align: center;
        }

        .footer-widget .usefullinks {
            margin-left: 40% !important;
        }

        .footer-widget .contact-us {

            text-align: center;
        }

        .theme-btn.style-two {
            background: #1d165c;
            color: #fff !important;
        }

        .rangeslider__labels__label {

            font-size: 0.50em;
        }
    }

    .mobile-menu .menu-box {
        background: #ffff;
    }

    .mobile-menu .navigation li>a {
        color: #1d165c;
    }

    .mobile-menu .close-btn {
        color: #1d165c;
    }

    .mobile-menu .navigation li>a:before {
        border-left: 5px solid #1d165c;
    }

    .main-footer .widget-section .contact-widget .widget-content .box h5 {
        color: #1d165c;
    }

    .main-footer .widget-section .widget-title h3 {
        color: #1d165c;
    }

    .main-footer .widget-section .links-widget .widget-content ul li a {
        color: #1d165c;
    }

    .main-footer .widget-section .contact-widget .widget-content .box p {
        color: #1d165c;
    }

    .main-footer .footer-top {
        background: #ececec;
    }

    .main-footer .widget-section .contact-widget .widget-content .box li a:hover {
        color: rgb(90, 90, 90);
    }

    @media only screen and (max-width: 992px) {
        .d-footer-none {
            display: none;
        }

        .d-footer-none-new {
            display: block;
        }
    }

    @media only screen and (min-width: 992px) {
        .d-footer-none {
            display: block;
        }

        .d-footer-none-new {
            display: none;
        }
    }

    .theme-btn.style-one:hover {
        background-image: linear-gradient(to right, #ff9092 0%, #ff7eae 50%, #ff7d7f 100%);
        color: #000000 !important;
    }

    .main-footer .widget-section .links-widget .widget-content ul li a:hover {
        color: rgba(248, 12, 12, 0.6) !important;
    }


    .select2-container--default .select2-selection--single {
        background-color: #fff;
        border-radius: 3px;
        height: calc(1.5em + .94rem + 2px);
        border: 1px solid #e5e5e5;
        transition: box-shadow .15s ease;
        line-height: 1.5rem;
        font-size: .8125rem;
        padding: .37rem .45rem;
    }

    .select2-dropdown {
        box-shadow: 0 1px 3px rgba(50, 50, 93, 0.15), 0 1px 0 rgba(0, 0, 0, 0.02);
        border: 0;
        transition: box-shadow .15s ease;
    }


    .select2-container--default .select2-selection--single .select2-selection__arrow b {
        margin-top: 6px;
    }

    .select2-selection.select2-selection--single {
        border: 1px solid #e5e5e5;
        font-size: .8125rem;
        height: calc(2.6em + .94rem + 4px);
        line-height: 1.875rem;
    }

    .select2-container--default .select2-selection--multiple {
        background-color: #fff;
        border-radius: 3px;
        border: 1px solid #e5e5e5;
        transition: box-shadow .15s ease;
        line-height: 1.5rem;
        font-size: .8125rem;
    }

    .select2-container--default .select2-selection--multiple .select2-selection__arrow b {
        margin: 0 auto;
    }

    .select2-selection.select2-selection--multiple {
        transition: box-shadow .15s ease;
        border: 0;
        line-height: 1.5rem;
        font-size: .8125rem;
        line-height: 1.875rem;
    }

    .select2-container--default .select2-results__option--highlighted[aria-selected] {
        background-color: #337ab7;
        color: #fff;
    }

    .select2-container {
        width: 100% !important;
    }

    .footer-usefull {
        margin-right: 20%;
    }

    .useful-links-center {
        margin-left: 16px;
    }

    .useful-links-image-align {
        margin-left: 22%;
    }

    .select2-container .select2-selection--single .select2-selection__rendered {
        padding: 8px;
        font-size: 15px;
    }

    .select2-container *:focus {
        border-color: #fb6064 !important;
    }

    ol {
        display: block;
        list-style-type: lower-alpha;
        margin-block-start: 1em;
        margin-block-end: 1em;
        margin-inline-start: 0px;
        margin-inline-end: 0px;
        padding-inline-start: 40px;
    }



    /* ul,
    li {
        list-style: auto;
        padding: 0px;
        margin: 0px;
    } */

    .custom-ul {
        list-style: cross-fade() !important;
    }

    .custom-ol {
        list-style: lower-alpha !important;
    }
</style>
@yield('css')
