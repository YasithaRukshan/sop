@extends('MemberArea.Layouts.app')
@section('title', 'Social Impacts | SOP')
@section('header')
<div class="row  py-4 {{ $tc->isStaked()?"":"uvbb" }}">
    <div class="col-12">
        <div class="page-title-box d-flex align-items-center justify-content-between">
            <div class="col-lg-12 col-12">
                <h6 class="h2 text-dark d-inline-block mb-0">Your Social Impact</h6>
                <nav aria-label="breadcrumb" class="d-none d-md-block mt-2">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="{{ route('dashboard') }}"><i class="bx bx-home"></i></a>
                        </li>
                        <li class="breadcrumb-item active" aria-current="page">Your Social Impact</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
</div>
@endsection
@section('content')
@if (!$tc->isStaked())
<div class="uvbb_ovl">
    <div class="row justify-content-center">
        <card class="col-lg-8">
            <div class="card h-100 w-100">
                <div class="card-body text-center">
                    <h5>Your Social Impact Tracking option is only available to <a
                            href="{{ route('contracts.create') }}"><strong
                                class="text-danger">Stakeholders</strong></a>. <br>
                        Please <a href="{{ route('contracts.create') }}">create your first Staking Contract</a> to
                        access this
                        page.</h5>
                </div>
            </div>
        </card>
    </div>
</div>
@endif
<div class="container-fluid {{ $tc->isStaked()?"":"uvbb" }}">
    <div class="row">
        <div class="col-xl-4">
            <div class="card">
                <div class="card-body border-top posRel">
                    <div class="row mh-100">
                        <div class="col-8 h-100">
                            <div class="row h-100">
                                <div class="col-12">
                                    <h5 class="text-muted">Total Rewards</h5>
                                    <h4 class="h4">
                                        {!! $tc->ethPan($tc->rewardTotal()) !!}
                                    </h4>
                                </div>
                                <div class="col-12 align-self-end">
                                </div>
                            </div>
                        </div>
                        <div class="col-4">
                            <i class="fas fa-dice fa-4x  text-primary"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-4">
            <div class="card">
                <div class="card-body border-top posRel">
                    <div class="row mh-100">
                        <div class="col-8 h-100">
                            <div class="row h-100">
                                <div class="col-12">
                                    <h5 class="text-muted"> Available Rewards</h5>
                                    <h4 class="h4">
                                        {!! $tc->ethPan($tc->currentRewards()) !!}
                                    </h4>
                                </div>
                                <div class="col-12 align-self-end">
                                    <a href="{{ route('social.redemptions.create') }}" class="btn btn-dark btn-sm mt-4">
                                        <i class="fas fa-plus-circle"></i> Redeem Now</a>
                                </div>
                            </div>
                        </div>
                        <div class="col-4">
                            <i class="fas fa-pizza-slice fa-4x text-success"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-4">
            <div class="card">
                <div class="card-body border-top posRel">
                    <div class="row mh-100">
                        <div class="col-8 h-100">
                            <div class="row h-100">
                                <div class="col-12">
                                    <h5 class="text-muted">Redeemed Rewards</h5>
                                    <h4 class="h4">
                                        {!! $tc->ethPan($tc->redemptionRewards()) !!}
                                    </h4>
                                </div>
                                <div class="col-12 align-self-end">
                                    <a href="{{ route('social.transactions') }}" class="btn btn-dark btn-sm mt-4">
                                        <i class="fas fa-clipboard-list"></i> Redeem logs</a>
                                </div>
                            </div>
                        </div>
                        <div class="col-4">
                            <i class="fas fa-file-invoice fa-4x text-danger"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-12">
            <p>
                Social Impact Rewards are special achievements that are assigned to influencers that help create the
                greatest environmental impact across their social networks.
            </p>
            <p>
                <a data-toggle="collapse" href="#learnMoreCollaps" role="button" aria-expanded="false"
                    aria-controls="learnMoreCollaps">
                    Learn More <i class="fas fa-chevron-right"></i>
                </a>
            </p>
            <div class="collapse" id="learnMoreCollaps">
                <div class="card card-body">

                    <p>
                        The 3 primary categories currently tracked are Carbon Offsets, Grid Energy Offset and Job
                        Creation.
                    </p>
                    <ul>
                        <li>
                            <strong>Carbon Offset:</strong> The increased efficiencies and carbon offsets produce
                            roughly 257 metric tons of
                            carbon offsets for approx. 300,000 barrels of oil across 10 years. For every .25 metric tons
                            of
                            carbon offset, the 'Carbon Warrior' Achievement is triggered.
                        </li>
                        <li>
                            <strong>Grid Offset:</strong> For every 1MW of energy offset from the grid (through a
                            combination of lowered
                            electric consumption and through solar panel offsets), the 'Energetic' achievement is
                            triggered.
                        </li>
                        <li>
                            <strong>Job Creation:</strong> Based on the OIGCC standards for economic impact and job
                            creation, the impact of
                            all the oil well rehab work is tracked. For every 0.1 Job created, 'The Creator' achievement
                            is
                            rewarded.
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    @include('MemberArea.Pages.SocialImpact.Components.collectAll')
    @include('MemberArea.Pages.SocialImpact.Components.SocialImpact')
</div>
@endsection
@section('css')
@include('MemberArea.Pages.SocialImpact.Includes.css')
<style>
    h3.gf-title {
        padding: 4px;
        width: fit-content;
    }

</style>
@endsection

@section('js')
@include('MemberArea.Pages.SocialImpact.Includes.scripts')

<script>
    $(function () {
        $(document).scroll(function () {
            var $nav = $(".main-header");
            $nav.toggleClass('mbnScrolled', $(this).scrollTop() < $nav.height());
        });
    });

    //Mobile Nav Hide Show
    if ($('.mobile-menu').length) {
        //Menu Toggle Btn
        $('.navigation').on('click', function () {
            $('body').removeClass('mobile-menu-visible');
        });
    }

</script>
<script>


</script>
@endsection
