@extends('PublicArea.Layouts.app')
@section('title', 'Oil Well Owners | SOP')
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
                    <h2>Oil Well Owners</h2>
                    <div class="decor topdecor">
                    </div>
                </div>
                <div id="content_block_09">
                    <div class="content-box">
                        <form method="POST" action="{{ route('oilWell.owners.store') }}" id="owners-form"
                            class="default-form auth-form ">
                            @csrf
                            <div class="sec-title  mb-4">
                                <h3 class="text-center mb-4">Are you a low-volume/stripper well owner or operator in the
                                    US
                                    or Canada? We can help!</h3>
                                <h5 class="text-center">Enter your oil well information below and a member of our team
                                    will get back to you if we believe we can help you with installing new,
                                    hyper-efficient equipment!</h5>
                            </div>
                            <hr class="my-4">
                            <div class="sec-title  mb-4">
                                <p class="text-left text-danger">* If you are applying for multiple well sites, please
                                    submit the form
                                    for just ONE site.</p>
                            </div>
                            <div class="row mb-4">
                                <div class="form-group">
                                    <label><i class="far fa-id-card"></i>I am the</label>
                                    <div class="form-check form-check-inline pl-4">
                                        <input class="form-check-input" style="margin-top: -15px;" type="checkbox"
                                            name="status" id="inlineCheckbox1" value="1">
                                        <label class="form-check-label" for="inlineCheckbox1">Licensed operator of the
                                            site</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" style="margin-top: -15px;" type="checkbox"
                                            name="status2" id="inlineCheckbox2" value="2">
                                        <label class="form-check-label" for="inlineCheckbox2">Owner of the site</label>
                                    </div>
                                    <div class="row checkbox-warning">
                                        <span class="help-block">
                                            <strong class="error" id="warningMsg"></strong>
                                        </span>
                                    </div>
                                </div>
                            </div>
                            <div class="row mb-4">
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label><i class="far fa-user"></i>Your first name</label>
                                        <input id="inp_first_name" type="text" name="first_name"
                                            value="{{old('first_name')}}" autofocus autocomplete="first_name"
                                            placeholder="Enter your first name here">
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label><i class="far fa-user"></i>Your last name</label>
                                        <input id="inp_last_name" type="text" name="last_name" value="{{old('name')}}"
                                            autofocus autocomplete="last_name" placeholder="Enter your last name here">
                                        <span class="help-block ">
                                            <strong class="text-danger" id="inp_name_msg"></strong>
                                        </span>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label><i class="far fa-envelope"></i>Your Email</label>
                                <input id="inp_email" type="email" name="email" value="{{old('email')}}"
                                    placeholder="Enter email here">
                                <span class="help-block ">
                                    <strong class="text-danger" id="inp_email_msg"></strong>
                                </span>
                            </div>
                            <hr class="my-4">
                            <div class="row mb-4">
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label><i class="fas fa-city"></i>Site location (City)</label>
                                        <input id="inp_city" type="text" name="city" value="{{old('city')}}"
                                            placeholder="Enter city here">
                                        <span class="help-block ">
                                            <strong class="text-danger" id="inp_city_msg"></strong>
                                        </span>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label><i class="fa fa-arrows"></i>Site location (State)</label>
                                        <input id="inp_state" type="text" name="state" value="{{old('state')}}"
                                            placeholder="Enter state here">
                                        <span class="help-block ">
                                            <strong class="text-danger" id="inp_state_msg"></strong>
                                        </span>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label><i class="fas fa-sort-numeric-asc"></i>Total number of wells on
                                    site</label>
                                <input id="inp_wells_num" type="number" name="wells_num" value="{{old('wells_num')}}"
                                    placeholder="Enter number of wells here" min="1">
                                <span class="help-block ">
                                    <strong class="text-danger" id="inp_wells_num_msg"></strong>
                                </span>
                            </div>
                            <div class="row mb-4">
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label><i class="fas fa-anchor"></i>Average well Depth</label>
                                        <select class="select-single-depth" name="depth" id="inp_depth">
                                            <option></option>
                                            <option value="1">200-500 ft</option>
                                            <option value="2">500-1000 ft</option>
                                            <option value="3">1000-1500 ft</option>
                                            <option value="4">1500-2000 ft</option>
                                        </select>
                                        <span class="help-block error" id="inp_depth_msg">
                                        </span>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label><i class="far fa-calendar"></i>Active production Status</label>
                                        <select class="select-single-production" name="production" id="inp_production">
                                            <option></option>
                                            <option value="1">Active now</option>
                                            <option value="2">Within 12 months </option>
                                            <option value="3">More than a year ago</option>
                                        </select>
                                        <span class="help-block error" id="inp_production_msg">
                                        </span>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label><i class="fa fa-calendar-o"></i>Average BOPD across last 90 days of
                                    activity</label>
                                <input id="inp_avg_bopd" type="text" name="avg_bopd" value="{{old('avg_bopd')}}"
                                    placeholder="Enter average BOPD here">
                                <span class="help-block ">
                                    <strong class="text-danger" id="inp_avg_bopd_msg"></strong>
                                </span>
                            </div>
                            <div class="form-group">
                                <label><i class="fas fa-calendar-alt"></i>Average total BFPD (Total Balance Fual Produce
                                    Per Day) across last 90 days of
                                    activity</label>
                                <input id="inp_avg_tot_bopd" type="text" name="avg_tot_bopd"
                                    value="{{old('avg_tot_bopd')}}" placeholder="Enter average total BFPD here">
                                <span class="help-block ">
                                    <strong class="text-danger" id="inp_avg_tot_bopd_msg"></strong>
                                </span>
                            </div>
                            <div class="row">
                                <div class="onoffswitch" style="margin-left: 20px;">
                                    <input type="checkbox" name="pump_status" class="onoffswitch-checkbox" value="1"
                                        id="myonoffswitch" tabindex="0" checked>

                                    <label class="switch">
                                        <input type="checkbox">
                                        <span class="slider round"></span>
                                    </label>
                                </div>
                                <div class="form-group">
                                    <label class="lab-text">Have
                                        you worked with Pneumatic pumps before?</label>
                                </div>
                            </div>
                            <div class="form-group " style="margin-top: 50px">
                                <button class="theme-btn style-one" type="submit" name="submit-form">
                                    {{ __('Submit') }}</button>
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
@include('PublicArea.Pages.OilWellOwners.Includes.css')
@endsection
@push('js')
@include('auth.Includes.js')
@include('PublicArea.Pages.OilWellOwners.Includes.js')
@endpush
