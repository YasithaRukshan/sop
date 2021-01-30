@stack('scripts')
<script>
    Livewire.on('dataSet', dataSet => {
        wirteData = wirteData + 1;
        if (wirteData == countData) {
            $('.spinner1').fadeOut();
            $('#sub-btn').prop('disabled', false);

            var acc_type = checkAcctype();
            $("#btcValue").html(dataSet.btcValue);
            $("#ethValue").html(dataSet.ethValue);
            $("#soaxValueSet").html(parseInt(dataSet.soaxValue));
            $("#setSopxValue").html('SOPX ' + dataSet.sopxAmount);
            $("#setUSDValue").html('(' + nameNumber(dataSet.usdValue) + ')');
            $("#withOutFeeUsd").html('(' + nameNumber(dataSet.usdValue) + ')');
            $("#feeUsd").html('(' + nameNumber(dataSet.handlingFee.usd_fee) + ')');
            $("#withFeeUsd").html('(' + nameNumber((parseFloat(dataSet.usdValue) - parseFloat(dataSet
                .handlingFee
                .usd_fee))) + ')');

            switch (acc_type) {
                case 1:
                    // $("#requestValue").html('BTC ' + dataSet.btcValue);
                    // $("#handlingFee").html('BTC ' + dataSet.handlingFee.fee);
                    // $("#allfee").html('BTC ' + ((parseFloat(dataSet.btcValue) - parseFloat(dataSet.handlingFee
                    // .fee))));
                    break;
                case 2:
                    $("#requestValue").html('ETH <b>' + (dataSet.ethValue.toFixed(8)) + '</b>');
                    $("#handlingFee").html('ETH <b>' + (dataSet.handlingFee.fee.toFixed(8)) + '</b>');
                    allfee = (parseFloat(dataSet.ethValue) - parseFloat(dataSet.handlingFee.fee)).toFixed(8);
                    $("#allfee").html('ETH <b>' + (allfee) + '</b>');
                    break;
            }
        }
    })

    var activeTab = 'pills-convert-tab';
    $('a[data-toggle="tab"]').on('shown.bs.tab', function (e) {
        e.target // newly activated tab
        e.relatedTarget // previous active tab
        activeTab = e.target.id;

        if (activeTab == 'pills-convert-tab') {
            $("#redemptionType").val("convert");
            $('#recipient').prop('required', true);
            $('#recipient_address').prop('required', false);
        } else {
            $.alert('coming soon')
            $("#pills-transfer-tab").removeClass("active");
            $("#pills-convert-tab").addClass("active");

        }
    })

    $.validator.addMethod("checkPolicies", function (value, element) {
        if ($('#checkAgreeFee').is(":checked")) {
            $("#checkboxMsg").html("");
            return true;
        } else {
            $("#checkboxMsg").html("Please agree with condition")
            return false;
        }
    });
    var redeem_min_sopx = parseFloat('{{ config("payments.redeem.minimum_sopx") }}')
    $.validator.addMethod("greaterThan", function (value, element) {
        var new_amount = document.getElementById("sopx_amount").value;
        if (new_amount >= redeem_min_sopx) {
            return true;
        } else {
            return false;
        }
    });

    $(function () {
        $("#submitRedemption").validate({
            rules: {
                sopx_amount: {
                    required: true,
                    max: withdrawalAmount,
                    greaterThan: true
                },
                acc_type: {
                    required: true,
                },
                checkAgreeFee: {
                    checkPolicies: true,
                }
            },
            messages: {
                sopx_amount: {
                    required: "Please enter your sopx amount.",
                    max: "Please enter a value less than current  balance.",
                    greaterThan: "Minimum Redeem Value Is SOPX " + redeem_min_sopx
                },
                acc_type: {
                    required: "Please check account type",
                },
                checkAgreeFee: {
                    checkPolicies: ""
                }
            },
            submitHandler: function (form) {
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


    function setLoader() {
        $("#setUSDValue").html(
            '<div class="spinner-border setUSDValue spinner-border-sm" role="status"> <span class="sr-only">Loading...</span> </div>'
        );
        $("#setSopxValue").html(
            '<div class="spinner-border setSopxValue spinner-border-sm" role="status"> <span class="sr-only">Loading...</span> </div>'
        );
        $('#loader').html(
            '<div class="text-center"> <div class="spinner1 spinner-border" role="status"> <span class="sr-only">Loading...</span> </div> </div>'
        );
        $("#btcValue").html(
            '<div class="spinner-border btcValue spinner-border-sm" role="status"> <span class="sr-only">Loading...</span> </div>'
        );
        $("#ethValue").html(
            '<div class="spinner-border ethValue spinner-border-sm" role="status"> <span class="sr-only">Loading...</span> </div>'
        );
        $("#soaxValueSet").html(
            '<div class="spinner-border soaxValueSet spinner-border-sm" role="status"> <span class="sr-only">Loading...</span> </div>'
        );
        $("#requestValue").html(
            '<div class="spinner-border usdValue spinner-border-sm" role="status"> <span class="sr-only">Loading...</span> </div>'
        );
        $("#handlingFee").html(
            '<div class="spinner-border handlingFee spinner-border-sm" role="status"> <span class="sr-only">Loading...</span> </div>'
        );
        $("#allfee").html(
            '<div class="spinner-border allfee spinner-border-sm" role="status"> <span class="sr-only">Loading...</span> </div>'
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

    function copyAmount(id) {
        $('#' + id).val(withdrawalAmount);
        getValueCurrency();
    }

</script>
