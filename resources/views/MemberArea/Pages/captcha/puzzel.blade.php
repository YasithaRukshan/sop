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
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css"
        integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
    <link rel="stylesheet" href="{{ asset('MemberArea/css/puzzel/slidercaptcha.min.css') }}" type="text/css">
    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" />
</head>

<body style="background-color:#ececec">
    <div class="container">
        <div class="row text-center mt-4 justify-content-center">
            <div class="col-lg-6">
                <div class="card shadow">
                    <div class="card-body">
                        <div class="row ">
                            <div class="col-md-12 mt-5">
                                <img src="{{asset('MemberArea/images/logo-mini.png')}}?{{ rand(1,9999) }}"
                                    style="height:70px !important" alt="">
                            </div>
                            <div class="col-md-12 mt-2 text-center">
                                <h3>Solar Oil Project</h3>
                                <hr>
                            </div>
                            <div class="col-md-12 mt-4 text-center">
                                <h6>Seems like you have not verified your email address still. You may choose one of the
                                    following options and verify your account</h6>
                                <br>
                                <a class="text-dark" href="{{ route('verification.resend') }}">Click
                                    <span class="text-primary">
                                        Here
                                    </span>
                                    To Resend
                                    Verification Link To <br> Registerd email
                                    <small>({{ Auth::user()->email }})</small>
                                </a>
                            </div>
                            <div class="col-lg-12 mt-4 mb-4">
                                <h6 class="text-cener"> <strong>OR</strong> </h6>
                            </div>
                            <div class="col-lg-12">
                                <h6>Verify By Solving Puzzle</h6>
                            </div>
                            <div class="col-lg-12 mb-4">
                                <div id="captcha"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="{{ asset('MemberArea/js/puzzel/longbow.slidercaptcha.min.js') }}"></script>
    <script src="https://code.jquery.com/jquery-3.5.1.min.js" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-ho+j7jyWK8fNQe+A12Hb8AhRq26LrZ/JpcUGGOn+Y7RsweNrtN/tE3MoK7ZeZDyx" crossorigin="anonymous">
    </script>
    <script>
        var captcha = sliderCaptcha({
            id: 'captcha',
            onSuccess: function () {
                verfication();
            },
            onFail: function () {
                location.reload();
            }
        });

        function verfication() {
            $.ajax({
                url: "{{ route('puzzle-email-verification') }}",
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                type: 'GET',
                success: function (response) {
                    if (response == 1) {
                        window.location.href = "{{ route('dashboard')}}";
                    } else {
                        location.reload();
                    }
                }
            });
        }

    </script>
</body>

</html>
