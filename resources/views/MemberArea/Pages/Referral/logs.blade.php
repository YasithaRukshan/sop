@extends('MemberArea.Layouts.app')
@section('title', 'Share The Project | SOP')
@section('header')
<div class="row  py-4">
    <div class="col-12">
        <div class="page-title-box d-flex align-items-center justify-content-between">
            <div class="col-lg-12 col-7">
                <h6 class="h2 text-dark d-inline-block mb-0">Your Share Logs </h6>
                <nav aria-label="breadcrumb" class="d-none d-md-block mt-2">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="{{ route('dashboard') }}"><i class="bx bx-home"></i></a>
                        </li>
                        <li class="breadcrumb-item" aria-current="page"><a href="{{ route('referrals') }}"> Share
                                The Project</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Logs{{$name}}</li>

                    </ol>
                </nav>
            </div>
        </div>
    </div>
</div>
@endsection
@section('content')
@livewire('referral.log-view', ['fname' => $name])
@endsection
@section('js')
<script>
    $(document).ready(function () {
        getName()
    });

    function getName() {
        var check = '{{ $name }}';
        if (check == 0) {
            $(".form-input").attr("placeholder", "Search");
        } else {
            var name = '{{ $name }}';
            $(".form-input").val(name);
        }

    }


    function codeAddress() {

        var name = '{{ $name }}';
        var newname = name.substring(0, name.length - 1);
        $(".form-input").val(newname);

        $(".form-input").focus(function () {
            if (this.setSelectionRange) {
                var len = $(this).val().length;
                this.setSelectionRange(len, len);
            } else {
                $(this).val($(this).val());
            }
        });
        $(".form-input").focus().select();
    }

    setTimeout(function () {
        codeAddress();
    }, 2000);

    $("input").click(function () {
        if (!$("form-input").val()) {
            $(".form-input").attr("placeholder", "Search");
        }
    });

</script>
@endsection
@section('css')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/tailwindcss/1.9.2/tailwind.min.css"
    integrity="sha512-l7qZAq1JcXdHei6h2z8h8sMe3NbMrmowhOl+QkP3UhifPpCW2MC4M0i26Y8wYpbz1xD9t61MLT9L1N773dzlOA=="
    crossorigin="anonymous" />
<style>
    .nav-img-logo {
        display: inline !important;
        vertical-align: middle !important;
    }

    @media (min-width: 640px) {
        .sm\:leading-5 {
            line-height: 2.5rem !important;
        }
    }

    @media (min-width: 280px) {
        .sm\:leading-5 {
            line-height: 2.5rem !important;
        }
    }


    .sm\:leading-5 {
        outline-width: 0;
    }

    h2 {
        font-size: 1.2rem;
    }

    ::placeholder {
        color: rgb(160, 0, 0);
        font-size: 1.0em;
    }

    .h-5 span {
        font-size: 1.0em;

    }

    .text-teal-600 {
        font-size: 14px;
        width: 350px;
    }

    @media only screen and (max-width: 361px) {
        .text-teal-600 {
            font-size: 12px;
            align-content: center;
            width: 300px;
        }
    }

    @media only screen and (min-width: 400px) {
        .text-teal-600 {
            font-size: 13px;
            align-content: center;
            width: 350px;
        }
    }

</style>
@endsection
