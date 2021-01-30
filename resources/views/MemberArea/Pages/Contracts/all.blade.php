@extends('MemberArea.Layouts.app')
@section('title', 'Staking | SOP')
@section('header')

<div class="row  py-4">
    <div class="col-12">
        <div class="row page-title-box d-flex align-items-center justify-content-between">
            <div class="col-lg-6 col-7">
                <h6 class="h2 text-dark d-inline-block mb-0">Staking</h6>
                <nav aria-label="breadcrumb" class="d-none d-md-block mt-2">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="{{ route('dashboard') }}"><i class="bx bx-home"></i></a>
                        </li>
                        <li class="breadcrumb-item active" aria-current="page">Staking</li>
                    </ol>
                </nav>

                <a href="{{ route('contracts.create') }}" class=" btn btn-sm btn-primary mt-4">
                    <i class="fas fa-plus-circle"></i> Add Staking Contract
                </a>
            </div>
        </div>
    </div>
</div>
@endsection
@section('content')
<div class="row">
    <div class="col-lg-12">
        <div class="row">
            <div class="col-xl-4">
                <div class="card">
                    <div class="card-body border-top">
                        <div class="row" style="height: 120px;">
                            <div class="col-8">
                                <div class="row">
                                    <div class="col-12">
                                        <h5 class="text-muted h5"> <small>Staked Amount</small> </h5>
                                        <h2 class="h2">SOAX {{$tc->getAuthContractsAmount(true)}}</h2>
                                    </div>
                                </div>
                            </div>
                            <div class="col-4 col-md-2 col-sm-4 ">
                                <i class="fas fa-handshake fa-6x text-warning"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-4">
                <div class="card">
                    <div class="card-body border-top">
                        <div class="row" style="height: 120px;">
                            <div class="col-8 h-100">
                                <div class="row h-100">
                                    <div class="col-12">
                                        <h5 class="text-muted h5"> <small>Total Production</small></h5>
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
                                    <div class="col-12" style="position: absolute;bottom:0px;left:0px;width:100%;">
                                        <a href="{{ route('wallet.production') }}" class="btn btn-dark btn-sm">
                                            <i class="fas fa-eye"></i>
                                            <small>View Log</small>
                                        </a>
                                    </div>
                                </div>
                            </div>
                            <div class="col-4">
                                <img src="{{ asset('MemberArea/images/sopx.png') }}" alt="" class="img-fluid"
                                    id="sopx-img" width="60">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-4">
                <div class="card">
                    <div class="card-body border-top">
                        <div class="row" style="height: 120px;">
                            <div class="col-8">
                                <div class="row">
                                    <div class="col-12">
                                        <h5 class="text-muted h5"> <small>Number of Contracts</small> </h5>
                                        <h2 class="h2"># {{$tc->totalContracts(true)}}</h2>
                                    </div>
                                </div>
                            </div>
                            <div class="col-4">
                                <i class="fas fa-file-contract fa-6x text-primary"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-12">
        <livewire:stake-datatables />
    </div>
</div>
@endsection
@section('css')
@livewireStyles
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/tailwindcss/1.9.2/tailwind.min.css"
    integrity="sha512-l7qZAq1JcXdHei6h2z8h8sMe3NbMrmowhOl+QkP3UhifPpCW2MC4M0i26Y8wYpbz1xD9t61MLT9L1N773dzlOA=="
    crossorigin="anonymous" />
<style>
    @media (min-width: 640px) {
        .sm\:leading-5 {
            line-height: 2.5rem !important;
        }
    }

    @media only screen and (max-width: 540px) {
        .sm\:leading-5 {
            line-height: 2.5rem !important;
        }

        .fa-6x {
            font-size: 4em;
        }

        .flex {
            display: grid;
            margin-bottom: 6px;
            text-align: -webkit-center;
        }

        .tracking-wider {
            width: -webkit-fill-available;
        }
    }

    img {
        display: inline-block
    }

</style>
@endsection
@section('js')
@livewireScripts
<script>
    $(".form-input").attr("placeholder", "Search");

</script>
<script src="https://cdn.jsdelivr.net/gh/alpinejs/alpine@v2.7.3/dist/alpine.min.js" defer></script>
@endsection
