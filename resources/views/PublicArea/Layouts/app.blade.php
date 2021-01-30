<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0">
    <!-- App favicon -->
    <title>@yield('title','SOP')</title>
    <meta name="description" content="@yield('description','SOP')" />

    <meta property="og:title" content="@yield('ogtitle','SOP')" />
    <meta property="og:url" content="{{Request::url()}}" />

    <meta property="og:type" content="@yield('ogtype','website')" />

    <meta property="og:image" content="@yield('ogimage',asset('assets/images/wall1.png') )" />
    <meta property="og:image:secure_url" content="@yield('ogimage', asset('assets/images/wall1.png') )" />
    <meta property="og:image:width" content="@yield('ogimagewidth',500)" />
    <meta property="og:image:height" content="@yield('ogimageheight',200)" />

    <!-- Fav Icon -->
    <link rel="shortcut icon" href="{{asset('PublicArea/images/favicon.ico')}}">

    <meta name="csrf-token" content="{{ csrf_token() }}" />

    <!-- CSS  -->
    @include('PublicArea.Includes.css')

    @php
    $curr_url = Route::currentRouteName();
    @endphp


</head>


<!-- page wrapper -->

<body class="boxed_wrapper">

    <section id="undermaintaines">
        <div class="row">
            <div class="col-lg-12">
                <h6 class="text-center">
                    
                </h6>
            </div>
        </div>
    </section>
    <!-- preloader -->
    @include('PublicArea.Includes.preloader')
    <!-- preloader end -->


    <!-- search-popup -->
    @include('PublicArea.Includes.modal')
    <!-- search-popup end -->


    <!--  Menu  -->
    @include('PublicArea.Includes.nav')
    <!-- End  Menu -->
    @yield('content')
    <!-- main-footer  -->
    @include('PublicArea.Includes.footer')
    <!-- main-footer end -->
    @include('PublicArea.Includes.js')

</body><!-- End of .page_wrapper -->

</html>
