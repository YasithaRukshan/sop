<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- App favicon -->
    <title>@yield('title','SOP')</title>
    <meta name="description" content="@yield('description','SOP')" />

    <meta property="og:title" content="@yield('ogtitle','SOP')" />
    <meta property="og:url" content="{{Request::url()}}" />

    <meta property="og:type" content="@yield('ogtype','website')" />

    <meta property="og:image" content="@yield('ogimage',asset('MemberArea/images/logo.png') )" />
    <meta property="og:image:secure_url" content="@yield('ogimage', asset('MemberArea/images/logo.png') )" />
    <meta property="og:image:width" content="@yield('ogimagewidth',500)" />
    <meta property="og:image:height" content="@yield('ogimageheight',200)" />
    <link rel="shortcut icon" href="{{asset('MemberArea/images/favicon.ico')}}">

    <meta name="csrf-token" content="{{ csrf_token() }}" />
    @include('MemberArea.Includes.css')

    @php
    $curr_url = Route::currentRouteName();
    @endphp

</head>

<body data-sidebar="dark">
    <!-- Preload -->
    @include('MemberArea.Includes.preload')
    <!-- Begin page -->
    <div id="layout-wrapper">
        @include('MemberArea.Includes.nav')
        <!-- ========== Left Sidebar Start ========== -->
        <div class="vertical-menu">
            <div data-simplebar class="h-100">
                <!--- Sidemenu -->
                @include('MemberArea.Includes.sidebar')
                <!-- Sidebar -->
            </div>
        </div>
        <!-- Left Sidebar End -->
        <div class="main-content">
            <div class="page-content">
                {{-- @include('MemberArea.Includes.ticker') --}}
                <livewire:ticker />

                <div class="container-fluid">

                    <!-- start page title -->
                    @yield('header')
                    <!-- end page title -->

                    <!-- start page content -->
                    @yield('content')
                    <!-- end page content -->
                </div>

                <!-- Modal -->
                @include('MemberArea.Includes.modal')
                <!-- end modal -->
            </div>
            <!-- End Page-content -->

            @include('MemberArea.Includes.footer')

        </div>
        <!-- end main content-->
    </div>
    <!-- END layout-wrapper -->

    @include('MemberArea.Includes.js')
</body>

</html>
