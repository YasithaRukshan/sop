<script>
    function validateCAppAndContinue(data) {
        $('#cashAppModalId').modal({
            backdrop: 'static',
            keyboard: false
        });
    }

    function completeCAppPayment() {
        if (confirm('Make sure you correctly followed step 2 before clicking this button')) {
            $.ajax({
                url: "{{ route('wallet.transactions.capp.callback.validate') }}",
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                type: 'POST',
                data: {
                    depkey: getLst('depkey'),
                },
                success: function (response) {
                    if (response.status == true) {
                        alertSuccess("Payment Sucess Your Will Redirect To Transactions Page Now");
                        loader(true);
                        $('#payment-loader').html(paymentSuccess());
                        setTimeout(function () {
                            window.location = '{{ route("wallet.purchase") }}';
                        }, 5000);
                    } else {
                        loader(false);
                    }
                    $('#cashAppModalId').modal('hide');
                }
            });
        }
    }

    function cancelCAppPayment() {
        loader(false);
        $('#cashAppModalId').modal('hide');
    }

</script>
