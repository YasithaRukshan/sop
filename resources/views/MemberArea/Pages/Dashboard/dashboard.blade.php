@extends('MemberArea.Layouts.app')
@section('title', 'Dashboard | SOP')
@section('ogtitle', 'Dashboard | SOP')
@section('header')

<div class="row  py-4">
    <div class="col-12">
        <div class="page-title-box d-flex align-items-center justify-content-between">
            <div class="col-lg-6 col-7">
                <h6 class="h2 text-dark d-inline-block mb-0">Dashboard</h6>
                <nav aria-label="breadcrumb" class="d-none d-md-block mt-2">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="{{ route('dashboard') }}"><i class="bx bx-home"></i></a>
                        </li>
                        <li class="breadcrumb-item active" aria-current="page">Dashboard</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
</div>
@endsection
@section('content')
<div class="row">
    <div class="col-xl-4">
        <livewire:widgets.estimated-p-f-v />
    </div>
    <div class="col-xl-4">
        <div class="card">
            <div class="card-body border-top" style="position: relative;">
                <div class="row" style="height: 140px;">
                    <div class="col-8 h-100">
                        <div class="row h-100">
                            <div class="col-12">
                                <h5 class="text-muted h5"> Available Tokens </h5>
                                <h2 class="h2">SOAX {{$tc->getBalanceSOAX()}}</h2>
                            </div>
                            <div class="col-12 align-self-end">
                                @include('MemberArea.Pages.Wallet.Components.mainDeposit')
                            </div>
                        </div>
                    </div>
                    <div class="col-4">
                        <img src="{{ asset('MemberArea/images/soax.png') }}" alt="" class="img-fluid w-65">
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-xl-4">
        <div class="card">
            <div class="card-body border-top" style="position: relative;">
                <div class="row" style="height: 140px;">
                    <div class="col-8 h-100">
                        <div class="row h-100">
                            <div class="col-12">
                                <h5 class="text-muted h5"> Available Tokens</h5>
                                <h2 class="h2">
                                    SOPX {{$tc->getBalanceSOPX()}}
                                    <br>
                                    @if ($tc->getAwaitingSOPX(false)>0)
                                    <sup style="font-size:50%;color: rgb(129, 128, 128);" data-toggle="tooltip"
                                        data-placement="top" title="Approval Awaiting Amount (Min=0.25 SOPX)">
                                        [
                                        {{$tc->getAwaitingSOPX()}}
                                        <div class="spinner-border spinner-border-xsm" role="status"></div>
                                        ]
                                    </sup>
                                    @endif
                                </h2>
                            </div>
                            <div class="col-12 align-self-end">
                                @include('MemberArea.Pages.Wallet.Components.mainWithdraw')
                            </div>
                        </div>
                    </div>
                    <div class="col-4">
                        <img src="{{ asset('MemberArea/images/sopx.png') }}" alt="" class="img-fluid w-65"
                            id="sopx-img">
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="card">
    <div class="card-body">
        <div class="row">
            <div class="col-lg-12">
                <div class="row">
                    <div class="col-lg-5">
                        <h4 class="card-title mb-3" style="margin-top: 15px;">Production Overview</h4>
                    </div>
                    <div class="col-lg-5"></div>
                </div>
            </div>
        </div>
        <div>
            <div id="chartdiv2" class="chartdiv"></div>
        </div>
    </div>
</div>
<!-- end row -->
@endsection
@section('css')
<style>
    .chartdiv {
        width: 100%;
        height: 300px;
    }

    .w-65 {
        width: 55%;
    }

</style>

@endsection
@section('js')
<!-- apexcharts -->
<script src="{{asset('MemberArea/libs/amchart/core.js')}}"></script>
<script src="{{asset('MemberArea/libs/amchart/charts.js')}}"></script>
<script src="{{asset('MemberArea/libs/amchart/animated.js')}}"></script>
@include('MemberArea.Pages.Dashboard.Includes.js')
@endsection
