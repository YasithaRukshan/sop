<!--Plugin CSS file with desired skin-->
<link rel="stylesheet"
    href="https://cdnjs.cloudflare.com/ajax/libs/ion-rangeslider/2.3.1/css/ion.rangeSlider.min.css" />
<style>
    .about-iframe {
        display: block;
        height: 50vh;
    }

    @media only screen and (max-width: 991px) {
        .banner-section {
            padding: 200px 0px 100px 0px;
        }
    }

    .priceOfOil .irs--round .irs-bar {
        background-color: #0099FF !important;
    }

    .priceOfOil .irs--round .irs-handle {
        border: 4px solid #0099FF !important;
    }

    .priceOfOil .irs--round .irs-from,
    .priceOfOil .irs--round .irs-to,
    .priceOfOil .irs--round .irs-single {
        background-color: #0099FF;
    }

    .priceOfOil .irs--round .irs-from:before,
    .priceOfOil .irs--round .irs-to:before,
    .priceOfOil .irs--round .irs-single:before {
        border-top-color: #0099FF;
    }

    .wtiPrice .irs--round .irs-bar {
        background-color: #ff7b00 !important;
    }

    .wtiPrice .irs--round .irs-handle {
        border: 4px solid #ff7b00 !important;
    }

    .wtiPrice .irs--round .irs-from,
    .wtiPrice .irs--round .irs-to,
    .wtiPrice .irs--round .irs-single {
        background-color: #ff7b00;
    }

    .wtiPrice .irs--round .irs-from:before,
    .wtiPrice .irs--round .irs-to:before,
    .wtiPrice .irs--round .irs-single:before {
        border-top-color: #ff7b00;
    }

    .center-div {
        margin: auto;
        padding-right: 10%;
        padding-left: 10%;
    }

    .video-inro {
        position: absolute;
        z-index: 100;
        padding-left: 10%;
    }

    @media only screen and (max-width: 330px) {
        .center-div {
            margin: auto;
            padding-right: 5%;
            padding-left: 5%;
        }

        .sm-center-view {
            text-align: center !important;
        }
    }



    @media only screen and (max-width: 420px) {
        .center-div {
            margin: auto;
            padding-right: 5%;
            padding-left: 5%;
        }

        .sm-text-center {
            text-align: center !important;
        }

        .sm-pt-5 {
            margin-top: 20px;
        }
    }




    @media only screen and (min-width: 280px) and (max-width: 320px) {

        .banner-section .content-box h1 {
            font-size: 1.4rem;
            line-height: 2.4rem;
            font-weight: 600;
            margin-bottom: 6px;
        }

        .theme-btn {

            font-size: 11px;
            line-height: 17px;

        }

        .main-header.style-five {
            position: relative;
            background: #fff;
            padding-bottom: 0px;
        }

        .banner-section .content-box p {
            font-size: 14px;
            line-height: 20px;
            margin-bottom: 65px;
            color: #ffffff;
        }

        .faq-page-section .accordion-box .block .acc-btn h5 {
            position: relative;
            font-size: 14px;
            line-height: 26px;
            font-weight: 700;
            margin: 0px;
            cursor: pointer;
            box-shadow: 0 0px 40px 10px #eaeaef;
            padding: 20px 60px 18px 30px;
            transition: all 500ms ease;
        }
    }


    @media only screen and (min-width: 321px) and (max-width: 415px) {

        .banner-section .content-box h1 {
            font-size: 2rem;
            line-height: 2.3rem;
            font-weight: 600;
            margin-bottom: 15px;
        }

        .theme-btn {
            font-size: 11px;
            line-height: 17px;
        }


        .banner-section .content-box p {
            font-size: 19px;
            line-height: 27px;
            margin-bottom: 100px;
            color: #ffffff;
        }

        .faq-page-section .accordion-box .block .acc-btn h5 {

            font-size: 16px;
            line-height: 26px;
            font-weight: 700;
            margin: 0px;

        }

        .bg-size-contain-60 {
            background-size: 51% !important;
            padding: 100px 0px !important;
        }
    }

    @media only screen and (min-width: 740px) and (max-width: 1023px) {
        .background-video-container video {
            width: 320vw;
        }

        .menu-area .mobile-nav-toggler .icon-bar {
            background-color: #212529;
        }

        .banner-section {
            padding: 150px 0px 100px 0px;
        }
    }

    @media only screen and (width: 1024px) {
        .background-video-container video {
            width: 150vw;
        }

        .menu-area .mobile-nav-toggler .icon-bar {
            background-color: #212529;
        }

        .banner-section {
            padding: 150px 0px 100px 0px;
        }
    }



    .main-header img,
    .sticky-header img {
        height: 100% !important;
        max-width: auto !important;
        width: 125px;
    }



    @media only screen and (min-width:666px) and (max-width: 684px) {


        .menu-area .mobile-nav-toggler .icon-bar {
            background-color: #212529;
        }

        .banner-section .content-box h1 {
            font-size: 1.5rem;
            line-height: 1rem;
            font-weight: 600;
            margin-bottom: 10px;
        }

        .theme-btn {
            font-size: 13px;
            line-height: 20px;
        }


        .banner-section .content-box p {
            font-size: 13px;
            line-height: 15px;
            margin-bottom: 15px;
            color: #ffffff;
        }

        .banner-section {
            padding: 150px 0px 100px 0px;
        }

        .bg-size-contain-60 {
            background-size: 44% !important;
        }
    }


    @media only screen and (min-width:734px) and (max-width: 736px) {


        .menu-area .mobile-nav-toggler .icon-bar {
            background-color: #212529;
        }

        .banner-section .content-box h1 {
            font-size: 1.4rem;
            line-height: 1rem;
            font-weight: 600;
            margin-bottom: 10px;
        }

        .theme-btn {
            font-size: 13px;
            line-height: 20px;
        }


        .banner-section .content-box p {
            font-size: 15px;
            line-height: 17px;
            margin-bottom: 20px;
            color: #ffffff;
        }

        .banner-section {
            padding: 160px 0px 100px 0px;
        }

        .bg-size-contain-60 {
            background-size: 42% !important;
        }
    }

</style>
