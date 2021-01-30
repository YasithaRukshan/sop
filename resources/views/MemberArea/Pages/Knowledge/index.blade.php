@extends('MemberArea.Layouts.app')
@section('title', 'Knowledge Base | SOP')
@section('ogtitle', 'Knowledge Base | SOP')
@section('header')

<div class="row  py-4">
    <div class="col-12">
        <div class="page-title-box d-flex align-items-center justify-content-between">
            <div class="col-lg-6 col-12">
                <h6 class="h2 text-dark d-inline-block mb-0">Knowledge Base</h6>
                <nav aria-label="breadcrumb" class="d-none d-md-block mt-2">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="{{ route('dashboard') }}"><i class="bx bx-home"></i></a>
                        </li>
                        <li class="breadcrumb-item active" aria-current="page">Knowledge Base</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
</div>
@endsection
@section('content')
<div class="row">
    <div class="col-12">
        <ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">
            <li class="nav-item bg-white shadow" role="presentation">
                <a class="nav-link active" id="pills-getting-start-tab" data-toggle="pill" href="#pills-getting-start"
                    role="tab" aria-controls="pills-getting-start" aria-selected="true">
                    <span class="d-block d-sm-none"><i class="fas fa-hourglass-end"></i></span>
                    <span class="d-none d-sm-block"><i class="fas fa-hourglass-end"></i> Getting Started
                    </span>
                </a>
            </li>
            <li class="nav-item bg-white shadow ml-lg-4 ml-2" role="presentation">
                <a class="nav-link" id="pills-Payment-tab" data-toggle="pill" href="#pills-Payment" role="tab"
                    aria-controls="pills-Payment" aria-selected="true">
                    <span class="d-block d-sm-none"><i class="fas fa-money-bill"></i></span>
                    <span class="d-none d-sm-block"><i class="fas fa-money-bill"></i> Payment FAQs
                    </span>
                </a>
            </li>
            <li class="nav-item" role="presentation">
                <a class="nav-link bg-white shadow ml-lg-4 ml-2" id="pills-Redemption-tab" data-toggle="pill"
                    href="#pills-Redemption" role="tab" aria-controls="pills-Redemption"
                    aria-selected="false">
                    <span class="d-block d-sm-none"><i class="bx bx-money"></i></span>
                    <span class="d-none d-sm-block"><i class="bx bx-money"></i> Redemption FAQs
                    </span>
                </a>
            </li>
            <li class="nav-item " role="presentation">
                <a class="nav-link bg-white shadow ml-lg-4 ml-2" id="pills-Project-tab" data-toggle="pill" href="#pills-Project"
                    role="tab" aria-controls="pills-Project" aria-selected="false">
                    <span class="d-block d-sm-none"><i class="fas fa-project-diagram"></i></span>
                    <span class="d-none d-sm-block"><i class="fas fa-project-diagram"></i> Project FAQs
                    </span>
                </a>
            </li>
            <li class="nav-item" role="presentation">
                <a class="nav-link bg-white shadow ml-lg-4 ml-2" id="pills-Referral-tab" data-toggle="pill"
                    href="#pills-Referral" role="tab" aria-controls="pills-Referral" aria-selected="false">
                    <span class="d-block d-sm-none"><i class="fas fa-award"></i></span>
                    <span class="d-none d-sm-block"><i class="fas fa-award"></i> Referral FAQs
                    </span>
                </a>
            </li>
        </ul>
    </div>
</div>
<div class="tab-content" id="pills-tabContent">
    <div class="tab-pane fade show active" id="pills-getting-start" role="tabpanel"
        aria-labelledby="pills-getting-start-tab">
        <div class="accordion" id="accordionGettingStart">
            <div class="card">
                <div class="card-header" id="headingGettingStartOne">
                    <h2 class="mb-0 h2">
                        <button class="btn btn-link btn-block text-left" type="button" data-toggle="collapse"
                            data-target="#collapseGettingStartOne" aria-expanded="true"
                            aria-controls="collapseGettingStartOne">
                            How to Purchase SOAX with Bitcoin?
                        </button>
                    </h2>
                </div>
                <div id="collapseGettingStartOne" class="collapse show" aria-labelledby="headingGettingStartOne"
                    data-parent="#accordionGettingStart">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-lg-12">
                                <iframe class="w-100" height="400" src="https://player.vimeo.com/video/497560618"
                                    allowfullscreen>
                                </iframe>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card">
                <div class="card-header" id="headingGettingStartTwo">
                    <h2 class="mb-0 h2">
                        <button class="btn btn-link btn-block text-left" type="button" data-toggle="collapse"
                            data-target="#collapseGettingStartTwo" aria-expanded="false"
                            aria-controls="collapseGettingStartTwo">
                            How to Purchase SOAX with ETH?
                        </button>
                    </h2>
                </div>
                <div id="collapseGettingStartTwo" class="collapse" aria-labelledby="headingGettingStartTwo"
                    data-parent="#accordionGettingStart">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-lg-12">
                                <iframe class="w-100" height="400" src="https://player.vimeo.com/video/497560825"
                                    allowfullscreen>
                                </iframe>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card">
                <div class="card-header" id="headingGettingStartThree">
                    <h2 class="mb-0 h2">
                        <button class="btn btn-link btn-block text-left" type="button" data-toggle="collapse"
                            data-target="#collapseGettingStartThree" aria-expanded="false"
                            aria-controls="collapseGettingStartThree">
                            How to Set up MetaMask?
                        </button>
                    </h2>
                </div>
                <div id="collapseGettingStartThree" class="collapse" aria-labelledby="headingGettingStartThree"
                    data-parent="#accordionGettingStart">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-lg-12">
                                <iframe class="w-100" height="400" src="https://player.vimeo.com/video/497561073"
                                    allowfullscreen>
                                </iframe>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card">
                <div class="card-header" id="headingGettingStartFour">
                    <h2 class="mb-0 h2">
                        <button class="btn btn-link btn-block text-left" type="button" data-toggle="collapse"
                            data-target="#collapseGettingStartFour" aria-expanded="false"
                            aria-controls="collapseGettingStartFour">
                            How to Set up Bitpay?
                        </button>
                    </h2>
                </div>
                <div id="collapseGettingStartFour" class="collapse" aria-labelledby="headingGettingStartFour"
                    data-parent="#accordionGettingStart">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-lg-12">
                                <iframe class="w-100" height="400" src="https://player.vimeo.com/video/497561213"
                                    allowfullscreen>
                                </iframe>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card">
                <div class="card-header" id="headingGettingStartFive">
                    <h2 class="mb-0 h2">
                        <button class="btn btn-link btn-block text-left" type="button" data-toggle="collapse"
                            data-target="#collapseGettingStartFive" aria-expanded="false"
                            aria-controls="collapseGettingStartFive">
                            How to Share your SOP Link?
                        </button>
                    </h2>
                </div>
                <div id="collapseGettingStartFive" class="collapse" aria-labelledby="headingGettingStartFive"
                    data-parent="#accordionGettingStart">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-lg-12">
                                <iframe class="w-100" height="400" src="https://player.vimeo.com/video/497561806"
                                    allowfullscreen>
                                </iframe>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="tab-pane fade" id="pills-Payment" role="tabpanel" aria-labelledby="pills-Payment-tab">
        <div id="accordion">
            <div class="card">
                <div class="card-header" id="headingPaymentOne">
                    <h2 class="mb-0">
                        <button class="btn btn-link" data-toggle="collapse" data-target="#collapsePaymentOne"
                            aria-expanded="true" aria-controls="collapsePaymentOne">
                            How do I purchase new SOAX tokens?
                        </button>
                    </h2>
                </div>

                <div id="collapsePaymentOne" class="collapse show" aria-labelledby="headingPaymentOne"
                    data-parent="#accordion">
                    <div class="card-body">
                        Please select the 'Add More SOAX' option on the top right OR the 'Add SOAX' button
                        on the Dashboard, or the "Add SOAX' option on the 'My Wallet' page. You may make
                        payments with BTC or ETH.
                    </div>
                </div>
            </div>

            <div class="card">
                <div class="card-header" id="headingPaymentTwo">
                    <h2 class="mb-0">
                        <button class="btn btn-link" data-toggle="collapse" data-target="#collapsePaymentTwo"
                            aria-expanded="false" aria-controls="collapsePaymentTwo">
                            I made a BTC payment but it is not reflected in my account. What happened?
                        </button>
                    </h2>
                </div>

                <div id="collapsePaymentTwo" class="collapse" aria-labelledby="headingPaymentTwo"
                    data-parent="#accordion">
                    <div class="card-body">
                        A BTC transaction is reflected as 'Pending' from the moment the payment is first
                        attempted - when you visit the Checkout for SOAX tokens).
                        <br><br>
                        If the payment is not made in the 15 minute time window, this will change to
                        Expired. <br>
                        If the payment is made during that time, it will now begin the Confirmation process.
                        <br>
                        Please note that BTC payments may take a few hours to be confirmed based on the
                        blockchain.
                        <br>
                        <br>
                        Finally, please ensure that your BTC payment exactly matches the BTC amount shown in
                        the invoice. If your payment differs (which may occur if your sending wallet is
                        deducting extra fees) then the payment might stay Pending for extra duration. If you
                        believe this is the case, please reach out to the support staff and we might be able
                        to confirm the payment manually.
                    </div>
                </div>
            </div>

            <div class="card">
                <div class="card-header" id="headingPaymentThree">
                    <h2 class="mb-0">
                        <button class="btn btn-link" data-toggle="collapse" data-target="#collapsePaymentThree"
                            aria-expanded="false" aria-controls="collapsePaymentThree">
                            I made an ETH payment but it is not reflected in my account. What happened?
                        </button>
                    </h2>
                </div>

                <div id="collapsePaymentThree" class="collapse" aria-labelledby="headingPaymentThree"
                    data-parent="#accordion">
                    <div class="card-body">
                        ETH payments are usually confirmed and completed in under 5 minutes (often in a few
                        seconds).
                        If you completed the payment via MetaMask, but are not seeing it reflected in your
                        account (or are just seeing the 'Pending' status), then there are 3 possibilities:
                        <br>
                        1. You may have not confirmed the payment send from your wallet. MetaMask requires a
                        second 'Confirmation' from the sender before the payment actually leaves the wallet.
                        In this case, the payment should still be in your wallet.
                        <br>
                        2. You may have closed the MetaMask extension prompt or exited the Solar Oil Project
                        website before the transaction could be initiated. In this case, the payment should
                        still be in your wallet.
                        <br>
                        3. You may have loaded multiple instances of MetaMask, interacted with other sites
                        with MetaMask, or may have a 'masking' malware on your device. In these instances,
                        the payment have left your wallet but been sent to a different vendor or been sent
                        to a malicious receipient. In these instances, your transaction may be lost.
                        <br><br>
                        If you believe none of the above is the cause and your transaction was successful,
                        please submit the transaction Hash from etherscan and we may be able to help you
                        locate the payment.
                    </div>
                </div>
            </div>

            <div class="card">
                <div class="card-header" id="headingPaymentFour">
                    <h2 class="mb-0">
                        <button class="btn btn-link" data-toggle="collapse" data-target="#collapsePaymentFour"
                            aria-expanded="false" aria-controls="collapsePaymentFour">
                            How do I Stake the SOAX tokens?
                        </button>
                    </h2>
                </div>

                <div id="collapsePaymentFour" class="collapse" aria-labelledby="headingPaymentFour"
                    data-parent="#accordion">
                    <div class="card-body">
                        Please click on the 'Staking' page in the main menu, and then click on 'Add Staking
                        Contract'. On the next page, please select a Portfolio from the dropdown. This will
                        take you to the Portfolio description page. Here, you may enter the number of SOAX
                        tokens you wish to stake.
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="tab-pane fade" id="pills-Redemption" role="tabpanel" aria-labelledby="pills-Redemption-tab">
        <div class="accordion" id="accordionRedemption">
            <div class="card">
                <div class="card-header" id="headingRedemptionOne">
                    <h2 class="mb-0 h2">
                        <button class="btn btn-link btn-block text-left" type="button" data-toggle="collapse"
                            data-target="#collapseRedemptionOne" aria-expanded="true"
                            aria-controls="collapseRedemptionOne">
                            I staked my SOAX, but I don't see any SOPX tokens in production. Why?
                        </button>
                    </h2>
                </div>

                <div id="collapseRedemptionOne" class="collapse show" aria-labelledby="headingRedemptionOne"
                    data-parent="#accordionRedemption">
                    <div class="card-body">
                        <p>
                            SOPX token issuance occurs approximately 48 hours after the staking. For example, if
                            you
                            staked on a Monday, then you will see the first SOPX production on that contract on
                            the
                            following Wednesday.

                        </p>
                        <p>SOPX issuance occurs between 6am and 10am UTC.
                        </p>
                    </div>
                </div>
            </div>
            <div class="card">
                <div class="card-header" id="headingRedemptionTwo">
                    <h2 class="mb-0 h2">
                        <button class="btn btn-link btn-block text-left collapsed" type="button" data-toggle="collapse"
                            data-target="#collapseRedemptionTwo" aria-expanded="false"
                            aria-controls="collapseRedemptionTwo">
                            I received some production, but I don't see any SOPX in my Available balance. Why?
                        </button>
                    </h2>
                </div>
                <div id="collapseRedemptionTwo" class="collapse" aria-labelledby="headingRedemptionTwo"
                    data-parent="#accordionRedemption">
                    <div class="card-body">
                        <p>
                            SOPX is issued consistently against the staking contracts, but is only displayed as
                            Available balance once you reach 0.25 SOPX in accumulated issuance.
                        </p>
                    </div>
                </div>
            </div>
            <div class="card">
                <div class="card-header" id="headingRedemptionThree">
                    <h2 class="mb-0 h2">
                        <button class="btn btn-link btn-block text-left collapsed" type="button" data-toggle="collapse"
                            data-target="#collapseRedemptionThree" aria-expanded="false"
                            aria-controls="collapseRedemptionThree">
                            I want to automatically purchase and stake more SOAX tokens with my SOPX issuance.
                            How do I
                            do this?
                        </button>
                    </h2>
                </div>
                <div id="collapseRedemptionThree" class="collapse" aria-labelledby="headingRedemptionThree"
                    data-parent="#accordionRedemption">
                    <div class="card-body">
                        <p> Please go to Redemption > Settings page in the left side menu. Now toggle on the
                            option to
                            auto-purchase SOAX tokens, and use the slider to select what percentage of your SOPX
                            you
                            would like to convert to SOAX.
                        </p>
                        <p>
                            Note that SOPX will only convert once at least 0.25 SOPX has accumulated and SOAX
                            will only
                            be staked in a contract once at least 200 SOAX is available to stake.
                        </p>
                    </div>
                </div>
            </div>
            <div class="card">
                <div class="card-header" id="headingRedemptionFour">
                    <h2 class="mb-0 h2">
                        <button class="btn btn-link btn-block text-left collapsed" type="button" data-toggle="collapse"
                            data-target="#collapseRedemptionFour" aria-expanded="false"
                            aria-controls="collapseRedemptionFour">
                            What is the value of my SOPX tokens?
                        </button>
                    </h2>
                </div>
                <div id="collapseRedemptionFour" class="collapse" aria-labelledby="headingRedemptionFour"
                    data-parent="#accordionRedemption">
                    <div class="card-body">
                        The value of SOPX tokens is determined by current WTI Crude price and is always WTI
                        price minus
                        $18 USD.
                        You can see this value on the Redemptions > New Redemption page.
                    </div>
                </div>
            </div>
            <div class="card">
                <div class="card-header" id="headingRedemptionFive">
                    <h2 class="mb-0 h2">
                        <button class="btn btn-link btn-block text-left collapsed" type="button" data-toggle="collapse"
                            data-target="#collapseRedemptionFive" aria-expanded="false"
                            aria-controls="collapseRedemptionFive">
                            I entered a request to convert my SOPX holdings to ETH or BTC. When will I receive
                            this?
                        </button>
                    </h2>
                </div>
                <div id="collapseRedemptionFive" class="collapse" aria-labelledby="headingRedemptionFive"
                    data-parent="#accordionRedemption">
                    <div class="card-body">
                        Once you have at least 0.25 SOPX available in holdings, you can request conversion to
                        ETH or BTC
                        and withdraw the tokens. This request may take up to 48 business hours for new accounts
                        and up
                        to 24 business hours for accounts with at least a 30 day history and 2FA security
                        enabled.
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="tab-pane fade" id="pills-Project" role="tabpanel" aria-labelledby="pills-Project-tab">
        <h6 class="text-left mt-4 text-warning">Coming Soon</h6>
    </div>

    <div class="tab-pane fade" id="pills-Referral" role="tabpanel" aria-labelledby="pills-Referral-tab">
        <h6 class="text-left mt-4 text-warning">Coming Soon</h6>
    </div>
</div>
@endsection

@push('css')
<style>
    .card-header {
        background-color: #ececec;
        border-color: #ececec;
    }

    .nav-pills .nav-link.active,
    .nav-pills .show>.nav-link {
        color: #fff !important;
        background-color: #556ee6 !important;
        ;
    }

    .btn-link {
        font-size: 1.2rem;
    }

    .card-body {
        font-size: 1rem;
    }

</style>
@endpush
