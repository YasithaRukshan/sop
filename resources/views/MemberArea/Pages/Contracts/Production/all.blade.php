@extends('MemberArea.Layouts.app')
@section('title', 'Production | SOP')
@section('ogtitle', 'Production | SOP')
@section('header')
<div class="row  py-4">
    <div class="col-12">
        <div class="page-title-box d-flex align-items-center justify-content-between">
            <div class="col-lg-6 col-7">
                <h6 class="h2 text-dark d-inline-block mb-0">Production</h6>
                <nav aria-label="breadcrumb" class="d-none d-md-block mt-2">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="{{ route('dashboard') }}"><i class="bx bx-home"></i></a>
                        </li>
                        <li class="breadcrumb-item active" aria-current="page">Production</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
</div>
@endsection
@section('content')

<div class="row">
    <div class="col-12">
        @if (count($contracts)>0)
        <div class="row mb-4">
            <div class="col-lg-3 d-none  animated  fadeIn" id="totalProduction">
                <div class="card mini-stats-wid">
                    <div class="card-body">
                        <div class="media">
                            <div class="mr-3 align-self-center">
                                <i class="fas fa-layer-group h2 text-primary mb-0"></i>
                            </div>
                            <div class="media-body">
                                <p class="text-muted mb-2">Total Production</p>
                                <h6 class="mb-0">SOPX <strong id="valProduction"></strong></h6>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 d-none  animated  fadeIn" id="totalStaked">
                <div class="card mini-stats-wid">
                    <div class="card-body">
                        <div class="media">
                            <div class="mr-3 align-self-center">
                                <i class="far fa-handshake h2 text-primary mb-0"></i>
                            </div>
                            <div class="media-body">
                                <p class="text-muted mb-2">Total Staked</p>
                                <h6 class="mb-0">SOAX <strong id="valStaked"></strong></h6>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 d-none  animated  fadeIn" id="contractDiv">
                <div class="card mini-stats-wid">
                    <div class="card-body">
                        <div class="media">
                            <div class="mr-3 align-self-center">
                                <i class="fas fa-file-signature h2 text-primary mb-0"></i>
                            </div>
                            <div class="media-body">
                                <p class="text-muted mb-2">Contracts</p>
                                <h6 class="mb-0">#<strong id="countContracts"></strong></h6>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-12" id="portfolioDiv">
                <div class="card mini-stats-wid">
                    <livewire:wallet.product.view :contracts="$contracts" />
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-6 col-12  animated fadeIn" id="chartmaindiv">
                <div class="card d-none  animated  fadeIn" id="chartView1">
                    <div class="card-body">
                        <div id="chartdiv" class="chartdiv"></div>
                    </div>
                </div>
            </div>
            <div class="col-lg-6 col-12  animated fadeIn" id="chartmaindiv">
                <div class="card d-none  animated  fadeIn" id="chartView2">
                    <div class="card-body">
                        <div id="chartdiv2" class="chartdiv">
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <div class="card d-none border-0 shadow" id="tablediv">
                    <div class="card-body">
                        <div class="table-responsive py-4">
                            <table class="table" id="datatable">
                                <thead>
                                    <tr>
                                        <th>Date</th>
                                        <th>SOPX Produced</th>
                                        <th>Auto-Conversion</th>
                                        <th>SOPX Left</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>

                                </tbody>
                            </table>
                        </div>
                    </div>
                    <!-- end table-responsive -->
                </div>
            </div>
        </div>
        @else
        <div class="card  mb-3   ">
            <div class="card-body text-center">
                <h3>You don't own any contract yet.</h3>
                <p class="card-title"> Let's create a contract <a href="{{route('contracts.create')}}">Here</a></p>
            </div>
        </div>
        @endif
    </div>
</div>
<div class="modal fade" id="contract_table" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="card">
                    <div class="card-body" id="contract_table_modal">
                        {{-- <div class="spinner-border text-primary" role="status">
                            <span class="sr-only text-center">Loading...</span>
                        </div> --}}
                    </div>
                </div>
            </div>
        </div>
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

    .mini-stats-wid .card-body {
        height: 20vh;
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
@endsection

@section('js')
@stack('scripts')
<script src="{{asset('MemberArea/libs/amchart/core.js')}}"></script>
<script src="{{asset('MemberArea/libs/amchart/charts.js')}}"></script>
<script src="{{asset('MemberArea/libs/amchart/animated.js')}}"></script>
<script>
</script>
@include('MemberArea.Pages.Contracts.Production.Includes.js')
@endsection
