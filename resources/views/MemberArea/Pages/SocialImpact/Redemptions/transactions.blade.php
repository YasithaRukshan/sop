@extends('MemberArea.Layouts.app')
@section('title', 'Social Impacts Management | SOP')
@section('header')
<div class="row  py-4">
    <div class="col-12">
        <div class="page-title-box d-flex align-items-center justify-content-between">
            <div class="col-12">
                <h6 class="h2 text-dark d-inline-block mb-0"> Your Redeem Social Impact Logs</h6>
                <nav aria-label="breadcrumb" class="d-none d-md-block mt-2">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="{{ route('dashboard') }}"><i class="bx bx-home"></i></a>
                        </li>
                        <li class="breadcrumb-item active" aria-current="page"> <a
                                href="{{ route('social.impact') }}">Social Impacts Logs</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Social Impacts transasctions</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
</div>
@endsection
@section('content')
<livewire:socialimpact.transasctions />
@endsection
@push('css')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/tailwindcss/1.9.2/tailwind.min.css"
    integrity="sha512-l7qZAq1JcXdHei6h2z8h8sMe3NbMrmowhOl+QkP3UhifPpCW2MC4M0i26Y8wYpbz1xD9t61MLT9L1N773dzlOA=="
    crossorigin="anonymous" />
@endpush
@section('js')

@endsection
