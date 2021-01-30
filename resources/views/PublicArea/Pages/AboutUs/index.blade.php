@extends('PublicArea.Layouts.app')
@section('title', 'About Us | SOP')
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
        <div class="row clearfix justify-content-center">
            <div class="col-lg-10">
                <div class="sec-title text-center mb-3">
                    <h2>About Us</h2>
                    <div class="decor topdecor">
                    </div>
                </div>
            </div>
            <div class="col-lg-10">
                <p class="h5">
                    The SOP team is comprised of 3 sections – Management Team, Advisory Council, and Partners.
                </p>
                <p class="h6 mt-2">
                    The Advisory Council is the group of passionate individuals that are at the forefronts of their
                    respective fields and help with growing SOP’s global reach. The Advisory Council shares feedback and
                    suggestions on the token platform, as well as the project.
                </p>
                <p class="h6 mt-3">
                    The Partners of the project are companies, manufacturers, and oil well owners that are participating
                    with SOP in various capacities to help grow.
                </p>
                <p class="h6 mt-3">
                    The Management Team is the group that provides general oversight across the entire platform to
                    ensure the project is achieving its stated goals by engaging the right partners and confirming the
                    selection of proper fields for production, right hedges when needed, and the right equipment as and
                    when applicable.
                </p>
            </div>
            <div class="col-lg-10 mt-4">
                <div class="row">
                    <div class="col-lg-12">
                        <h6 class="text-center">Some of the key members of the Management Team are listed below</h6>
                    </div>
                </div>
                <div class="row p-4">
                    <div class="col-lg-4 text-right">
                        <h5 class="" style="margin-top: 18%;"><strong>Will P. Marshall</strong> </h5>
                        <h6 class="mt-0"><code>Survey &amp; Field Management</code> </h6>
                    </div>
                    <div class="col-lg-8">
                        <div class="media-body text-left">
                            <p>
                                One of the founding partners of Sommering International, Mr. Marshall has a 30+ years
                                experience in oil field survey, analysis, and production management. Will interfaces
                                directly with oil well owners, local operators, and manufacturers to ensure a successful
                                transition from antiquated technology to the new green systems that are supported by the
                                Solar Oil Project.
                            </p>
                        </div>
                    </div>
                </div>
                <div class="row p-4">
                    <div class="col-lg-4 text-right">
                        <h5 style="margin-top: 18%;"><strong>JJ Lundell</strong> </h5>
                        <h6 class="mt-0"><code>Acquisitions & Site Relations</code> </h6>
                    </div>
                    <div class="col-lg-8 text-left">
                        <div class="media-body">
                            <p>
                                Mr. Lundell has 25+ years of diversified experience in various aspects of oil
                                production.
                                From initial contact to acquisition and final production, Mr. Lundell has often been
                                relied
                                upon to run lean, profitable operations in the oil and gas industry. Most recently, he
                                completed a successful appointment as Sr VP of Sales for one of the leading oil and gas
                                companies where he managed multi-million dollar properties and accounts. 
                            </p>
                        </div>
                    </div>
                </div>
                <div class="row p-4">
                    <div class="col-lg-4 text-right">
                        <h5 style="margin-top: 18%;"><strong>Bill Papacharalampous</strong> </h5>
                        <h6 class="mt-0"><code>EU Growth and Customer Management</code> </h6>
                    </div>
                    <div class="col-lg-8">
                        <div class="media-body text-left">
                            <p>
                                Bill has served in critical leadership roles in multiple industries including military,
                                public, and private entities. As one of the pioneers of multiple business ventures in
                                Greece, Bill's invaluable relationships and experience in furthering the project in the
                                European markets. Bill works with the Advisory and Development teams to ensure
                                consistent
                                outreach of the Solar Oil Project initiatives. 
                            </p>
                        </div>
                    </div>
                </div>
                <div class="row p-4">
                    <div class="col-lg-4 text-right">
                        <h5 style="margin-top: 18%;"><strong>Matt Lobene</strong> </h5>
                        <h6 class="mt-0"><code>Commodity Trade & Management</code> </h6>
                    </div>
                    <div class="col-lg-8">
                        <div class="media-body text-left">
                            <p>
                                An active Oil & Gas company executive, Mr. Lobene has utilized his experience in
                                multiple
                                large petroleum, diamond and other raw commodity transactions throughout the European,
                                South
                                American and Western African markets.  He has also been in the real estate market for
                                over
                                15 years as a fund-raiser for real estate developers. Mr. Lobene has also been involved
                                in
                                manufacturing various types of business and consumer products both in the United States
                                and
                                overseas.  
                            </p>
                        </div>
                    </div>
                </div>
                <div class="row p-4">
                    <div class="col-lg-4 text-right">
                        <h5 style="margin-top: 18%;"><strong>Andrew Bologne</strong> </h5>
                        <h6 class="mt-0"><code>Logistics and International Relations</code> </h6>
                    </div>
                    <div class="col-lg-8">
                        <div class="media-body tetx-left">
                            <p>
                                Andrew S. Boulogne has 24 years’ experience in trading commodities, Shipping and
                                Logistics.
                                He has spent 16 of those years in countries ranging from South America, Central America,
                                North America and Canada. Mr. Boulogne has capacity for structuring and implementation
                                of
                                complex projects requiring cross border, cultural, and language sensitivity and is
                                fluent in
                                multiple languages including English, French, Spanish and others.
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection

@section('css')
@include('auth.Includes.css')
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

</style>
@endsection
