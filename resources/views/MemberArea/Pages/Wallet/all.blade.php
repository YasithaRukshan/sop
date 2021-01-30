@extends('MemberArea.Layouts.app')
@section('title', 'My Wallet | SOP')
@section('ogtitle', 'My Wallet | SOP')
@section('header')

<div class="row  py-4">
    <div class="col-12">
        <div class="page-title-box d-flex align-items-center justify-content-between">
            <div class="col-lg-6 col-7">
                <h6 class="h2 text-dark d-inline-block mb-0">My Wallet</h6>
                <nav aria-label="breadcrumb" class="d-none d-md-block mt-2">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="{{ route('dashboard') }}"><i class="bx bx-home"></i></a>
                        </li>
                        <li class="breadcrumb-item active" aria-current="page">My Wallet</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
</div>
@endsection
@section('content')
<div class="row">
    <div class="container-fluid">
        <div class="row">
            <div class="col-xl-6">
                <div class="card">
                    <div class="card-body border-top">
                        <div class="row">
                            <div class="col-8">
                                <div class="row">
                                    <div class="col-12">
                                        <h6 class="text-muted"> <small>Available Tokens</small> </h6>
                                        <h2>SOAX {{$tc->getBalanceSOAX()}}</h2>
                                    </div>
                                    <div class="col-12">

                                        <h6 class="text-muted"> <small>Options</small> </h6>
                                        <div class="row">
                                            <div class="col-4">
                                                @include('MemberArea.Pages.Wallet.Components.mainDeposit')
                                            </div>
                                        </div>
                                    </div>

                                </div>
                            </div>
                            <div class="col-4 align-self-end">
                                <img src="{{ asset('MemberArea/images/soax.png') }}" alt="" class="img-fluid">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-6">
                <div class="card">
                    <div class="card-body border-top">
                        <div class="row">
                            <div class="col-8">
                                <div class="row">
                                    <div class="col-12">
                                        <h6 class="text-muted"> <small>Available Tokens</small></h6>
                                        <h2>
                                            SOPX {{$tc->getBalanceSOPX()}}
                                            {{-- @if ($tc->getAwaitingSOPX()*1>0) --}}
                                            <sup style="font-size:50%;color: rgb(129, 128, 128);" data-toggle="tooltip"
                                                data-placement="top" title="Approval Awaiting Amount (Min=0.25 SOPX)">
                                                [
                                                {{$tc->getAwaitingSOPX()}}
                                                <div class="spinner-border spinner-border-xsm" role="status"></div>
                                                ]
                                            </sup>
                                            {{-- @endif --}}
                                        </h2>
                                    </div>
                                    <div class="col-12">

                                        <h6 class="text-muted"> <small>Options</small> </h6>
                                        <div class="row">
                                            <div class="col-4">

                                                @include('MemberArea.Pages.Wallet.Components.mainWithdraw')
                                            </div>
                                        </div>
                                    </div>

                                </div>
                            </div>
                            <div class="col-4 align-self-end">
                                <img src="{{ asset('MemberArea/images/sopx.png') }}" alt="" class="img-fluid"
                                    id="sopx-img">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-12">
                <div class="row">
                    <div class="col-sm-6">
                        <div class="card mini-stats-wid">
                            <div class="card-body">
                                <div class="media">
                                    <div class="mr-3 align-self-center">
                                        <i class="mdi mdi-cash-remove h2 text-danger mb-0"></i>
                                    </div>
                                    <div class="media-body">
                                        <p class="text-muted mb-2">Total Staked SOAX</p>
                                        <h5 class="mb-0">SOAX {{$tc->getBalanceTotalStaked()}}</h5>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="card mini-stats-wid">
                            <div class="card-body">
                                <div class="media">
                                    <div class="mr-3 align-self-center">
                                        <i class="fas fa-arrow-down h2 text-primary mb-0"></i>
                                    </div>
                                    <div class="media-body">
                                        <p class="text-muted mb-2">Redemption SOPX</p>
                                        <h5 class="mb-0">SOAX {{$tc->getRedemptionSOPX()}}</h5>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    {{-- <div class="col-sm-4">
                        <div class="card mini-stats-wid">
                            <div class="card-body">
                                <div class="media">
                                    <div class="mr-3 align-self-center">
                                        <i class="bx bx-wallet h2 text-success mb-0"></i>
                                        <img class="img-fluid" width="30"
                                            src="{{ asset('MemberArea/images/sopx.png') }}" alt="">
                </div>
                <div class="media-body">
                    <p class="text-muted mb-2">Withdrew Amount</p>
                    <h5 class="mb-0">SOAX {{$tc->getBalanceWithdrew()}}</h5>
                </div>
            </div>
        </div>
    </div>
</div> --}}
</div>
<!-- end row -->
<div class="card">
    <div class="card-body">
        <div class="row">
            <div class="col-lg-12">
                <div class="row">
                    <div class="col-lg-5">
                        <h4 class="card-title mb-3" style="margin-top: 15px;">Transaction Overview</h4>
                    </div>
                    <div class="col-lg-5">
                    </div>
                </div>
            </div>
        </div>
        <div>
            <div id="chartdiv2" class="chartdiv">
            </div>
        </div>
    </div>
</div>
</div>
</div>
<!-- end row -->
</div>
</div>

@include('MemberArea.Pages.Wallet.Includes.modal')

@endsection
@section('css')
<style>
    .chartdiv {
        width: 100%;
        height: 300px;
    }

</style>

@endsection
@section('js')

<script src="{{asset('MemberArea/libs/amchart/core.js')}}"></script>
<script src="{{asset('MemberArea/libs/amchart/charts.js')}}"></script>
<script src="{{asset('MemberArea/libs/amchart/animated.js')}}"></script>
<script></script>
@include('MemberArea.Pages.Wallet.Includes.js')
@endsection
