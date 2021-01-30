@extends('MemberArea.Layouts.app')
@section('title', 'Production | My Stakes | SOP')
@section('header')
<div class="row  py-4">
    <div class="col-12">
        <div class="page-title-box d-flex align-items-center justify-content-between">
            <div class="col-lg-6 col-7">
                <h6 class="h2 text-dark d-inline-block mb-0">My Stakes [Production]</h6>
                <nav aria-label="breadcrumb" class="d-none d-md-block mt-2">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="{{ route('dashboard') }}"><i class="bx bx-home"></i></a>
                        </li>
                        <li class="breadcrumb-item"><a href="{{ route('contracts.all') }}">My Stakes</a>
                        </li>
                        <li class="breadcrumb-item active" aria-current="page">Production </li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
</div>
@endsection
@section('content')
<div class="row">
    <div class="col-lg-12 animated fadeIn mb-4">
        <h4>
            Total Production Of Your
            <strong>{{ number_format($contract->amount/$contract->Portfolio->price*100,4) }}%
                Stake</strong>
            On
            <strong>{{$contract->Portfolio->title}}</strong> Portfolio
        </h4>
    </div>
    <div class="col-lg-3">
        <div class="card mini-stats-wid" id="referrals-div">
            <div class="card-body">
                <div class="media">
                    <div class="mr-3 align-self-center">
                        <i class="mdi mdi-cash-remove h2 text-danger mb-0"></i>
                    </div>
                    <div class="media-body">
                        <p class="text-muted mb-2">Your Stake </p>
                        <h6 class="mb-0">SOAX {{ $contract->amount }}</h6>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-lg-3">
        <div class="card mini-stats-wid" id="referrals-div">
            <div class="card-body">
                <div class="media">
                    <div class="mr-3 align-self-center">
                        <i class="mdi mdi-multiplication h2 text-warning mb-0"></i>
                    </div>
                    <div class="media-body">
                        <p class="text-muted mb-2">Total Production </p>
                        <h6 class="mb-0">SOPX {{number_format($tc->getContractProduction($contract->id),4)}}</h6>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-lg-3">
        <div class="card mini-stats-wid" id="referrals-div">
            <div class="card-body">
                <div class="media">
                    <div class="mr-3 align-self-center">
                        <i class="fas fa-calendar-check h2 text-primary mb-0"></i>
                    </div>
                    <div class="media-body">
                        <p class="text-muted mb-2">Contract Date </p>
                        <h6 class="mb-0">SOPX {{ $tc->timeName($contract->created_at) }}</h6>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-lg-4  animated fadeIn" id="chartmaindiv">
        <div class="card">
            <div class="card-body">
                <div id="chartdiv"></div>
            </div>
        </div>
    </div>
    <div class="col-12 col-lg-8">
        <div class="card">
            <div class="table-responsive  py-4">
                <table class="table" id="portfolios_tb">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Production</th>
                            <th>Date</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($contract->production as $key => $production)
                        <tr>
                            <td>{{'#PRO' . sprintf('%08d', ++$key)}}</td>
                            <td>SOPX <strong>{{number_format(($production->amount),4)}}</strong></td>
                            <td>{{ Carbon\Carbon::parse($production->created_at)->format('M d Y : h:i a') }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <!-- end table-responsive -->
        </div>
    </div>
</div>
@endsection
@section('css')
@include('MemberArea.Pages.Contracts.Show.Includes.css')
@endsection
@section('js')
@include('MemberArea.Pages.Contracts.Show.Includes.js')
<script>
    $(document).ready(function () {
        $('#portfolios_tb').dataTable({
            "language": {
                "emptyTable": "No data available in the table",
                "paginate": {
                    "previous": '<i class="fas fa-chevron-left text-dark"></i>',
                    "next": '<i class="fas fa-chevron-right text-dark"></i>'
                },
                "sEmptyTable": "No data available in the table"
            }
        });
        pieChart('{{$contract->amount}}', '{{$contract->Portfolio->price-$contract->amount}}')
    });

</script>
@endsection
