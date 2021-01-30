<script>
    function validateZelleAndContinue(data) {
        $('#zelleModalId').modal({
            backdrop: 'static',
            keyboard: false
        });
    }

    function completeZellePayment() {
    if (confirm('Make sure you correctly followed step 2 before clicking this button')) {
            $.ajax({
                url: "{{ route('wallet.transactions.zelle.callback.validate') }}",
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
                    $('#zelleModalId').modal('hide');
                }
            });
        }
    }

    function cancelZellePayment() {
        loader(false);
        $('#zelleModalId').modal('hide');
    }

</script>
