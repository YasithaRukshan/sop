@extends('PublicArea.Layouts.app')
@section('title', 'Login | SOP')
@section('content')


<!--Page Title-->
<section class="page-title text-center style-two">
    <div class="pattern-layer auth-header" ></div>
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
                    <h2>Login</h2>
                    <div class="decor topdecor">
                    </div>
                </div>
                <div id="content_block_09">
                    <div class="content-box">
                        <form method="POST" action="{{ route('login') }}" id="login-form"
                            class="default-form auth-form ">
                            @csrf
                            <div class="form-group">
                                <label><i class="far fa-envelope"></i>Your Email</label>
                                <input id="email" type="text" name="email" value="{{old('email')}}" required autofocus
                                    placeholder="Enter email here">
                                @if ($errors->has('email'))
                                <span class="help-block text-danger">
                                    <strong>{{ $errors->first('email') }}</strong>
                                </span>
                                @endif
                            </div>
                            <div class="form-group">
                                <label><i class="fa fa-key"></i>Password</label>
                                <input id="password" type="password" name="password" required
                                    autocomplete="current-password" placeholder="Email password">
                                @if ($errors->has('password'))
                                <span class="help-block text-danger">
                                    <strong>{{ $errors->first('password') }}</strong>
                                </span>
                                @endif
                            </div>
                            <div class="form-check ">
                                <input id="remember_me" type="checkbox" class="form-checkbox" name="remember">
                                <label class="form-check-label" for="exampleCheck1">Remember me</label>
                            </div>
                            <div class="form-group mt-20">
                                <button class="theme-btn style-one" type="submit" name="submit-form">
                                    {{ __('Login') }}</button>
                            </div>
                            <div class="mt-4 mb-4 text-center">
                                <a href="{{ route('password.request') }}" class="text-muted"><i class="fa fa-lock"></i>
                                    Forgot your password?</a>
                            </div>
                            <div>
                                <p>Don't have an account ? <a href="{{route('register')}}"
                                        class="font-weight-medium text-primary">
                                        Signup now </a> </p>
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
@endsection
@push('js')
@include('auth.Includes.js')
@endpush
