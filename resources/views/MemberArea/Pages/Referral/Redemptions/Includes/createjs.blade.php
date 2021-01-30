<script>
    Livewire.on('dataSet', dataSet => {
        wirteData = wirteData + 1;
        if (wirteData == countData) {
            $('.spinner1').fadeOut();
            $('#sub-btn').prop('disabled', false);
            var acc_type = checkAcctype();
            // $("#btcValue").html(dataSet.btcValue);
            $("#ethValue").html(dataSet.ethValue);
            $("#soaxValueSet").html(parseInt(dataSet.soaxValue));
            $("#setSopxValue").html(dataSet.sopxAmount);
            $("#usdToEthValue").html(maxEthValue);
            $("#setMaxAmount").html(maxEthValue);
            $('#address').val(new_address)
            $('#inp_amount').val(dataSet.ethValue)
            $("#withOutFeeUsd").html('(' + nameNumber(dataSet.usdValue) + ')');
            $("#feeUsd").html('(' + nameNumber(dataSet.handlingFee.usd_fee) + ')');
            $("#withFeeUsd").html('(' + nameNumber((parseFloat(dataSet.usdValue) - parseFloat(dataSet
                .handlingFee.usd_fee))) + ')');
            if (acc_type == 1) {
                // $("#requestValue").html('BTC ' + dataSet.btcValue);
                // $('#redemptionAmount').val(dataSet.btcValue)
            } else if (acc_type == 2) {
                $("#requestValue").html('ETH <b>' + parseFloat(dataSet.ethValue).toFixed(8) + '</b>');
                $("#handlingFee").html('ETH <b>' + parseFloat(dataSet.handlingFee.fee).toFixed(8) + '</b>');
                allfee = (parseFloat(dataSet.ethValue) - parseFloat(dataSet.handlingFee.fee));
                $("#allfee").html('ETH  <b>' + (allfee).toFixed(8) + '</b>');
            } else if (acc_type == 3) {
                $('#redemptionAmount').val(dataSet.soaxValue)
            }
            sttAccType();
        } else {
            $('#address').val(new_address)
            $('#inp_amount').val(new_amount)
            $("#usdToEthValue").html(maxEthValue);
            $("#setMaxAmount").html(maxEthValue);
            setInputLoader();
            $('#sub-btn').prop('disabled', true);
        }
    })

    function setInputLoader() {
        $('#loader').html(
            '<div class="text-center"> <div class="spinner1 spinner-border" role="status"> <span class="sr-only">Loading...</span> </div> </div>'
        );
        // $("#btcValue").html(
        //     '<div class="spinner-border btcValue spinner-border-sm" role="status"> <span class="sr-only">Loading...</span> </div>'
        // );
        $("#ethValue").html(
            '<div class="spinner-border ethValue spinner-border-sm" role="status"> <span class="sr-only">Loading...</span> </div>'
        );
        $("#soaxValueSet").html(
            '<div class="spinner-border soaxValueSet spinner-border-sm" role="status"> <span class="sr-only">Loading...</span> </div>'
        );
    }

    function checkAcctype() {
        if (($("#inlineRadio1").is(":checked"))) {
            return 1;
        } else if (($("#inlineRadio2").is(":checked"))) {
            return 2;
        } else if (($("#inlineRadio3").is(":checked"))) {
            return 3;
        }
    }

    $.validator.addMethod("greaterThan", function (value, element) {
        var new_amount = value;
        if (new_amount > redeem_min_value) {
            return true;
        } else {
            return false;
        }
    });

    $.validator.addMethod("requiredAddress", function (value, element) {
        var acc_type = checkAcctype();
        var address = document.getElementById("address").value;
        if (acc_type == 3) {
            return true;
        } else {
            if (address) {
                return true;
            } else {

                return false;
            }
        }
    });
    $(function () {
        $("#referralRedemptionsStore").validate({
            rules: {
                amount: {
                    required: true,
                    max: maxEthValue,
                    greaterThan: true
                },
                address: {
                    requiredAddress: true,
                }
            },
            messages: {
                amount: {
                    required: "Please enter amount.",
                    max: "Please enter a value less than current balance.",
                    greaterThan: "Please enter a value greater than " + redeem_min_value
                },
                address: {
                    requiredAddress: "Please enter address."
                }
            },
            submitHandler: function (form) {
                setLoader('#sub-btn', '#loader')
                form.submit();
            }
        });
    });

    function nameNumber(number) {
        return new Intl.NumberFormat('en-US', {
            style: 'currency',
            currency: 'USD'
        }).format(number)
    }

    function copyAmount(id) {
        $('#' + id).val(maxEthValue);
        getValueCurrency();
    }

</script>
