@extends('PublicArea.Layouts.app')
@section('title', 'Contact Us | SOP')
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
            <div class="col-lg-2"></div>
            <div class="col-lg-8 col-md-12 col-sm-12 content-column">
                <div class="sec-title text-center mb-3">
                    <h2>Contact Us</h2>
                    <div class="decor topdecor">
                    </div>
                </div>
                <div id="">
                    <div class="content-box">
                        <form method="POST" action="{{ route('contact.store') }}" id="contactUsForm"
                            class="default-form auth-form ">
                            @csrf
                            <div class="sec-title  mb-4">
                                <h3 class="text-center mb-4">We'd love to hear from you</h3>
                                <h5 class="text-center">send us message and we will get back to you within 24 hours</h5>
                            </div>
                            <hr class="my-4">
                            <div class="row mb-4">
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label><i class="fas fa-user"></i>Your name</label>
                                        <input id="name" type="text" name="name" value="{{old('name')}}" autofocus
                                            autocomplete="name" placeholder="Enter your name here">
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label><i class="fas fa-phone"></i>Your phone number</label>
                                        <input id="phone_number" type="tel" name="phone_number"
                                            value="{{old('phone_number')}}" placeholder="Enter phone number">
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label><i class="fas fa-envelope"></i>Your Email</label>
                                <input id="inp_email" type="email" name="email" value="{{old('email')}}"
                                    placeholder="Enter email here">
                            </div>
                            <div class="form-group">
                                <label><i class="fas fa-mail-bulk"></i>Subject</label>
                                <input id="subject" type="text" name="subject" value="{{old('subject')}}"
                                    placeholder="Enter subject here">
                            </div>
                            <div class="form-group">
                                <label><i class="fas fa-envelope-open-text"></i>Your message</label>
                                <textarea name="message" id="message" cols="30" rows="10"
                                    placeholder="Enter your message here">{{old('message')}}</textarea>
                            </div>
                            <div class="form-group " style="margin-top: 50px">
                                @if ($errors->has('g-recaptcha-response'))
                                <span class="help-block text-danger">
                                    <strong>{{ $errors->first('g-recaptcha-response') }}</strong>
                                </span>
                                @endif
                                <button class="theme-btn style-one g-recaptcha" type="submit" name="submit-form"
                                    id="submit-btn" data-sitekey="{{config('services.google_recaptcha.site_key')}}"
                                    data-callback='onSubmit' data-action='submit' disabled>
                                    {{ __('Submit') }}
                                </button>
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
    #contact-form input:focus,
    #contact-form textarea:focus {
        border-color: #00032b !important;
    }

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
@include('PublicArea.Pages.ContactUs.Includes.js')
@endpush
