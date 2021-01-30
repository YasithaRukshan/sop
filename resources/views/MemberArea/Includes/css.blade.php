@livewireStyles
<!-- Bootstrap Css -->
<link id="bootstrap-style" rel="stylesheet" type="text/css" href="{{ asset('MemberArea/css/bootstrap.min.css') }}">
<!-- Icons Css -->
<link rel="stylesheet" type="text/css" href="{{ asset('MemberArea/css/icons.min.css') }}">
<!-- App Css-->
<link id="app-style" rel="stylesheet" type="text/css" href="{{ asset('MemberArea/css/app.min.css') }}">
<!-- Datatables Css-->
<link rel="stylesheet" href="https://cdn.datatables.net/1.10.21/css/dataTables.bootstrap4.min.css">
<!-- Boxicons Css-->
<link href='https://unpkg.com/boxicons@2.0.5/css/boxicons.min.css' rel='stylesheet'>
<!-- sptoast Css-->
<link rel="stylesheet" href="{{ asset('MemberArea/css/sptoast.css') }}">
<!-- select2 CSS-->
<link href="https://cdn.jsdelivr.net/npm/select2@4.0.12/dist/css/select2.min.css" rel="stylesheet" />
<link rel="stylesheet"
    href="https://cdnjs.cloudflare.com/ajax/libs/select2-bootstrap-theme/0.1.0-beta.10/select2-bootstrap.min.css">
<!-- confirm CSS -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery-confirm/3.3.2/jquery-confirm.min.css">
<!-- cropper CSS-->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/cropper/4.0.0/cropper.min.css">
<!-- Responsive datatable examples -->
<link href="{{asset('MemberArea/libs/datatables.net-responsive-bs4/css/responsive.bootstrap4.min.css')}}"
    rel="stylesheet" type="text/css" />
<link href="{{asset('MemberArea/libs/datatables.net-bs4/css/dataTables.bootstrap4.min.css')}}" rel="stylesheet"
    type="text/css" />
<link href="{{asset('css/member.css')}}" type="text/css" />
<style>
    .page-content {
        padding: calc(50px + 24px) calc(24px / 2) 60px calc(24px / 2);
    }

    body[data-sidebar=dark] .vertical-menu {
        background: #1f2a4a;
    }

    body[data-sidebar=dark] .navbar-brand-box {
        background: #1f2a4a;
    }

    #webTicker li {
        font-size: 0.8rem;
        font-weight: 500;
    }

    #webTicker li span {
        color: #3736b0;
    }

    .spinner-border-xsm {
        width: 0.5rem;
        height: 0.5rem;
        border-width: 0.1em;
        margin-bottom: 6px;
    }

    .soax-amount-nav {
        height: 23px;
        margin-top: 1.5rem;
        margin-right: 5rem;
        color: #5c6377;
    }

    .text-soax {
        color: #0c2398;
        font-weight: 700;
    }


    .text-eth {
        color: #750b82;
        font-weight: 700;
    }


    .text-trx {
        color: #6a0bbf;
        font-weight: 700;
    }


    .line-text {
        position: relative;
        z-index: 1;
        overflow: hidden;
        text-align: center;
        font-family: 'Nunito', sans-serif;
        font-weight: 700;
        letter-spacing: 2px;

    }

    .line-text:before,
    .line-text:after {
        position: absolute;
        top: 51%;
        overflow: hidden;
        width: 50%;
        height: 1px;
        content: '\a0';
        background-color: #cacacaed;
    }

    .line-text:before {
        margin-left: -50%;
        text-align: right;
    }

    .btn-neutral {
        color: #2b2c5ab0;
        border-color: #fff;
        background-color: #fff;
        box-shadow: 0 4px 6px rgba(50, 50, 93, .11), 0 1px 3px rgba(0, 0, 0, .08);
    }

    .select2-container--default .select2-selection--single {
        background-color: #fff;
        border-radius: 4px;
        height: calc(1.5em + .94rem + 2px);
        border: 1px solid #ced4da;
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
        border: 1px solid #ced4da;
        font-size: .8125rem;
        height: calc(1.5em + .94rem + 2px);
        line-height: 1.875rem;
    }

    .select2-container--default .select2-selection--multiple {
        background-color: #fff;
        border-radius: 4px;
        border: 1px solid #ced4da;
        transition: box-shadow .15s ease;
        line-height: 1.5rem;
        font-size: .8125rem;
    }

    .select2-container--default .select2-selection--multiple .select2-selection__arrow b {
        margin-top: 6px;
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

    /* Data table css */
    .dataTables_length {
        padding-left: 1.5rem;
    }

    .dataTables_filter {
        padding-right: 1.5rem;

    }

    .dataTables_info {
        padding-left: 1.5rem;
    }

    .dataTables_wrapper .dataTables_paginate {
        padding-right: 1.5rem;
    }

    @media only screen and (max-width: 599px) {
        .soax-amount-nav {
            height: 20px;
            margin-top: 1rem;
            margin-right: 3rem;
        }
    }

    .d-mobi-block {
        display: none;
    }

    @media only screen and (max-width: 540px) {
        .d-mobi-block {
            display: block;
        }
    }

    .dropdown-menu {
        box-shadow: 10px 10px 5px #8b8989;
    }

    .nav-img-logo {
        display: inline !important;
        vertical-align: middle !important;
        max-width: 64%;
    }

    .uvbb {
        filter: blur(20px);
        pointer-events: none;
        position: relative;
        pointer-events: none;
    }

    .uvbb_ovl {
        position: absolute;
        /* display: none; */
        /* width: 100%; */
        /* height: 100%; */
        top: 400px;
        width: 80%;
        /* left: 0; */
        /* right: 0; */
        /* bottom: 0; */
        /* background-color: rgba(0, 0, 0, 0.5); */
        z-index: 2;
        height: 200px;
        cursor: pointer;
        pointer-events: auto;
    }


    @media only screen and (width: 768px) {
        /* .minilogo {
            width: 80px;
        } */

        .profile-pic {
            /* width: 70px; */
        }
    }

    @media only screen and (max-width: 414px) {

        /* .minilogo {
            width: 110px;
        } */
        #page-header-notifications-dropdown {
            padding-right: 45px;
        }

        .navbar-brand-box {
            padding: 0px;
        }

    }

    .mh-100 {
        min-height: 100px;
    }

    .posRel {
        position: relative;
    }

    .epeval {
        font-size: 0.9rem;
    }

    .epuval {
        font-size: 0.8rem;
    }

    @media screen and (max-width: 767px) {

        div.dataTables_wrapper div.dataTables_length,
        div.dataTables_wrapper div.dataTables_filter,
        div.dataTables_wrapper div.dataTables_info {
            text-align: center;
        }

        .dataTables_length {
            padding-left: 0.5rem;
        }

        div.dataTables_wrapper div.dataTables_filter input {
            width: 80%;
        }

        div.dataTables_paginate {
            padding-left: 150px;
        }
    }

</style>
@yield('css')
@stack('css')
