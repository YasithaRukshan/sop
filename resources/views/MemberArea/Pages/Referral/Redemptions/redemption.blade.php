@extends('MemberArea.Layouts.app')
@section('title', 'Share The Project | SOP')
@section('header')
<div class="row  py-4">
    <div class="col-12">
        <div class="page-title-box d-flex align-items-center justify-content-between">
            <div class="col-lg-12 col-7">
                <h6 class="h2 text-dark d-inline-block mb-0">Redeem Commissions</small></h6>
                <nav aria-label="breadcrumb" class="d-none d-md-block mt-2">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="{{ route('dashboard') }}"><i class="bx bx-home"></i></a>
                        </li>
                        <li class="breadcrumb-item"><a href="{{ route('referrals') }}">Share The
                                Project</a>
                        </li>
                        <li class="breadcrumb-item active" aria-current="page">Redeem</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
</div>
@endsection
@section('content')
@includeWhen($can_redeem?true:false, 'MemberArea.Pages.Referral.Redemptions.Components.Defults.redeemForm')
@includeWhen($can_redeem?false:true, 'MemberArea.Pages.Referral.Redemptions.Components.Defults.notEnoughView')
@endsection
@section('js')
@stack('scripts')
@include('MemberArea.Pages.Referral.Redemptions.Includes.createjs')
@endsection
