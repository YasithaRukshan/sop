<script src="{{ config('btcPasyServer.url') }}/modal/btcpay.js"></script>
<script>
    BTCAppDeploy = {
        runBtc: async (data) => {
            const axClient = axios.create({
                baseURL: '{{ config("btcPasyServer.url") }}',
                timeout: 5000,
                responseType: 'json',
                headers: {
                    'Content-Type': 'application/json',
                    'Authorization': data.authorization,
                }
            });
            const invoiceCreation = {
                "price": data.usd,
                "currency": "USD",
                "orderId": data.id,
                "itemDesc": "Purchasing SOAX " + data.amount + " From {{ route('/') }}",
                "itemCode": "SOAX " + data.amount,
                "notificationUrl": "{{ route('wallet.transactions.store.callback.btc') }}",
                "redirectURL": "{{ route('wallet.purchase') }}",
                "buyerName": "{{ Auth::user()->first_name }} {{ Auth::user()->last_name }}",
                "buyerEmail": "{{ Auth::user()->email }}",
            };
            const response = await axClient.post("/invoices", invoiceCreation);
            const invoiceId = response.data.data.id;
            storeInvoiseBeforeStart(invoiceId, data);
            window.btcpay.onModalReceiveMessage(function (res) {
                validateAction(res, data);
            });
        },
    }

    function storeInvoiseBeforeStart(invoiceId, data) {
        loader(true);
        $.ajax({
            url: "{{ route('wallet.transactions.store.invoice') }}",
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            type: 'POST',
            data: {
                invoice: invoiceId,
                trId: data.id,
            },
            success: function (response) {
                window.btcpay.showInvoice(invoiceId);
            }
        });

    }

    function validateAction(res, oddata) {
        var data = res.data;
        if (data != "loaded") {
            data.odid = oddata.id;
            valdateBtcRespAndContinue(data);
        }
    }

    function valdateBtcRespAndContinue(data) {
        loader(true);
        $.ajax({
            url: "{{ route('wallet.transactions.btc.callback.validate') }}",
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            type: 'POST',
            data: data,
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
            }
        });
    }

    function paymentSuccess() {
        return '<div class="col-lg-12">' +
            '<h2 class="text-center text-success"> <strong>Transaction Success</strong> </h2>' +
            '<h6 class="text-center text-muted">' +
            '<small>You Are Redirecting To Wallet Page Now</small>' +
            ' <div class="spinner-border text-info spinner-border-sm" role="status">' +
            ' <span class="sr-only">Loading...</span>' +
            ' </div>' +
            '</h6>' +
            '</div>';
    }

    function validateBtcAndContinue(data) {
        BTCAppDeploy.runBtc(data);
    }

</script>
