@extends('MemberArea.Layouts.app')
@section('title', 'New Staking | SOP')
@section('header')
<div class="row  py-4">
    <div class="col-12">
        <div class="page-title-box d-flex align-items-center justify-content-between">
            <div class="col-lg-6 col-7">
                <h6 class="h2 text-dark d-inline-block mb-0">Staking </h6>
                <nav aria-label="breadcrumb" class="d-none d-md-block mt-2">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="{{ route('dashboard') }}"><i class="bx bx-home"></i></a>
                        </li>
                        <li class="breadcrumb-item"><a href="{{ route('contracts.all') }}">Staking</li></a>
                        <li class="breadcrumb-item active" aria-current="page">New Staking</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
</div>
@endsection
@section('content')
<form action=" {{route('contracts.store')}}" method="post" id="contracts_form">
    @csrf
    <div class="row">
        <div class="col-lg-5 animated fadeIn">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="form-group">
                                <label for="">Select A Oil Portfolio</label>
                                <select class="form-control" name="portfolio_id" id="portfolio_id" required>
                                    <option></option>
                                    @foreach ($portfolios as $portfolio)
                                    <option value='{{ $portfolio->id }}'>{{ $portfolio->title }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-12 d-none" id="formDiv">
                    <div class="card">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="form-group">
                                        <label for="">You can stake up to
                                            <strong>SOAX: <span id="set_available_value"></span></strong>
                                            form the oil portfolio
                                        </label>
                                        <input type="number" class="form-control soax-input" onKeyup="validateAmount()"
                                            name="amount" id="inp_amount" placeholder="Enter amount" step="0.01"
                                            min="0.10" required>
                                        <span class="text-danger">
                                            <small><strong id="amount_msg"></strong></small>
                                        </span>
                                        <div class="mt-2">
                                            <h6>Max Stake Value, SOAX: <a class="text-primary" href="javascript:void(0)"
                                                    onclick="appendBalance({{ $tc->getBalanceSOAX()}})"><strong>{{ $tc->getBalanceSOAX() }}</strong></a>
                                            </h6>
                                        </div>
                                        <div class="d-none" id="staaking_div">
                                            <h6>Your Are Staking
                                                <strong> <span class="text-success" id="staaking_value">
                                                    </span></strong> From <strong>Portfolio</strong>
                                            </h6>
                                        </div>
                                    </div>
                                    @include('MemberArea.Pages.Contracts.Components.add_wallet')
                                </div>

                                <div class="col-12 mt-4 text-center">
                                    <button type="submit" disabled id="submit_btn"
                                        class="btn btn-primary">Submit</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-lg-7 d-none animated fadeIn" id="chartmaindiv">
            <div class="card">
                <div class="card-body">
                    <div id="chartdiv"></div>
                </div>
            </div>
            <div class="card d-none" id="descriptiondiv">
                <div class="card-body">
                    <label>Portfolio Description :</label>
                    <p id="descriptiontext"></p>
                </div>
            </div>
        </div>
    </div>
</form>
@endsection
@section('css')
@include('MemberArea.Pages.Contracts.Includes.css')
@endsection
@section('js')
@include('MemberArea.Pages.Contracts.Includes.js')
@endsection
