<style>
    .pay-disabled {
        opacity: 0.4;
        pointer-events: none;
    }

    .img-pg {
        transition: transform .2s;
        height: 80px;
        /* Animation */
    }

    .img-pg:hover {
        transform: scale(0.95);
    }

    .img-pg:active {
        transform: scale(0.8);
    }

    .card-profile-image img {
        position: absolute;
        left: 5%;
        max-width: 140px;
        transition: all .15s ease;
        transform: translate(-50%, -50%) scale(1);
        border: 3px solid #fff;
        border-radius: .575rem;
        background-color: #ececee
    }

    .cc-selector input {
        margin: 0;
        padding: 0;
        -webkit-appearance: none;
        -moz-appearance: none;
        appearance: none;
    }

    .cc-selector-2 input {
        position: absolute;
        z-index: 999;
    }

    .TRN {
        background-image: url("{{asset('MemberArea/images/coin/trn.png')}}");
    }

    .ETH {
        background-image: url("{{asset('MemberArea/images/coin/eth.jpg')}}");
    }

    .BTC {
        background-image: url("{{asset('MemberArea/images/coin/btc.png')}}");
    }

    .cc-selector-2 input:active+.drinkcard-cc,
    .cc-selector input:active+.drinkcard-cc {
        opacity: .9;
    }

    .cc-selector-2 input:checked+.drinkcard-cc,
    .cc-selector input:checked+.drinkcard-cc {
        -webkit-filter: none;
        -moz-filter: none;
        filter: none;
    }

    .drinkcard-cc {
        cursor: pointer;
        background-size: contain;
        background-repeat: no-repeat;
        display: inline-block;
        width: 100px;
        height: 70px;
        -webkit-transition: all 100ms ease-in;
        -moz-transition: all 100ms ease-in;
        transition: all 100ms ease-in;
        -webkit-filter: brightness(1.8) grayscale(1) opacity(.7);
        -moz-filter: brightness(1.8) grayscale(1) opacity(.7);
        filter: brightness(1.8) grayscale(1) opacity(.7);
    }

    .drinkcard-cc:hover {
        -webkit-filter: brightness(1.2) grayscale(.5) opacity(.9);
        -moz-filter: brightness(1.2) grayscale(.5) opacity(.9);
        filter: brightness(1.2) grayscale(.5) opacity(.9);
    }

    .bg-soft-primary-image {
        background-image: url("{{ asset('MemberArea/images/cover.jpg') }}");
        background-repeat: no-repeat;
        background-size: cover;
        height: 200px;
        width: 100%;
    }

    .soax-input {
        font-size: 2rem;
        font-weight: 700;
        text-align: center;
        color: #2d2dc3;
        border: none;
    }

    .soax-input:focus {
        font-size: 2rem;
        font-weight: 700;
        text-align: center;
        color: #2d2dc3;
        background-color: #ececec;
        border: none;
    }

    input::-webkit-outer-spin-button,
    input::-webkit-inner-spin-button {
        /* display: none; <- Crashes Chrome on hover */
        -webkit-appearance: none;
        margin: 0;
        /* <-- Apparently some margin are still there even though it's hidden */
    }

    input[type=number] {
        -moz-appearance: textfield;
        /* Firefox */
    }

    #payment-loader {
        display: none;
        margin-top: 50px;
    }

    #payment-success {
        display: none;
    }

    .text-dark2 {
        color: #5d5d5d;
    }

    .bg-light2 {
        background-color: #ececec;
    }

    #title {
        margin-top: 60px;
    }

    #qrcode {
        padding: 20px;
    }

    #btcAddress {
        font-size: 0.7rem;
        color: #6271b8;
        word-wrap: break-word;
        padding: 20px;
        text-align: center;
    }

    #btcAddress a {
        background-color: #dfdfdf;
        padding: 5px;
    }

    #progressBar {
        width: 104%;
        margin-left: -17px;
        height: 22px;
        margin-top: -1px;
        background-color: #ececec;
        border-radius: 5px;
    }


    #progressBar div {
        height: 100%;
        text-align: right;
        padding: 0 13px;
        line-height: 24px;
        width: 0;
        background-color: #34c38f;
        box-sizing: border-box;
        color: #fff;
        border-top-left-radius: 5px;
        border-top-right-radius: 5px;
        border-bottom-right-radius: 5px;
        box-shadow: 0 1px 3px rgba(0, 0, 0, 0.12), 0 1px 2px rgba(0, 0, 0, 0.24);
    }

    #btcmodalloader {
        background-color: transparent;
        border: transparent;
    }

    #btcmodalbuttons {
        margin-top: 50px;
        background-color: transparent;
        border-color: transparent;
        /* display: none; */
    }

    #btcmodalContent {
        /* display: none; */
    }

</style>
