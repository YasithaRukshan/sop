{{-- <script src="https://cdn.jsdelivr.net/npm/web3@latest/dist/web3.min.js"></script> --}}
<script src="{{ asset('MemberArea/js/jquery-qrcode-0.18.0.min.js') }}"></script>

<script>
    $(document).ready(function () {
        $('#select_oil_portpolio').select2({
            theme: 'bootstrap',
            placeholder: 'Select A Portfolio'
        });
        getConversionRateForFullAmount();
    })

    function submitPayment(type) {
        $('#errorMsg').html("");
        if (validateInput()) {
            loader(true);
            startProcess(type);
        } else {
            loader(false);
        }
    }

    function validateInput() {
        getConversionRateForFullAmount();
        if (parseFloat($('#inp_soax_amount').val()) >= parseFloat('{{ config("payments.minimum_soax") }}')) {
            showInputStatus()
            return true;
        } else {
            showInputStatus("min");
            return false;
        }
    }
    /*
     * Show Validation errors
     */
    function showInputStatus(resp = "") {
        switch (resp) {
            case 'min':
                $('#inp_soax_amount_resp').html(
                    'Minimum SOAX amount must be greater than or equal to {{ config("payments.minimum_soax") }}');
                $('#inp_soax_amount').addClass('parsley-error');
                $('#inp_soax_amount_resp').fadeIn();
                break;
            default:
                $('#inp_soax_amount_resp').html('');
                $('#inp_soax_amount').removeClass('parsley-error');
                $('#inp_soax_amount_resp').fadeOut();
                break;
        }
    }
    /*
     * Start Payment Process
     */
    function startProcess(type) {
        data = {
            depkey: getLst('depkey'),
            amount: $('#inp_soax_amount').val(),
            type: type,
        };
        $.ajax({
            url: "{{ route('wallet.transactions.store') }}",
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            type: 'POST',
            data: data,
            success: function (response) {
                setLst('depkey', response['depkey']);
                switch (type) {
                    case parseInt("{{ $tc->WTTYPE('ETH') }}"):
                        validateEthAndContinue(response);
                        break;
                    case parseInt("{{ $tc->WTTYPE('BTC') }}"):
                        validateBtcAndContinue(response);
                        break;
                    case parseInt("{{ $tc->WTTYPE('CAPP') }}"):
                        validateCAppAndContinue(response);
                        break;
                    case parseInt("{{ $tc->WTTYPE('ZELLE') }}"):
                        validateZelleAndContinue(response);
                        break;
                    default:
                        $.alert('Oops Something Went Wrong');
                }
            }
        });
    }
    /*
     * Validate ETh Process And Continue
     */
    function validateEthAndContinue(response) {
        EThAppDeploy.loadWeb3(response);

    }


    function sendCallbackOnInvestSuccess(rdata) {

        $.ajax({
            url: "{{ route('wallet.transactions.store.callback.eth') }}",
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            type: 'POST',
            data: rdata,
            datatype: 'html',
            success: function (response) {
                showResponseAndRedieection(response);
            }
        });
    }

    function showResponseAndRedieection(response) {
        loader(true);
        $('#payment-loader').html(response);
        setTimeout(function () {
            window.location = '{{ route("dashboard") }}';
        }, 2500);
    }

    function metamaskError(code) {
        switch (code) {
            case 4001:
                error("User denied transaction signature");
                break;

            default:
                error("Something Went Wrong. Try again " + resp.code);
                break;
        }
    }

    function error(message) {
        msg = '<div class="alert alert-danger alert-dismissible zoomIn show" role="alert">' +
            '<h4 class="alert-heading"><i class="mdi mdi-block-helper mr-2"></i> Oops!</h4>' +
            '<button type="button" class="close" data-dismiss="alert" aria-label="Close">' +
            '<span aria-hidden="true">×</span>' +
            '</button>' +
            '<p>' + message + '</p>' +
            '</div>';

        $('#errorMsg').html(msg);
        $('.alert').alert();
    }

    function loader(action) {
        if (action == true) {
            $('#payment-buttons').fadeOut();
            $('#payment-loader').fadeIn();
        } else {
            $('#payment-buttons').fadeIn();
            $('#payment-loader').fadeOut();
        }
    }

    function getConversionRateForFullAmount() {
        $('#ethamount').html(smLoader());
        $('#btcamount').html(smLoader());
        $('.cappamount').html(smLoader());
        $('.zelloamount').html(smLoader());
        $.ajax({
            url: "{{ route('wallet.transactions.conversionRates.real') }}",
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            type: 'GET',
            data: {
                soax: parseFloat($('#inp_soax_amount').val()),
            },
            dataType: 'json',
            success: function (response) {
                $('#ethamount').html('' + response.eth.toFixed(8) + ' ETH');
                $('#btcamount').html('' + response.btc.toFixed(8) + ' BTC');
                $('.cappamount').html('' + (response.capp.toFixed(2)) + ' USD');
                $('.zelloamount').html('' + (response.zello.toFixed(2)) + ' USD');
            }
        });
    }

    function smLoader() {
        return '<div class="spinner-border spinner-border-sm" role="status">' +
            '<span class="sr-only">Loading...</span>' +
            '</div>';
    }

</script>
