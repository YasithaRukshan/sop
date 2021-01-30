@extends('PublicArea.Layouts.app')
@section('title', 'Register | SOP')
@section('content')


<!--Page Title-->
<section class="page-title text-center style-two">
    <div class="pattern-layer auth-header"></div>
</section>
<!--End Page Title-->

<!-- contact-section -->
<section class="contact-section alternate-2 " style="margin-top: 5vh">
    <div class="pattern-layer auth-form-area"></div>
    <div class="auto-container">
        <div class="row clearfix">
            <div class="col-lg-3"></div>
            <div class="col-lg-6 col-md-12 col-sm-12 content-column">
                <div class="sec-title text-center mb-3">
                    <h2>Register</h2>
                    <div class="decor topdecor">
                    </div>
                </div>
                <div id="content_block_09">
                    <div class="content-box">
                        <form method="POST" action="{{ route('register') }}" id="register-form"
                            class="default-form auth-form pt-4">
                            @csrf
                            <div class="row mb-4">
                                <div class="col-lg-12">
                                    <h5 class="text-center text-danger">Referred By: <strong class="refId"></strong>
                                    </h5>
                                </div>
                            </div>
                            <div class="row mb-4">
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label><i class="far fa-user"></i>First Name</label>
                                        <input id="inp_first_name" type="text" name="first_name"
                                            value="{{old('first_name')}}" autofocus autocomplete="name"
                                            placeholder="Enter first name here">
                                        <span class="help-block ">
                                            <strong class="text-danger" id="inp_first_name_msg"></strong>
                                        </span>
                                        @if ($errors->has('first_name'))
                                        <span class="help-block text-danger">
                                            <strong>{{ $errors->first('first_name') }}</strong>
                                        </span>
                                        @endif
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label><i class="far fa-user"></i>Last Name</label>
                                        <input id="inp_last_name" type="text" name="last_name"
                                            value="{{old('last_name')}}" autofocus placeholder="Enter last name here">
                                        <span class="help-block ">
                                            <strong class="text-danger" id="inp_last_name_msg"></strong>
                                        </span>
                                        @if ($errors->has('last_name'))
                                        <span class="help-block text-danger">
                                            <strong>{{ $errors->first('last_name') }}</strong>
                                        </span>
                                        @endif
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label><i class="far fa-id-card"></i>Your Username</label>
                                <input id="username" type="text" name="username" value="{{old('username')}}" autofocus
                                    placeholder="Enter username here">
                                @if ($errors->has('username'))
                                <span class="help-block text-danger">
                                    <strong>{{ $errors->first('username') }}</strong>
                                </span>
                                @endif
                            </div>
                            <div class="form-group">
                                <label><i class="far fa-envelope"></i>Your Email</label>
                                <input id="email" type="email" name="email" value="{{old('email')}}" autofocus
                                    autocomplete="username" placeholder="Enter email here">
                                <span class="help-block ">
                                    <strong class="text-danger" id="email_msg"></strong>
                                </span>
                                @if ($errors->has('email'))
                                <span class="help-block text-danger">
                                    <strong>{{ $errors->first('email') }}</strong>
                                </span>
                                @endif
                            </div>
                            <div class="form-group">
                                <label>Password
                                    &nbsp;&nbsp;
                                    <i id="eye" onclick="showPassword()" class="far fa-eye"></i></label>
                                <input id="password" type="password" name="password" autocomplete="new-password"
                                    placeholder="Enter password here">
                                <span class="help-block ">
                                    <strong class="text-danger" id="password_msg"></strong>
                                </span>
                                @if ($errors->has('password'))
                                <span class="help-block text-danger">
                                    <strong>{{ $errors->first('password') }}</strong>
                                </span>
                                @endif
                            </div>
                            <div class="form-group">
                                <label>Confirmation Password</label>
                                <input id="password_confirmation" type="password" name="password_confirmation"
                                    autocomplete="new-password" placeholder="Enter password confirmation here">
                                <span class="help-block ">
                                    <strong class="text-danger" id="password_confirmation_msg"></strong>
                                </span>
                                @if ($errors->has('password_confirmation'))
                                <span class="help-block text-danger">
                                    <strong>{{ $errors->first('password_confirmation') }}</strong>
                                </span>
                                @endif
                            </div>
                            {{-- <div class="form-group">
                                <label>Enter Superuser Code</label>
                                <input id="superuser_code" type="text" name="superuser_code"
                                    placeholder="Enter Superuser Code">
                            </div> --}}
                            <div class="form-group row checkbox">
                                <input id="agreePolicy" type="checkbox" class="form-checkbox" name="agreePolicy">
                                <label class="termpolicy">I agree to the <a
                                        href="{{ route('terms-and-conditions') }}">TOS</a> and <a
                                        href="{{ route('privacy-policy') }}">Privacy Policy</a>.</label>
                            </div>
                            <div class="form-group" style="margin-top: -25px !important;">
                                <label class=" text-danger">
                                    <strong id="policyMsg"> </strong>
                                </label>
                            </div>
                            <div class="form-group" style="margin-top: -25px !important;">
                                <label class=" text-danger">
                                    <strong id="refMsg"> </strong>
                                </label>
                            </div>
                            <div class="form-group mt-20">
                                @if ($errors->has('g-recaptcha-response'))
                                <span class="help-block text-danger">
                                    <strong>{{ $errors->first('g-recaptcha-response') }}</strong>
                                </span>
                                @endif
                                <button class="theme-btn style-one g-recaptcha" type="submit" name="submit-form"
                                    id="submit-btn" data-sitekey="{{config('services.google_recaptcha.site_key')}}"
                                    data-callback='onSubmit' data-action='submit' disabled>
                                    {{ __('Register') }}
                                </button>
                            </div>
                            <div class="form-group row checkbox">
                                <label class="termpolicy"><span class="globalText"></span></label>
                            </div>
                            <div>
                                <p>Already have an account ?
                                    <a href="{{route('login')}}" class="font-weight-medium text-primary"> Login </a>
                                </p>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
@section('css')
@include('auth.Includes.css')
<style>
    .scroll-top {
        top: 85vh;
        border: 1px solid #4b4f5b;

    }

    @media only screen and (max-width: 599px) {
        .scroll-top {
            top: 80vh;
        }
    }

</style>
@endsection
@push('js')
@include('auth.Includes.js')
<script>
    $(document).ready(function () {
        setReferral();
    });

    function setReferral() {
        username = getCookie('rfusername');
        $.ajax({
            url: "{{ route('customer.name') }}",
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            data: {
                username: username
            },
            async: false,
            success: function (response) {
                $(".globalText").html(response.text);
                $(".refId").html(response.username);
            }
        });
    }

</script>
@endpush
