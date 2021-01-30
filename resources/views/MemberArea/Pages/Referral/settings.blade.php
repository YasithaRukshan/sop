@extends('MemberArea.Layouts.app')
@section('title', 'Withdrawals | SOP')
@section('ogtitle', 'Withdrawals | SOP')
@section('header')
<div class="row  py-4">
    <div class="col-12">
        <div class="page-title-box d-flex align-items-center justify-content-between">
            <div class="col-lg-6 col-7">
                <h6 class="h2 text-dark d-inline-block mb-0">Share <small>[settings]</small></h6>
                <nav aria-label="breadcrumb" class="d-none d-md-block mt-2">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="{{ route('dashboard') }}"><i class="bx bx-home"></i></a>
                        </li>
                        <li class="breadcrumb-item"><a href="{{ route('referrals') }}">Share The Project<</a>
                        </li>
                        <li class="breadcrumb-item active" aria-current="page">Settings</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
</div>
@endsection
@section('content')
<div class="row">
    <div class="col-md-5 col-lg-6 col-xl-6">
        <form action="{{ route('referrals.settings.store') }}" method="post">
            @csrf
            <div class="card">
                <div class="card-body">
                    <h5 class="text-center">Auto Conversion Settings</h5>
                    <div class="custom-control custom-switch mt-4" dir="ltr">
                        <input type="hidden" name="status" value="0">
                        <input type="checkbox" name="status" value="1" {{ $settings&&$settings->status?'checked':'' }} class="custom-control-input" id="customSwitch1">
                        <label class="custom-control-label" for="customSwitch1">Automatically convert rewards to SOAX</label>
                    </div>
                    <div class="col-lg-12 convertionAmount mt-4">
                            <input type="text" name="rate" value="{{ $settings?$settings->rate:50 }}" id="convertionAmount">
                    </div>
                    <h6 class="text-center mt-4">
                        <button class="btn btn-primary">Save</button>
                    </h6>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection

@push('css')
<link rel="stylesheet"
href="https://cdnjs.cloudflare.com/ajax/libs/ion-rangeslider/2.3.1/css/ion.rangeSlider.min.css" />
@endpush
@push('afterjs')
<script src="https://cdnjs.cloudflare.com/ajax/libs/ion-rangeslider/2.3.1/js/ion.rangeSlider.min.js"></script>
<script>
      $("#convertionAmount").ionRangeSlider({
            skin: "round",
            min: 0,
            max: 100,
            step: 1, // default 1 (set step)
            grid: true, // default false (enable grid)
            onChange: function (data) {
            },
        });
</script>
@endpush
