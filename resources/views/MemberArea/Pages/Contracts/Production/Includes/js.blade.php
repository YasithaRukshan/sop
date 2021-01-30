<script>
    Livewire.on('dataSet', dataSet => {
        $("#chartdiv2").html(dataSet['loader']);
        $('.spinner1').fadeIn();
        viewDiv();
        dataSet['sales_value'] = dataSet['sales_value'] + dataSet['available_value'];
        chartViewNew(dataSet['sales_value'], dataSet['stakedBalance']);
        setTextFild(dataSet['stakedBalance'], dataSet['productionBalance'], dataSet['contractCount']);
        setTableData(dataSet['products']);
        setTimeout(function () {
            chartViewAll(dataSet['chartValues']);
            $('.spinner1').fadeOut();
        }, 1000);
    })
    var chartReg = {};

    function setTableData(dataSet) {
        $('#datatable').DataTable().destroy();
        $('#datatable').DataTable({
            data: dataSet,
            "columns": [{
                    data: 'date',
                },
                {
                    data: 'sopxProduced'
                },
                {
                    data: 'autoConversion'
                },
                {
                    data: 'sopxLeft'
                },
                {
                    data: 'action'
                },
            ],
            "language": {
                "emptyTable": "No data available in the table",
                "paginate": {
                    "previous": '<i class="fas fa-chevron-left text-dark"></i>',
                    "next": '<i class="fas fa-chevron-right text-dark"></i>'
                },
                "sEmptyTable": "No data available in the table"
            }
        })

    }

    function contractTable(element) {
        var id = element;
        var data = {
            id: id,
        };
        $('#contract_table').modal('show');
        $("#contract_table_modal").html(sectionLoader());
        $.ajax({
            url: "{{ route('contracts.get') }}",
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            method: "POST",
            dataType: '',
            data: data,
            success: function (response) {
                $("#contract_table_modal").html(response);
                $('#contractTable').dataTable({
                    "order": [
                        [0, "desc"]
                    ],
                    "language": {
                        "emptyTable": "No data available in the table",
                        "paginate": {
                            "previous": '<i class="fas fa-chevron-left text-dark"></i>',
                            "next": '<i class="fas fa-chevron-right text-dark"></i>'
                        }
                    }

                });
            }
        });
    }

    function sectionLoader() {
        return '<div class="d-flex justify-content-center section-loader">' +
            '<div class="spinner-grow text-primary" role="status">' +
            '<span class="sr-only">Loading...</span>' +
            '</div>' +
            '</div>';
    }

    function viewDiv() {
        $("#totalProduction").removeClass("d-none");
        $("#totalStaked").removeClass("d-none");
        $("#contractDiv").removeClass("d-none");
        $("#chartView1").removeClass("d-none");
        $("#chartView2").removeClass("d-none");
        $("#tablediv").removeClass("d-none");
    }

    function setTextFild(valStaked, valProduction, countContracts) {
        $("#valStaked").html(valStaked);
        $("#valProduction").html(valProduction);
        $("#countContracts").html(countContracts);
    }

    function chartViewNew(sales, buy) {
        dataValue = [{
                status: "Other",
                count: sales,
                "color": am4core.color("#6C2122")
            },
            {
                status: "Your Stake ",
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
