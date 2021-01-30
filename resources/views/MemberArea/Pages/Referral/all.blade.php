@extends('MemberArea.Layouts.app')
@section('title', 'Share The Project | SOP')
@section('header')

<div class="row  py-4 {{ $tc->isStaked()?"":"uvbb" }}">
    <div class="col-12">
        <div class="page-title-box d-flex align-items-center justify-content-between">
            <div class="col-lg-12 col-12">
                <h6 class="h2 text-dark d-inline-block mb-0">Share The Project</h6>
                <nav aria-label="breadcrumb" class="d-none d-md-block mt-2">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="{{ route('dashboard') }}"><i class="bx bx-home"></i></a>
                        </li>
                        <li class="breadcrumb-item active" aria-current="page">Share The Project</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
</div>
@endsection
@section('content')
@if (!$tc->isStaked())
<div class="uvbb_ovl">
    <div class="row justify-content-center">
        <div class="col-lg-6">
            <div class="card h-100 w-100">
                <div class="card-body text-center">
                    <h5>Sharing is only available to <a href="{{ route('contracts.create') }}"><strong
                                class="text-danger">Stakeholders</strong></a>. <br>
                        Please <a href="{{ route('contracts.create') }}">create your first Staking Contract</a> to
                        access this page.</h5>
                </div>
            </div>
        </div>
    </div>
</div>
@endif
<div class="row {{ $tc->isStaked()?"":"uvbb" }}">
    <div class="col-xl-4">
        <div class="card" id="referrals-div">
            <div class="card-body border-top posRel">
                <div class="row mh-100">
                    <div class="col-8 h-100">
                        <div class="row h-100">
                            <div class="col-12">
                                <h5 class="text-muted"> Total Referrals </h5>
                                <h4 class="h4">
                                    <strong id="increment"></strong> <sup style="font-size:50%">(Up to
                                        <span id="nowLevel"></span> )</sup>
                                </h4>
                            </div>
                            <div class="col-lg-12 align-self-end">
                                <a href="{{ route('referrals.transactions') }}" class="btn btn-dark btn-sm mt-4">
                                    <i class="fas fa-clipboard-list"></i>
                                    Redeem logs</a>
                            </div>
                        </div>
                    </div>
                    <div class="col-4">
                        <i class="fas fa-users-cog fa-6x text-warning"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-xl-4">
        <div class="card" id="referrals-div">
            <div class="card-body border-top posRel">
                <div class="row mh-100">
                    <div class="col-8 h-100">
                        <div class="row h-100">
                            <div class="col-12">
                                <h5 class="text-muted"> Total Commissions </h5>
                                <h4 class="h4">
                                    {!! $tc->ethPan($tc->commissionsRewards()['main']) !!}
                                    @if($tc->commissionsRewards()['temp']>0)
                                    <sup style="font-size:50%;color: rgb(129, 128, 128);" data-toggle="tooltip"
                                        data-placement="top" title="Approval Awaiting Amount (Min=0.25 SOAX)">
                                        [
                                        {{ $tc->ethPan($tc->commissionsRewards()['temp']) }}
                                        <div class="spinner-border spinner-border-xsm" role="status"></div>
                                        ]
                                    </sup>
                                    @endif
                                </h4>
                            </div>
                            <div class="col-12 align-self-end mt-4">
                                <a href="{{ URL::route('referrals.logs',['fname'=>0 ,'lname'=>0]) }}"
                                    class="btn btn-dark btn-sm mb-3 mb-sm-0">
                                    <i class="fas fa-eye"></i>
                                    View Log
                                </a>
                                |
                                <a href="{{ route('referral.redemptions.create') }}" class="btn btn-dark btn-sm">
                                    <i class="fas fa-plus-circle"></i>
                                    Redeem
                                </a>
                            </div>
                        </div>
                    </div>
                    <div class="col-4">
                        <i class="fas fa-ice-cream fa-6x text-success"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-xl-4">
        <div class="card" id="referrals-div">
            <div class="card-body border-top posRel">
                <div class="row mh-100">
                    <div class="col-12">
                        <div class="row">
                            <div class="col-12">
                                <h5 class="text-muted h5">Your Link</h5>
                                <h5 class="mb-0 h5">
                                    <code>
                                        {{route('/')}}/?a={{Auth::user()->username?Auth::user()->username:config('app.def_username')}}
                                    </code>
                                    <a class="btn btn-link btn-sm p-0 h5" href="javascript:void(0)"
                                        data-toggle="tooltip" title="Click Here To Copy"
                                        onclick="copyUrl('{{route('/')}}?a={{Auth::user()->username?Auth::user()->username:config('app.def_username')}}')">
                                        <i class="fas fa-copy"></i>
                                    </a>
                                </h5>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="row {{ $tc->isStaked()?"":"uvbb" }}">
    <div class="col-12">
        <div class="card">
            <div class="table-responsive  py-4">
                <table class="table text-center" id="referral_tb">
                    <thead>
                        <tr>
                            <th style="width:10%;">#</th>
                            <th>Degrees</th>
                            <th>No of Users</th>
                            <th>Details</th>
                        </tr>
                    </thead>
                    <tbody id="viewDataTbody"></tbody>
                </table>
            </div>
            <div class="row justify-content-center pb-4">
                <div class="col-lg-2" id="buttons-parent-div" style="margin: 0 auto;">
                    <div class="d-flex">
                        <button id="minus" data-toggle="tooltip" data-placement="top" title="Decrease Level"
                            class="btn btn-link text-dark" onclick="setPreRow()"><i
                                class="text-dark fas fa-chevron-circle-left"></i></button>
                        <input type="text" id="level-display" style="width:100px; font-size:0.8rem" value="1"
                            class="text-center form-control" readonly>
                        <button id="plus" data-toggle="tooltip" data-placement="top" title="Increase Level" data
                            class="btn btn-link text-dark" disabled onclick="setNextRow()">
                            <i class="text-dark fas fa-chevron-circle-right"></i>
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@include('MemberArea.Pages.Referral.Components.modal')
@endsection
@section('js')
@include('MemberArea.Pages.Referral.Includes.js')
@endsection
@section('css')
<style>
    @media only screen and (max-width: 540px) {
        .fa-6x {
            font-size: 4em;
        }

        .flex-wrap {
            margin-bottom: 20px;
        }

        div.dataTables_wrapper div.dataTables_length,
        div.dataTables_wrapper div.dataTables_filter,
        div.dataTables_wrapper div.dataTables_info {
            text-align: center;
        }

        .dataTables_length {
            padding-left: 0.5rem;
        }

        div.dataTables_wrapper div.dataTables_filter input {
            width: 80%;
        }

        div.dataTables_paginate {
            padding-left: 150px;
        }
    }

</style>
@endsection
