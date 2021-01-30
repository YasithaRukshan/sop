@extends('MemberArea.Layouts.app')
@section('title', 'Redemptions | SOP')
@section('ogtitle', 'Redemptions | SOP')
@section('header')
<div class="row  py-4">
    <div class="col-12">
        <div class="page-title-box d-flex align-items-center justify-content-between">
            <div class="col-lg-6 col-7">
                <h6 class="h2 text-dark d-inline-block mb-0">Redemptions <small>[All]</small></h6>
                <nav aria-label="breadcrumb" class="d-none d-md-block mt-2">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="{{ route('dashboard') }}"><i class="bx bx-home"></i></a>
                        </li>
                        <li class="breadcrumb-item active" aria-current="page">Redemptions</li>
                    </ol>
                </nav>
            </div>

        </div>
    </div>
</div>
@endsection
@section('content')
<div class="row">
    <div class="col-lg-12">
        <div class="row">
            <div class="col-md-6 col-sm-6 col-lg-6 col-xl-6">
                <div class="card" id="balance-div">
                    <div class="card-body">
                        <h4 class="h4 text-center">Balance summary</h4>
                        <div class="row mt-5  text-center">
                            <div class="col-6">
                                <h4 class="h5 text-center"> <i class="mdi mdi-cash h2 text-success mb-0"></i>
                                    Available
                                </h4>
                                <h5 class="h5">SOPX {{$tc->getBalanceSOPX()}}</h5>
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
                                <div>
                                    @include('MemberArea.Pages.Wallet.Components.withdrawDropDown',['class'=>'dropright','btn'=>'btn-primary','btn_text'=>'Redeem
                                    Now'])
                                </div>
                            </div>
                            <div class="col-6">
                                <h5 class="h5 text-center"><i class="mdi mdi-cash-remove h2 text-danger mb-0"></i>
                                    Redeemed</h5>
                                <h5 class="h5 d">SOPX {{$tc->getRedeemedBalance()}}
                                    @if ($tc->getRedeemPendingBalance(false)>0)
                                    <sup data-toggle="tooltip" data-placement="top" title="Waiting For Approval">
                                        <small>
                                            [
                                            <div class="spinner-border spinner-border-sm" role="status">
                                                <span class="sr-only">Loading...</span>
                                            </div>
                                            {{$tc->getRedeemPendingBalance()}}
                                            ]
                                        </small>
                                    </sup>
                                    @endif
                                </h5>
                                <strong class="">Auto Converted: SOPX {{$tc->getRedeemAutoConvertedBalance()}}</strong>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-6 col-sm-6 col-lg-6 col-xl-6 mb-3 mb-sm-0">
                <form action="{{ route('wallet.withdrawals.settings.store') }}" method="post">
                    @csrf
                    <div class="card" id="settings-div">
                        <div class="card-body">
                            <h4 class="h4 text-center">Auto Conversion Settings</h4>
                            <div class="row">
                                <div class="col-lg-8">
                                    <div class="custom-control custom-switch mt-4" dir="ltr">
                                        <input type="hidden" name="status" value="0">
                                        <input type="checkbox" name="status" value="1"
                                            {{ $settings&&$settings->status?'checked':'' }} class="custom-control-input"
                                            id="customSwitch1">
                                        <label class="custom-control-label" for="customSwitch1">Convert SOPX
                                            accumulation to
                                            SOAX</label>
                                    </div>
                                </div>
                                <div class="col-lg-4 mt-1">
                                    <div class="row justify-items-center bg-light pt-3 pb-3">
                                        <div class="col-4">
                                            <img src="{{ asset('MemberArea/images/sopx.png') }}" width="55">
                                        </div>
                                        <div class="col-4">
                                            <h1 class="h1">
                                                <strong> <i class="fas fa-chevron-right"></i> </strong>
                                            </h1>
                                        </div>
                                        <div class="col-4">
                                            <img src="{{ asset('MemberArea/images/soax.png') }}" width="55">
                                        </div>
                                    </div>

                                </div>
                            </div>
                            <div class="col-lg-12 convertionAmount mt-4">
                                <input type="text" name="rate" value="{{ $settings?$settings->rate:50 }}"
                                    id="convertionAmount">
                            </div>
                            <h6 class="text-center mt-4">
                                <button class="btn btn-primary">Save</button>
                            </h6>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-12">
        <div class="card border-0 shadow">
            <div class="table-responsive py-4">
                <table id="Withdrawals_tb" class="table">
                    <thead>
                        <tr>
                            <th>ID No</th>
                            <th>Amount</th>
                            <th>Recipient address</th>
                            <th>Withdraw type</th>
                            <th>Status</th>
                            <th>Date</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($withdrawal as $item)
                        <tr>
                            <td>{{$item->id}}</td>
                            <td>SOPX: {{$item->sopx_amount}}</td>
                            <td>{!! $item->recipient_address?$item->recipient_address:'<span class="text-muted">SOAX
                                    Convertion</span>' !!}</td>
                            <td>{!!$tc->withdrawType($item->withdraw_type,$item->acc_type)!!}</td>
                            <td>{!!$tc->withdrawAdminStatus($item->status)!!}</td>
                            <td>{{$item->updated_at}}</td>
                            <td>{!!$tc->withdrawAction($item)!!}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@include('MemberArea.Pages.Wallet.Withdrawals.Components.Default.rejectModal')
@endsection
@push('css')
<link rel="stylesheet"
    href="https://cdnjs.cloudflare.com/ajax/libs/ion-rangeslider/2.3.1/css/ion.rangeSlider.min.css" />
<style>
    @media screen and (min-width: 990px) {
        #balance-div .card-body {
            height: 55vh;
        }

        #settings-div .card-body {
            height: 55vh;
        }
    }

    @media screen and (max-width: 767px) {

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
@endpush
@push('js')
<script src="https://cdnjs.cloudflare.com/ajax/libs/ion-rangeslider/2.3.1/js/ion.rangeSlider.min.js"></script>

<script>
    $(document).ready(function () {

        $('#Withdrawals_tb').dataTable({
            "language": {
                "emptyTable": "No data available in the table",
                "paginate": {
                    "previous": '<i class="fas fa-chevron-left text-dark"></i>',
                    "next": '<i class="fas fa-chevron-right text-dark"></i>'
                },
                "sEmptyTable": "No data available in the table"
            }
        });

        $("#convertionAmount").ionRangeSlider({
            skin: "round",
            min: 0,
            max: 100,
            step: 1, // default 1 (set step)
            grid: true, // default false (enable grid)
            postfix: '%',
            onChange: function (data) {},
        });
    });
    $('#rejectModal').on('show.bs.modal', function (event) {
        var button = $(event.relatedTarget) // Button that triggered the modal
        var rejectreason = button.data('rejectreason')

        var modal = $(this)
        modal.find('.modal-title').text();
        $('#rejectReasonHTML').html(rejectreason);
    })

</script>
@endpush
