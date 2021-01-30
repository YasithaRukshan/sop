@extends('PublicArea.Layouts.app')
@section('title', 'Reset Password | SOP')
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
            <div class="col-lg-6 col-md-12 col-sm-12 content-column" style="margin-top: 10vh">
                <div class="sec-title text-center mb-3">
                    <h2>Reset Password</h2>
                    <div class="decor topdecor">
                    </div>
                </div>
                <div id="content_block_09">
                    <div class="content-box">
                        @if (session('status'))
                        <div class="alert alert-success">
                            {{ session('status') }}
                        </div>
                        @endif
                        <form method="POST" action="{{ route('password.update') }}" id="reset-form"
                            class="default-form  auth-form ">
                            @csrf

                            <input type="hidden" name="token" value="{{ $request->route('token') }}">

                            <div class="form-group">
                                <label><i class="far fa-envelope"></i>Your Email</label>
                                <input id="email" type="email" name="email" value="{{old('email', $request->email)}}"
                                    placeholder="Enter email here" readonly>
                                @if ($errors->has('email'))
                                <span class="help-block text-danger">
                                    <strong>{{ $errors->first('email') }}</strong>
                                </span>
                                @endif
                            </div>
                            <div class="form-group">
                                <label><i class="fa fa-key"></i>Password</label>
                                <input id="password" type="password" name="password" autofocus
                                    autocomplete="new-password" placeholder="Password">
                                @if ($errors->has('password'))
                                <span class="help-block text-danger">
                                    <strong>{{ $errors->first('password') }}</strong>
                                </span>
                                @endif
                            </div>
                            <div class="form-group">
                                <label><i class="fa fa-key"></i>Confirmation Password</label>
                                <input id="password_confirmation" type="password" name="password_confirmation"
                                    autocomplete="new-password" placeholder="Password confirmation">
                                @if ($errors->has('password_confirmation'))
                                <span class="help-block text-danger">
                                    <strong>{{ $errors->first('password_confirmation') }}</strong>
                                </span>
                                @endif
                            </div>
                            <div class="form-group mt-20">
                                <button class="theme-btn style-one" type="submit" name="submit-form">
                                    {{ __('Reset Password') }}</button>
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
