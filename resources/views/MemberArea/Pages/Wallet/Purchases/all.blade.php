@extends('MemberArea.Layouts.app')
@section('title', 'Token Purchases | SOP')
@section('ogtitle', 'Token Purchases | SOP')
@section('header')

<div class="row  py-4">
    <div class="col-12">
        <div class="page-title-box d-flex align-items-center justify-content-between">
            <div class="col-lg-6 col-7">
                <h6 class="h2 text-dark d-inline-block mb-0">Token Purchases</h6>
                <nav aria-label="breadcrumb" class="d-none d-md-block mt-2">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="{{ route('dashboard') }}"><i class="bx bx-home"></i></a>
                        </li>
                        <li class="breadcrumb-item active" aria-current="page">Token Purchases</li>
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
            <div class="col-xl-4">
                <div class="card">
                    <div class="card-body border-top">
                        <div class="row " style="min-height: 100px;">
                            <div class="col-8">
                                <div class="row">
                                    <div class="col-12">
                                        <h5 class="text-muted"> <small>Available Tokens</small> </h5>
                                        <h4 class="h4">SOAX {{$tc->getBalanceSOAX(true)}}</h4>
                                    </div>
                                    <div class="col-12 align-self-end">
                                        @include('MemberArea.Pages.Wallet.Components.mainDeposit')
                                    </div>
                                </div>
                            </div>
                            <div class="col-4">
                                <img src="{{ asset('MemberArea/images/soax.png') }}" alt="" class="img-fluid"
                                    style="width:65%;">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-4">
                <div class="card">
                    <div class="card-body border-top">
                        <div class="row" style="min-height: 100px;">
                            <div class="col-8">
                                <div class="row">
                                    <div class="col-12">
                                        <h5 class="text-muted"> <small>Pending For Approval</small> </h5>
                                        <h4 class="h4">SOAX {{$tc->getPendingSOAX(true)}}</h4>
                                    </div>
                                </div>
                            </div>
                            <div class="col-4">
                                <i class="fas fa-history fa-4x text-warning"></i>
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
        <div class="card">
            <div class="table-responsive py-4">
                <table id="purchase_tb" class="table table-hover dt-responsive nowrap"
                    style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                    <thead>
                        <tr>
                            <th>ID No</th>
                            <th>Type</th>
                            <th>Amount</th>
                            <th>Admin Status</th>
                            <th>Date</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($purchases as $item)
                        <tr>
                            <td><a href="javascript: void(0);"
                                    class="text-body font-weight-bold">{{md5($item['id'])}}</a></td>
                            <td>
                                {!!$tc->transactionType($item)!!}
                            </td>
                            <td>SOAX {{$tc->twoDecimal($item['amount'])}}</td>
                            <td>{!!$tc->purchasesStatus($item['status'])!!}</td>
                            <td>{{$item['created_at']}}</td>
                            <td>
                                <div class="dropleft no-arrow mb-1">
                                    <a class="btn btn-sm btn-icon-only text-dark" href="#" role="button"
                                        data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        <i class="fas fa-cog"></i>
                                    </a>
                                    <div class="dropdown-menu dropdown-menu-left  " aria-labelledby="dropdownMenuButton"
                                        x-placement="bottom-start">
                                        <a class="dropdown-item edit-customer"
                                            href="{{ route('wallet.purchase.view', md5($item['id'])) }}"
                                            class="btn btn-warning" title="">
                                            <i class="fas fa-eye"></i>&nbsp;View
                                        </a>
                                    </div>

                                </div>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <!-- end table-responsive -->
        </div>
    </div>
</div>

@include('MemberArea.Pages.Wallet.Includes.modal')

@endsection
@section('css')

@endsection
@section('js')
<script>
    $(document).ready(function () {
        $('#purchase_tb').dataTable({
            "order": [
                [4, "desc"]
            ],
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
