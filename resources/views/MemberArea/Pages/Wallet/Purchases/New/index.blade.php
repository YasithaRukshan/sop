@extends('MemberArea.Layouts.other')
@section('title', 'Buy SOAX | Wallet | SOP')
@section('content')
<div class="row justify-content-center">
    <div class="col-lg-6" id="errorMsg">
    </div>
</div>
<div class="row justify-content-center">
    <div class="col-md-5 col-lg-6 col-xl-6">
    <div class="row">
                    <div class="col-lg-12 text-center">
                           <label for="">For best experience, please use FireFox browser</label>
                    </div>
                </div>
        <div class="card overflow-hidden">
            <div class="card-body p-0">
                <div class="row">
                    <div class="col-lg-6 bg-light p-4">
                        <div class="row h-100">
                            <div class="col-lg-12 align-self-start">
                                <h3 class="text-
                                h3 mt-4">Buy <strong>SOAX</strong> Tokens</h3>
                                <hr>
                            </div>
                            <div class="col-lg-12 align-self-middle">
                                <div class="form-group text-center">
                                    <label for="">Enter SOAX Amount Here</label>
                                    <input type="number" class="form-control soax-input" name="soax_amount"
                                        id="inp_soax_amount" aria-describedby="helpId" value=""
                                        placeholder="Enter Here.." autofocus min="{{ config("payments.minimum_soax") }}"
                                        step="1" onKeyup="validateInput()">
                                    <div id="inp_soax_amount_resp" class="invalid-feedback"></div>
                                </div>

                                <h5 class="text-center h5 text-danger" style="margin-top:0px;">
                                    Min: <strong>SOAX {{ config('payments.minimum_soax') }}</strong>
                                </h5>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6 p-4">
                        <div class="row mt-2" id="payment-buttons">
                            <div class="col-lg-12">
                                <h6 class="text-center line-text mt-2 mb-2">Continue With</h6>
                            </div>
                            <div class="col-lg-12">
                                <a href="javascript:void(0)" onclick="submitPayment({{ $tc->WTTYPE('ETH') }})"
                                    data-toggle="tooltip" data-placement="top" title="We Accept Metamask Only"
                                    class="btn btn-outline-warning w-100">
                                    <div class="row">
                                        <div class="col-lg-3 col-3">
                                            <img style="width:100%"
                                                src="{{ asset('MemberArea/images/coin/ethLogo.jpg') }}" class="" alt="">
                                        </div>
                                        <div class="col-lg-9 col-9">
                                            <h5 class="text-left text-muted"><strong>Ethereum (ETH)</strong></h5>
                                            <h6 class="text-left mt-2"><strong id="ethamount"></strong></h6>
                                        </div>
                                    </div>
                                </a>
                            </div>
                            <div class="col-lg-12 mt-2">
                                <a href="javascript:void(0)" onclick="submitPayment({{ $tc->WTTYPE('BTC') }})"
                                    class="btn btn-outline-warning w-100">
                                    <div class="row">
                                        <div class="col-lg-3 col-3">
                                            <img style="width:100%"
                                                src="{{ asset('MemberArea/images/coin/btcLogo.jpg') }}" class="" alt="">
                                        </div>
                                        <div class="col-lg-9 col-9">
                                            <h5 class="text-left text-muted"><strong>Bitcoin (BTC)</strong></h5>
                                            <h6 class="text-left mt-2"><strong id="btcamount"></strong></h6>
                                        </div>
                                    </div>
                                </a>
                            </div>
                            <div class="col-lg-12 mt-2">
                                <a href="javascript:void(0)" onclick="submitPayment({{ $tc->WTTYPE('CAPP') }})"
                                    class="btn btn-outline-warning w-100">
                                    <div class="row">
                                        <div class="col-lg-3 col-3">
                                            <img style="width:100%"
                                                src="{{ asset('MemberArea/images/coin/cashAppLogo.png') }}" class=""
                                                alt="">
                                        </div>
                                        <div class="col-lg-9 col-9">
                                            <h5 class="text-left text-muted"><strong>Cash App (USD)</strong></h5>
                                            <h6 class="text-left mt-2"><strong class="cappamount"></strong></h6>
                                        </div>
                                    </div>
                                </a>
                            </div>
                            <div class="col-lg-12 mt-2">
                                <a href="javascript:void(0)" onclick="submitPayment({{ $tc->WTTYPE('ZELLE') }})"
                                    class="btn btn-outline-warning w-100">
                                    <div class="row">
                                        <div class="col-lg-3 col-3">
                                            <img style="width:100%"
                                                src="{{ asset('MemberArea/images/coin/zelleLogo.jpg') }}" class=""
                                                alt="">
                                        </div>
                                        <div class="col-lg-9 col-9">
                                            <h5 class="text-left text-muted"><strong>Zelle (USD)</strong></h5>
                                            <h6 class="text-left mt-2"><strong class="zelloamount"></strong></h6>
                                        </div>
                                    </div>
                                </a>
                            </div>

                        </div>
                        <div id="payment-loader">
                            <div class="d-flex justify-content-center">
                                <div class="spinner-border text-info" role="status">
                                    <span class="sr-only">Loading...</span>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-12 mt-3">
                                    <h6 class="text-center">Please Wait...</h6>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="row">

</div>
<div class="row justify-content-center">
    <div class="col-lg-6">
        <h6 class="text-center"> <a class="text-dark2" href="{{ route('dashboard') }}"> <i
                    class="fas fa-chevron-left"></i> <strong>Back To Dashboard</strong></a> </h6>
    </div>
</div>
@include('MemberArea.Pages.Wallet.Purchases.New.Modals.CashApp')
@include('MemberArea.Pages.Wallet.Purchases.New.Modals.Zelle')
@endsection
@section('css')
@include('MemberArea.Pages.Wallet.Purchases.New.Includes.css')
<style>
    .btn-payment:hover {
        color: #000;
        background-color: #f4d59c;
        border-color: transparent;
    }

    .grayscale-100 {
        filter: grayscale(100%);
    }

</style>
@endsection
@section('js')
@include('MemberArea.Pages.Wallet.Purchases.New.Includes.js')
@include('MemberArea.Pages.Wallet.Purchases.New.Includes.ethTransactions')
@include('MemberArea.Pages.Wallet.Purchases.New.Includes.btcTransactions')
@include('MemberArea.Pages.Wallet.Purchases.New.Includes.CappTransaction')
@include('MemberArea.Pages.Wallet.Purchases.New.Includes.zelleTransaction')
@endsection
