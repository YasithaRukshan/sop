@extends('MemberArea.Layouts.app')
@section('title', 'Profile Management | SOP')
@section('header')
<div class="row  py-4">
    <div class="col-12">
        <div class="page-title-box d-flex align-items-center justify-content-between">
            <div class="col-lg-6 col-7">
                <h6 class="h2 text-dark d-inline-block mb-0">My Profile</h6>
                <nav aria-label="breadcrumb" class="d-none d-md-block mt-2">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="{{ route('dashboard') }}"><i class="bx bx-home"></i></a>
                        </li>
                        <li class="breadcrumb-item"><a href="">My Profile</a></li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
</div>
@endsection
@section('content')

<div class="row mt-4">

    <div class="col-xl-4">
        <div class="card card-profile">
            <img src="{{ asset('assets/images/pro-cover.png') }}" alt="Image placeholder" class="card-img-top">
            <div class="row justify-content-center">
                <div class="col-lg-3 order-lg-2 mb-5">
                    <div class="card-profile-image">
                        <a href="javascript:void(0)">
                            <img src="{{ Auth::user()->profileimage?Config::get('images.access_path').'crop/'.Auth::user()->profileimage->name:asset('assets/images/avatar.png') }}"
                                alt="Profile Image" class="rounded-circle">
                        </a>
                    </div>
                </div>
            </div>
            <div class="card-body ">
                <div class="d-flex justify-content-between ml-4 mb-3 mb-sm-0">
                    <button data-toggle="modal" data-target="#profile-model" class="btn btn-sm btn-info ">
                        <i class="fas fa-pencil-alt"></i> Image
                    </button>
                </div>
                <div class="text-center">
                    <h5 class="h5">
                        {{ Auth::user()->first_name }} {{ Auth::user()->last_name }}
                    </h5>
                    <h6 class="h6">
                        {{ Auth::user()->email }}
                    </h6>
                    <h6 class="h6">
                        User name: <strong>{{ Auth::user()->username }}</strong>
                    </h6>
                </div>
            </div>
        </div>

        <div class="nav-wrapper">
            <ul class="nav nav-pills nav-fill flex-column" id="tabs-icons-text" role="tablist">
                <li class="nav-item mb-2">
                    <a class="nav-link active" id="tabs-icons-text-1-tab" data-toggle="tab" href="#tabs-icons-text-1"
                        role="tab" aria-controls="tabs-icons-text-1" aria-selected="true">
                        Personal Information
                    </a>
                </li>
                {{-- <li class="nav-item mb-2">
                    <a class="nav-link " id="tabs-icons-text-2-tab" data-toggle="tab" href="#tabs-icons-text-2"
                        role="tab" aria-controls="tabs-icons-text-2" aria-selected="false">
                        BIlling Information
                    </a>
                </li> --}}
                <li class="nav-item mb-2">
                    <a class="nav-link " id="tabs-icons-text-3-tab" data-toggle="tab" href="#tabs-icons-text-3"
                        role="tab" aria-controls="tabs-icons-text-3" aria-selected="false">
                        Password
                    </a>
                </li>
            </ul>
        </div>
    </div>
    <div class="col-xl-8 order-xl-1 ">
        <div class="card shadow ">
            <div class="card-body ">
                <div class="tab-content" id="myTabContent">
                    @include('MemberArea.Pages.Profile.Components.check-password')
                    @include('MemberArea.Pages.Profile.Components.personal')
                    {{-- @include('MemberArea.Pages.Profile.Components.billing') --}}
                    @include('MemberArea.Pages.Profile.Components.password')
                </div>
            </div>
        </div>
    </div>
</div>

@include('MemberArea.Pages.Profile.Components.model')
@endsection
@section('js')
@include('MemberArea.Pages.Profile.Includes.js')
@endsection
@section('css')
@include('MemberArea.Pages.Profile.Includes.css')
@endsection
