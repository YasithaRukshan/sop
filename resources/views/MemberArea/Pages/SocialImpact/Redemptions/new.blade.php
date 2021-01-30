@extends('MemberArea.Layouts.app')
@section('title', 'Social Impacts Management | SOP')
@section('header')

<div class="row  py-4">
    <div class="col-12">
        <div class="page-title-box d-flex align-items-center justify-content-between">
            <div class="col-12">
                <h6 class="h2 text-dark d-inline-block mb-0">Redeem Rewards <small>[Transfer or
                        Convert]</small></h6>
                <nav aria-label="breadcrumb" class="d-none d-md-block mt-2">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="{{ route('dashboard') }}"><i class="bx bx-home"></i></a>
                        </li>
                        <li class="breadcrumb-item active" aria-current="page">Redeem Rewards</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
</div>
@endsection
@section('content')
@includeWhen($can_redeem?true:false,'MemberArea.Pages.SocialImpact.Redemptions.Components.Default.redeemForm')
@includeWhen($can_redeem?false:true, 'MemberArea.Pages.SocialImpact.Redemptions.Components.Default.notEnoughView')
@endsection
@section('js')
@livewireScripts
@stack('scripts')
@include('MemberArea.Pages.SocialImpact.Redemptions.Includes.createjs')
@endsection
