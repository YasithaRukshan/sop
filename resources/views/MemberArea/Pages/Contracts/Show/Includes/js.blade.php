<script src="{{asset('MemberArea/libs/amchart/core.js')}}"></script>
<script src="{{asset('MemberArea/libs/amchart/charts.js')}}"></script>
<script src="{{asset('MemberArea/libs/amchart/animated.js')}}"></script>
<script>
    function pieChart(staked, other) {
        dataValue = [{
                status: "This Staked",
                count: parseFloat(staked),
                color: am4core.color("#6C2122")
            },
            {
                status: "Other",
                count: parseFloat(other),
                color: am4core.color("#283250")
            }
        ];
        am4core.ready(function () {
            // Themes begin
            am4core.useTheme(am4themes_animated);
            // Themes end

            prodChart = am4core.create("chartdiv", am4charts.PieChart3D);
            // prodChart.hiddenState.properties.opacity = 0; // this creates initial fade-in

            prodChart.legend = new am4charts.Legend();

            prodChart.data = dataValue;
            var series = prodChart.series.push(new am4charts.PieSeries3D());
            series.dataFields.value = "count";
            series.dataFields.category = "status";
            prodChart.logo.disabled = true;
            series.slices.template.propertyFields.fill = "color";
            prodChart.responsive.enabled = true;
            prodChart.responsive.useDefault = false;

            prodChart.innerRadius = 50;
            prodChart.responsive.rules.push({
                relevant: function (target) {
                    if (target.pixelWidth <= 800) {
                        return true;
                    }

                    prodChart.legend.position = "right";
                    prodChart.legend.scrollable = true;
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

</script>
