<script>
    var chartReg = {};
    $(document).ready(function () {
        viewData();
    });

    function viewData() {
        $.ajax({
            url: '{{ route("wallet.data") }}',
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            type: 'get',
            success: function (response) {
                console.log(response);
                $("#chartdiv2").html(response.loader);
                setTimeout(function () {
                    chartViewAll(response.chartValues);
                    $('.spinner1').fadeOut();
                }, 1000);
            }
        });
    }

    function chartViewAll(data) {
        am4core.ready(function () {

            if (chartReg["chartdiv2"]) {
                chartReg["chartdiv2"].dispose();
                delete chartReg["chartdiv2"];
            }
            // Themes begin
            am4core.useTheme(am4themes_animated);
            // Themes end

            // Create chart instance
            chartReg["chartdiv2"] = am4core.create("chartdiv2", am4charts.XYChart);

            // Add data
            chartReg["chartdiv2"].data = data;

            // Set input format for the dates
            chartReg["chartdiv2"].dateFormatter.inputDateFormat = "yyyy-MM-dd";

            // Create axes
            var dateAxis = chartReg["chartdiv2"].xAxes.push(new am4charts.DateAxis());
            var valueAxis = chartReg["chartdiv2"].yAxes.push(new am4charts.ValueAxis());

            // Create series
            var series = chartReg["chartdiv2"].series.push(new am4charts.LineSeries());
            series.dataFields.valueY = "value";
            series.dataFields.dateX = "date";
            series.tooltipText = "{value}"
            series.strokeWidth = 2;
            series.minBulletDistance = 15;

            // Drop-shaped tooltips
            series.tooltip.background.cornerRadius = 20;
            series.tooltip.background.strokeOpacity = 0;
            series.tooltip.pointerOrientation = "vertical";
            series.tooltip.label.minWidth = 40;
            series.tooltip.label.minHeight = 40;
            series.tooltip.label.textAlign = "middle";
            series.tooltip.label.textValign = "middle";

            // Make bullets grow on hover
            var bullet = series.bullets.push(new am4charts.CircleBullet());
            bullet.circle.strokeWidth = 2;
            bullet.circle.radius = 4;
            bullet.circle.fill = am4core.color("#fff");

            var bullethover = bullet.states.create("hover");
            bullethover.properties.scale = 1.3;

            // Make a panning cursor
            chartReg["chartdiv2"].cursor = new am4charts.XYCursor();
            chartReg["chartdiv2"].cursor.behavior = "panXY";
            chartReg["chartdiv2"].cursor.xAxis = dateAxis;
            chartReg["chartdiv2"].cursor.snapToSeries = series;

            // Create vertical scrollbar and place it before the value axis
            chartReg["chartdiv2"].scrollbarY = new am4core.Scrollbar();
            chartReg["chartdiv2"].scrollbarY.startGrip.disabled = true;
            chartReg["chartdiv2"].scrollbarY.endGrip.disabled = true;

            // Create a horizontal scrollbar with previe and place it underneath the date axis
            chartReg["chartdiv2"].scrollbarX = new am4charts.XYChartScrollbar();
            chartReg["chartdiv2"].scrollbarX.series.push(series);
            chartReg["chartdiv2"].scrollbarX.parent = chartReg["chartdiv2"].bottomAxesContainer;

            chartReg["chartdiv2"].logo.disabled = true;
            dateAxis.start = 0.79;
            dateAxis.keepSelection = true;


        }); // end am4core.ready()
    }

</script>
