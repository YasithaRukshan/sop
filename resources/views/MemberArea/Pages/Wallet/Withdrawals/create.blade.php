@extends('MemberArea.Layouts.app')
@section('title', 'Withdrawals | SOP')
@section('ogtitle', 'Withdrawals | SOP')
@if((float)config('payments.minimum_sopx') < $tc->getRedeemAvailableBalance(false))
    @section('header')
    <div class="row  py-4">
        <div class="col-12">
            <div class="page-title-box d-flex align-items-center justify-content-between">
                <div class="col-lg-6 col-7">
                    <h6 class="h2 text-dark d-inline-block mb-0">Redemption <small>[New]</small></h6>
                    <nav aria-label="breadcrumb" class="d-none d-md-block mt-2">
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item"><a href="{{ route('dashboard') }}"><i
                                        class="bx bx-home"></i></a>
                            </li>
                            <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Redemptions</a>
                            </li>
                            <li class="breadcrumb-item active" aria-current="page">New</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
    </div>
    @endsection
    @section('content')
    <form action="{{ route('wallet.withdrawals.store') }}" method="POST" enctype="multipart/form-data"
        id="submitRedemption">
        @csrf
        <div class="row">
            <div class="col-md-7 col-lg-6 col-xl-6">
                <livewire:wallet.redemption.calculate :withdrawalAmount="$withdrawalAmount" />
            </div>
            <div class="col-md-5 col-lg-6 col-xl-6">
                <div class="card">
                    <div class="card-body">
                        <div class="form-group text-center">
                            <h1 class="mb-0 h1">SOPX <strong>{{ $tc->getBalanceSOPX() }}</strong> </h1>
                            <h6 class="h6">Current Balance</h6>
                            <h5 class="mt-4 h5">
                                Current SOPX Value is
                                <strong>
                                    $ {{ $oilPrice-18 }}
                                </strong>
                                <small>
                                    (Based On
                                    WTI
                                    price
                                    <strong>
                                        $ {{ $oilPrice }}
                                    </strong>)
                                </small>.
                            </h5>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <div id="divHandelingFee">
                            <div class="row justify-content-center pt-4">
                                <div class="col-lg-2">
                                    <h6>Your Request</h6>
                                    <h6><span id="requestValue"></span><sup id="withOutFeeUsd"></sup></h6>
                                </div>
                                <div class="col-lg-1">
                                    <h6> <strong>-</strong> </h6>
                                </div>
                                <div class="col-lg-2 text-danger">
                                    <h6 class="text-danger">Handling Fee</h6>
                                    <h6 class="text-danger"><span id="handlingFee"></span><sup id="feeUsd"></sup></h6>
                                </div>
                                <div class="col-lg-1">
                                    <h6> <strong>=</strong> </h6>
                                </div>
                                <div class="col-lg-2 text-success">
                                    <h6 class="text-success">You Will Receive</h6>
                                    <h6 class="text-success"><span id="allfee"></span><sup id="withFeeUsd"></sup></h6>
                                </div>
                            </div>
                        </div>
                        <div class="form-check text-muted text-center mt-4">
                            <input class="form-check-input" type="checkbox" name="checkAgreeFee" id="checkAgreeFee">
                            <label class="form-check-label" for="defaultCheck1">
                                I understand the conversion request is final and irrevocable.
                            </label>
                            <br>
                            <label class="text-danger"><span id="checkboxMsg"></span></label>
                        </div>
                        <div class="text-center mt-4">
                            <span id="loader"></span>
                            <input type="hidden" name="redemptionType" id="redemptionType" value="convert">
                            <button type="submit" id="sub-btn" class="btn btn-primary">Submit For Approval </button>
                            <h6 class="mt-4">
                                <small>
                                    Your withdrawal request will send for admin's aproval and it will take
                                    maximum 48h
                                </small>
                            </h6>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>
    @endsection
    @section('js')
    @include('MemberArea.Pages.Wallet.Withdrawals.Includes.js')
    @endsection
    @else
    @section('content')
    <div class="row justify-content-center mt-5">
        <div class="col-lg-6">
            <div class="card mt-5" id="balance-div">
                <div class="card-body">
                    <div class="row">
                        <div class="col-12">
                            <h4 class="h5 text-center">
                                Available Amount : SOPX <strong
                                    class="text-primary">{{$tc->getRedeemAvailableBalance()}}</strong>
                            </h4>
                        </div>
                        <div class="col-12">
                            <h4 class="h5 text-center">
                                Minimun Amount For Redeem: SOPX <strong
                                    class="text-primary">{{number_format((float)config('payments.minimum_sopx'),4)}}</strong>
                            </h4>
                        </div>
                    </div>
                    <h6 class="h6 text-center text-danger mt-2">
                        Your amount not enough for redeem !
                    </h6>
                    <h6 class="text-center mt-3"> <a class="text-dark2" href="{{ route('dashboard') }}"> <i
                                class="fas fa-chevron-circle-left"></i> <strong>Back To Dashboard</strong></a> </h6>
                </div>
            </div>
        </div>
    </div>
    @endsection
    @endif
