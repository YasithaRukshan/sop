@extends('MemberArea.Layouts.app')
@section('title', 'Token Purchases | SOP')
@section('header')
<div class="row  py-4">
    <div class="col-12">
        <div class="page-title-box d-flex align-items-center justify-content-between">
            <div class="col-lg-6 col-7">
                <h6 class="h2 text-dark d-inline-block mb-0">Token Purchases <small>[View]</small></h6>
                <nav aria-label="breadcrumb" class="d-none d-md-block mt-2">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="{{ route('dashboard') }}"><i class="bx bx-home"></i></a>
                        </li>
                        <li class="breadcrumb-item"><a href="{{ route('wallet.purchase') }}">Token Purchases</a>
                        </li>
                        <li class="breadcrumb-item active" aria-current="page">View</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
</div>
@endsection
@section('content')

<div class="row">
    <div class="col-lg-6 col-sm-12 col-md-12 col-12">
        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="col-lg-12 text-left mb-3">
                        <h3 class="h3">Transaction Information</h3>
                    </div>
                    <div class="col-lg-12">
                        <h5 class="h5"><i class='bx bx-coin-stack'></i> Transfered From :
                            {!!$tc->transactionType($purchase)!!}
                        </h5>
                        <h5 class="h5"><i class='bx bx-money'></i> Token Amount:-
                            <strong> SOAX {{$tc->zeroDecimal($purchase['amount'])}}</strong>
                        </h5>
                    </div>
                    <div class="col-lg-12">
                        <h5 class="h5">
                            <i class="fas fa-clock"></i>
                            Purchases date:-
                            <strong>{{$tc->timeName($purchase['created_at'])}}</strong>
                        </h5>
                        <h5 class="h5">
                            <i class="fas fa-toggle-on"></i>
                            Status:-
                            <strong>{!!$tc->purchasesStatus($purchase['status'])!!}</strong>
                        </h5>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-lg-6 col-sm-12 col-md-12 col-12">
        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="col-lg-12 text-left mb-3">
                        <h3 class="h3">Commissions</h3>
                    </div>
                    @if ($purchase->commission)
                    <div class="col-lg-12">
                        <h5 class="h5"><i class='bx bx-user'></i> Referral Name :
                            <strong> {{($purchase->commission->commissionReferral->user['first_name'])}}
                                {{($purchase->commission->commissionReferral->user['last_name'])}}</strong>
                        </h5>
                        <h5 class="h5"><i class='bx bx-mail-send'></i> Referral Email:-
                            <strong>{{($purchase->commission->commissionReferral->user['email'])}}</strong>
                        </h5>
                    </div>
                    <div class="col-lg-12">
                        <h5 class="h5">
                            <i class='bx bx-money'></i>
                            Total Commission (Dollars):- <strong>$
                                {{number_format($purchase->commission['amount'],2)}}</strong>
                        </h5>
                        <h5 class="h5">
                            <i class='bx bx-coin'></i>
                            Total Commission (ETR):-
                            <strong>{{$tc->convertUSDToETH($purchase->commission['amount'])}}</strong>
                        </h5>
                    </div>
                    @else
                    <h6 class="h6 text-center">Empty</h6>
                    @endif

                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@section('css')
@endsection
@section('js')
<script>
    $(document).ready(function () {
        $('#purchase_tb').dataTable({
            "language": {
                "emptyTable": "No data available in the table",
                "paginate": {
                    "previous": '<i class="fas fa-chevron-left text-dark"></i>',
                    "next": '<i class="fas fa-chevron-right text-dark"></i>'
                },
                "sEmptyTable": "No data available in the table"
            }

        });
        $('#commissions_tb').dataTable({
            "language": {
                "emptyTable": "No data available in the table",
                "paginate": {
                    "previous": '<i class="fas fa-chevron-left text-dark"></i>',
                    "next": '<i class="fas fa-chevron-right text-dark"></i>'
                },
                "sEmptyTable": "No data available in the table"
            }

        });
    });

</script>
@endsection
