<!-- Resources -->

<script src="{{asset('MemberArea/libs/amchart/core.js')}}"></script>
<script src="{{asset('MemberArea/libs/amchart/charts.js')}}"></script>
<script src="{{asset('MemberArea/libs/amchart/animated.js')}}"></script>
<script>
    var sales_value = 0;
    let available_value = 0;
    var portfolio_value = 0;
    var chartReg = {};

    $(document).ready(function () {
        $('#portfolio_id').select2({
            placeholder: 'Select A Portfolio'
        });
    });

    $('#portfolio_id').on('change', function () {
        getPortfolio();
    });


    function getPortfolio(is_init = true) {
        $.ajax({
            url: '{{ route("contracts.portfolio") }}',
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            data: {
                portfolio_id: $('#portfolio_id').val(),
            },
            type: 'get',
            dataType: "json",
            success: function (response) {
                available_value = response.available_value;
                sales_value = parseFloat(response.sales_value);
                if (is_init == true) {
                    viewDiv();
                    if (response.description != '') {
                        $('#descriptiontext').html(response.description);
                        $("#descriptiondiv").removeClass("d-none");
                    } else {
                        $("#descriptiondiv").removeClass("d-none");
                        $("#descriptiondiv").addClass("d-none");
                    }
                    chartView(sales_value, available_value);
                }
                portfolio_value = parseFloat(response.portfolio_value);
                $("#set_available_value").html(available_value);
            }
        });
    }

    function validateAmount() {
        let amount = parseFloat($('#inp_amount').val());
        var percent = ((amount / portfolio_value) * 100).toFixed(4);
        var currentAmount = '{{ Auth::user()->soax(true) }}'
        if (amount <= available_value) {
            if (amount <= parseFloat('{{ Auth::user()->soax(true) }}')) {
                $("#amount_msg").html('');
                $('#submit_btn').prop('disabled', false);
                $("#staaking_value").html(percent + '%');
                stakingDiv();
                available_value_set = available_value - amount;
                chartView(sales_value, available_value_set, amount);
                $("#buy_soax_div").removeClass("d-none");
                $("#buy_soax_div").addClass("d-none");
                $("#add_soax_input").html('');

            } else {
                $('#submit_btn').prop('disabled', true);
                $("#staaking_div").removeClass("d-none");
                $("#staaking_div").addClass("d-none");
                chartView(sales_value, available_value);
                $("#buy_soax_div").removeClass("d-none");
                $("#add_soax_input").html(
                    '<input type="number" class="form-control " name="amount_add" id="amount_add" aria-describedby="helpId" ' +
                    'placeholder="Enter SOAX Amount" type="number" step="0.01" min="{{ config("payments.minimum_soax") }}" required>'
                );

                $("#amount_msg").html("You can't invest more than your current balance " + currentAmount);
            }
        } else {
            $("#staaking_div").removeClass("d-none");
            $("#staaking_div").addClass("d-none");
            $('#submit_btn').prop('disabled', true);
            chartView(sales_value, available_value);
            $("#amount_msg").html("You can't invest more than avalble portfoilio amount " + available_value);
            $("#buy_soax_div").removeClass("d-none");
            $("#buy_soax_div").addClass("d-none");
            $("#add_soax_input").html('');
        }
    }


    function chartView(sales, available, buying = 0) {
        dataValue = [{
                status: "Already Staked",
                count: sales,
                "color": am4core.color("#6C2122")
            },
            {
                status: "Available",
                count: available,
                "color": am4core.color("#283250")
            },
            {
                status: "Your Stake",
                count: buying,
                "color": am4core.color("#D5433D")
            }
        ];
        am4core.ready(function () {

            if (chartReg["chartdiv"]) {
                chartReg["chartdiv"].dispose();
                delete chartReg["chartdiv"];
            }
            // Themes begin
            am4core.useTheme(am4themes_animated);
            // Themes end

            chartReg["chartdiv"] = am4core.create("chartdiv", am4charts.PieChart3D);
            chartReg["chartdiv"].hiddenState.properties.opacity = 0; // this creates initial fade-in

            chartReg["chartdiv"].legend = new am4charts.Legend();

            chartReg["chartdiv"].innerRadius = 50;
            chartReg["chartdiv"].data = dataValue;
            var series = chartReg["chartdiv"].series.push(new am4charts.PieSeries3D());
            series.dataFields.value = "count";
            series.dataFields.category = "status";
            chartReg["chartdiv"].logo.disabled = true;
            series.slices.template.propertyFields.fill = "color";
            chartReg["chartdiv"].responsive.enabled = true;
            chartReg["chartdiv"].responsive.useDefault = false;

            chartReg["chartdiv"].responsive.rules.push({
                relevant: function (target) {
                    if (target.pixelWidth <= 800) {
                        return true;
                    }

                    chartReg["chartdiv"].legend.position = "right";
                    chartReg["chartdiv"].legend.scrollable = true;
                    return false;
                },
                state: function (target, stateId) {

                    if (target instanceof am4charts.Chart) {
                        var state = target.states.create(stateId);
                        state.properties.paddingTop = 0;
                        state.properties.paddingRight = 25;
                        state.properties.paddingBottom = 0;
                        state.properties.paddingLeft = 25;
                        return state;
                    } else if (target instanceof am4charts.AxisLabelCircular ||
                        target instanceof am4charts.PieTick) {
                        var state = target.states.create(stateId);
                        state.properties.disabled = true;
                        return state;
                    }
                    return null;
                }
            });

        });

    }

    function chartViewNew(sales, available, buy) {
        dataValue = [{
                status: "Already Staked",
                count: sales,
                "color": am4core.color("#6C2122")
            },
            {
                status: "Available",
                count: available,
                "color": am4core.color("#283250")
            },
            {
                status: "This Stake",
                count: buy,
                "color": am4core.color("#D5433D")
            }
        ];
        am4core.ready(function () {

            if (chartReg["chartdiv"]) {
                chartReg["chartdiv"].dispose();
                delete chartReg["chartdiv"];
            }
            // Themes begin
            am4core.useTheme(am4themes_animated);
            // Themes end

            chartReg["chartdiv"] = am4core.create("chartdiv", am4charts.PieChart3D);
            chartReg["chartdiv"].hiddenState.properties.opacity = 0; // this creates initial fade-in

            chartReg["chartdiv"].legend = new am4charts.Legend();

            chartReg["chartdiv"].data = dataValue;
            var series = chartReg["chartdiv"].series.push(new am4charts.PieSeries3D());
            series.dataFields.value = "count";
            series.dataFields.category = "status";
            chartReg["chartdiv"].logo.disabled = true;
            series.slices.template.propertyFields.fill = "color";
            chartReg["chartdiv"].responsive.enabled = true;
            chartReg["chartdiv"].responsive.useDefault = false;

            chartReg["chartdiv"].innerRadius = 50;
            chartReg["chartdiv"].responsive.rules.push({
                relevant: function (target) {
                    if (target.pixelWidth <= 800) {
                        return true;
                    }

                    chartReg["chartdiv"].legend.position = "right";
                    chartReg["chartdiv"].legend.scrollable = true;
                    return false;
                },
                state: function (target, stateId) {

                    if (target instanceof am4charts.Chart) {
                        var state = target.states.create(stateId);
                        state.properties.paddingTop = 0;
                        state.properties.paddingRight = 25;
                        state.properties.paddingBottom = 0;
                        state.properties.paddingLeft = 25;
                        return state;
                    } else if (target instanceof am4charts.AxisLabelCircular ||
                        target instanceof am4charts.PieTick) {
                        var state = target.states.create(stateId);
                        state.properties.disabled = true;
                        return state;
                    }
                    return null;
                }
            });

        });

    }

    function viewDiv() {
        $("#primarydiv").addClass("d-none");

        $("#chartmaindiv").removeClass("d-none");
        $("#formDiv").removeClass("d-none");

        $("#chartmaindiv").animate({
            opacity: '0.4'
        }, "slow");
        $("#formDiv").animate({
            opacity: '0.4'
        }, "slow");
        $("#chartmaindiv").animate({
            opacity: '1'
        }, "slow");
        $("#formDiv").animate({
            opacity: '1'
        }, "slow");
    }

    function stakingDiv() {
        $("#staaking_div").removeClass("d-none");
        $("#staaking_div").animate({
            opacity: '0.4'
        }, "slow");
        $("#staaking_div").animate({
            opacity: '1'
        }, "slow");
    }

    function numberFormat(value) {
        return Number(parseFloat(value).toFixed(2)).toLocaleString('en', {
            minimumFractionDigits: 2
        });
    }

    function addsoaxValue() {
        var amount = document.getElementById("amount_add").value;
        if (amount) {
            window.location.href = '/wallet/transaction/new?amount=' + amount;
        } else {
            $("#amount_add_msg").html('Enter amount to add');
        }
    }

    function appendBalance(e) {
        var val = e;
        $("#inp_amount").val(val);
        $('#submit_btn').prop('disabled', false);
    }

</script>
