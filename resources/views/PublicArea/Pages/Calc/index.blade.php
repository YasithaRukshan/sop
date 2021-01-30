@extends('PublicArea.Layouts.app')
@section('title', 'Calculator | SOP')
@section('content')


<!--Page Title-->
<section class="page-title text-center style-two">
    <div class="pattern-layer auth-header"></div>
</section>
<!--End Page Title-->
<!-- contact-section -->
<section class="contact-section alternate-2 " style="margin-top: 5vh">
    <div class="pattern-layer auth-form-area"></div>
    <div class="auto-container">
        <div class="row justify-content-center">
            <div class="col-lg-8 text-center">
                <h6>
                    The following scenario calculator is purely for illustrative purposes ONLY based on estimates
                    and variable and is not a guarantee of specific production or revenue.
                </h6>
            </div>
            <div class="col-lg-12 mt-4">

            </div>
            <div class="col-lg-4">
                <div class="card">
                    <div class="card-body">
                        <h3 class="text-center">
                            SOAX ReStaking Scenario Calculator
                        </h3>
                        <hr class="text-center mb-4">
                        <form action="{{ route('calc') }}" class=" form-horizontal" method="get">

                            <div class="form-group">
                                <label for="inp_soax">How many initial tokens<span class="text-danger">*</span></label>
                                <input type="number" step="1" min="1" class="form-control" onkeyup="dollorVal()"
                                    value="{{ $soax }}" name="soax" id="inp_soax" aria-describedby="helpId"
                                    placeholder="Enter tokens" required>
                                <small class="form-text text-muted" id="soax_to_usd"></small>
                            </div>

                            <div class="form-group mb-0">
                                <label for="inp_price">Average WTI Price of Oil<span
                                        class="text-danger">*</span></label>
                            </div>
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text" id="basic-addon1">$</span>
                                </div>
                                <input type="number" step="0.01" min="1" name="price" id="inp_price"
                                    class="form-control" value="{{ $price }}" placeholder="Enter price"
                                    aria-label="Enter price" aria-describedby="basic-addon1" required>
                            </div>

                            <div class="form-group">
                                <label for="inp_ratio">% automated rebuy (compounding)
                                    <span class="text-danger">*</span>
                                </label>
                                <input type="number" min="1" max="100" class="form-control" value="{{ $ratio }}"
                                    name="ratio" id="inp_ratio" aria-describedby="helpId" placeholder="0% - 100%"
                                    required>
                            </div>
                            <div class="form-group">
                                <label for="inp_ratio">Number of months of compounding
                                    <span class="text-danger">*</span>
                                </label>
                                <input type="number" min="0" max="120" class="form-control" value="{{ $month }}"
                                    name="month" id="inp_month" aria-describedby="helpId" onkeyup="yearVal()"
                                    placeholder="0 - 120" required>
                                <small class="form-text text-muted" id="month_to_year"></small>
                            </div>

                            <div class="row">
                                <div class="col-lg-12 text-center">
                                    <button type="submit" class="btn btn-primary">Submit</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            {{-- don't remove --}}
            @if ($formLoaded)
            <div class="col-lg-12" style="margin-top: 50px;margin-bottom: 50px;">
                <h1 class="text-success text-center">Total Oil Revenue Over Life Of SOAX Staking</h1>
                <h1 class="text-success text-center"><strong>USD {{ number_format($total,2) }}</strong> </h1>
            </div>
            <div class="col-lg-6 mb-4">
                <div class="card shadow">
                    <div class="card-body">
                        <canvas id="canvasRv"></canvas>
                    </div>
                </div>
            </div>
            <div class="col-lg-6 mb-4">
                <div class="card shadow">
                    <div class="card-body">
                        <canvas id="canvasW"></canvas>
                    </div>
                </div>
            </div>
            <div class="col-lg-12 col-12">
                <div class="card shadow">
                    <div class="card-body table-responsive">
                        <table class="table table-bordered table-hover table-striped">
                            <thead class="thead-light">
                                <tr>
                                    <td>Month</td>
                                    <td>SOAX</td>
                                    <td>New SOAX</td>
                                    <td>Daily SOPX</td>
                                    <td>Oil revenue</td>
                                    <td>Monthly withdrawal</td>
                                    <td>Amount Used For New SOAX</td>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($resultArr as $key=> $rA)
                                <tr>
                                    <td data-toggle="tooltip" data-placement="top" title="Month">{{ $key+1 }}</td>
                                    <td data-toggle="tooltip" data-placement="top" title="SOAX">
                                        {{ number_format($rA['soax'],0) }}</td>
                                    <td data-toggle="tooltip" data-placement="top" title="New SOAX">
                                        {{ number_format($rA['newSoax'],0) }}</td>
                                    <td data-toggle="tooltip" data-placement="top" title="Daily SOPX">
                                        {{ number_format($rA['exptDailySopx'],4)}}</td>
                                    <td data-toggle="tooltip" data-placement="top" title="Oil revenue">
                                        ${{ $rA['mntlyOilRevenue'] }}</td>
                                    <td data-toggle="tooltip" data-placement="top" title="Monthly withdrawal">
                                        ${{ $rA['mntlyWithdrawal'] }}</td>
                                    <td data-toggle="tooltip" data-placement="top" title="Amount Used For New SOAX">
                                        ${{ $rA['mntlyOilRevenue']-$rA['mntlyWithdrawal'] }}</td>
                                </tr>
                                @endforeach
                                @foreach ($deductionArr as $dkey=> $dA)
                                @if ($month*1 > $dkey)
                                <tr>
                                    <td data-toggle="tooltip" data-placement="top" title="Month">{{ $dkey+121 }}</td>
                                    <td data-toggle="tooltip" data-placement="top" title="SOAX">
                                        {{ number_format($dA['soax'],0) }}</td>
                                    <td data-toggle="tooltip" data-placement="top" title="New SOAX">-</td>
                                    <td data-toggle="tooltip" data-placement="top" title="Daily SOPX">
                                        {{ number_format($dA['exptDailySopx'],4) }}</td>
                                    <td data-toggle="tooltip" data-placement="top" title="Oil revenue">$
                                        {{ $dA['mntlyOilRevenue'] }}</td>
                                    <td data-toggle="tooltip" data-placement="top" title="Monthly withdrawal">$
                                        {{ $dA['mntlyWithdrawal'] }}</td>
                                    <td data-toggle="tooltip" data-placement="top" title="Amount Used For New SOAX">
                                        ${{ $dA['mntlyOilRevenue']-$dA['mntlyWithdrawal'] }}</td>
                                </tr>
                                @endif
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            @endif
        </div>
    </div>
</section>
@endsection

@section('css')
@include('auth.Includes.css')
<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.4/Chart.css">
<style>
    #contact-form input:focus,
    #contact-form textarea:focus {
        border-color: #00032b !important;
    }

    .scroll-top {
        top: 85vh;
        border: 1px solid #4b4f5b;

    }

    @media only screen and (max-width: 599px) {
        .scroll-top {
            top: 80vh;
        }
    }

    .table td {
        font-size: 1rem;
    }

    .page-title {
        padding: 42px 0px 60px 0px;
    }

    .thead-light {
        background-color: #ececec;
    }

    /* sss */

</style>
@endsection
@push('js')
<script>
    $(document).ready(function () {
        dollorVal();
        yearVal();
    });

    function dollorVal() {
        var value = $('#inp_soax').val() / 10;
        if (value >= 0) {

            $('#soax_to_usd').html('( USD ' + value + ')');
        }
    }

    function yearVal() {
        var value = parseInt($('#inp_month').val()) / 12;
        if (value >= 0) {

            $('#month_to_year').html('(' + value.toFixed(2) + ' Years )');
        }
    }

    $(function () {
        $('[data-toggle="tooltip"]').tooltip()
    })

</script>
@if($formLoaded)
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.4/Chart.js"></script>
<script>
    var configRv = {
        type: 'line',
        data: {
            labels: @json($months),
            datasets: [{
                label: 'Revenue',
                fill: false,
                backgroundColor: 'green',
                borderColor: 'green',
                data: @json($chart_data_revenue),
            }]
        },
        options: {
            responsive: true,
            plugins: {
                title: {
                    display: true,
                    text: 'Compound Calculator'
                },
                tooltip: {
                    mode: 'index',
                    intersect: false,
                }
            },
            hover: {
                mode: 'nearest',
                intersect: true
            },
            scales: {
                x: {
                    display: true,
                    scaleLabel: {
                        display: true,
                        labelString: 'Month'
                    }
                },
                y: {
                    display: true,
                    scaleLabel: {
                        display: true,
                        labelString: 'Value'
                    },
                }
            }
        }
    };

    var configW = {
        type: 'line',
        data: {
            labels: @json($months),
            datasets: [{
                label: 'Withdrawals ',
                backgroundColor: 'red',
                borderColor: 'red',
                data: @json($chart_data_withdrawals),
                fill: false,
            }]
        },
        options: {
            responsive: true,
            plugins: {
                title: {
                    display: true,
                    text: 'Compound Calculator'
                },
                tooltip: {
                    mode: 'index',
                    intersect: false,
                }
            },
            hover: {
                mode: 'nearest',
                intersect: true
            },
            scales: {
                x: {
                    display: true,
                    scaleLabel: {
                        display: true,
                        labelString: 'Month'
                    }
                },
                y: {
                    display: true,
                    scaleLabel: {
                        display: true,
                        labelString: 'Value'
                    },
                }
            }
        }
    };

    window.onload = function () {
        var ctxRv = document.getElementById('canvasRv').getContext('2d');
        var ctxW = document.getElementById('canvasW').getContext('2d');
        window.myLineRv = new Chart(ctxRv, configRv);
        window.myLineW = new Chart(ctxW, configW);
    };

</script>
@endif
@endpush
