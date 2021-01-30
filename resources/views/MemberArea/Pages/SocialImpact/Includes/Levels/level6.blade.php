<script>

    function level6() {
            // First div
            am4core.ready(function () {
                // Themes begin
                am4core.useTheme(am4themes_animated);
                // Themes end

                // Create chart instance
                var chart1cor = am4core.create("sixethDiv1", am4charts.XYChart3D);
                chart1cor.logo.disabled = true;

                // Add data
                chart1cor.data = [{
                    "nameCol": 'Carbon Warrior',
                    "income": $('#sixethDiv1').attr('data-value'),
                    "color": '#64DD17'
                }];

                // Create axes
                var categoryAxis = chart1cor.yAxes.push(new am4charts.CategoryAxis());
                categoryAxis.dataFields.category = "nameCol";
                categoryAxis.numberFormatter.numberFormat = "#";
                categoryAxis.renderer.inversed = true;

                var valueAxiscor6 = chart1cor.xAxes.push(new am4charts.ValueAxis());
                valueAxiscor6.min = parseInt('{{ config("rewards.cor.min") }}');
                valueAxiscor6.max = parseInt('{{ config("rewards.cor.max") }}');
                valueAxiscor6.strictMinMax = true;
                valueAxiscor6.renderer.minGridDistance = 50;

                // Create series
                var series = chart1cor.series.push(new am4charts.ColumnSeries3D());
                series.dataFields.valueX = "income";
                series.dataFields.categoryY = "nameCol";
                series.name = "Income";
                series.columns.template.propertyFields.fill = "color";
                series.columns.template.tooltipText = "{valueX} pounds";
                series.columns.template.column3D.stroke = am4core.color("#fff");
                series.columns.template.column3D.strokeOpacity = 0.2;

            }); // end am4core.ready()
            am4core.ready(function () {
                // Themes begin
                am4core.useTheme(am4themes_animated);
                // Themes end

                // Create chart instance
                var chart = am4core.create("sixethDiv2", am4charts.XYChart3D);
                chart.logo.disabled = true;

                // Add data
                chart.data = [{
                    "nameCol": 'Energetic',
                    "income": $('#sixethDiv2').attr('data-value'),
                    "color": '#ff7b00'
                }, ];

                // Create axes
                var categoryAxis = chart.yAxes.push(new am4charts.CategoryAxis());
                categoryAxis.dataFields.category = "nameCol";
                categoryAxis.numberFormatter.numberFormat = "#";
                categoryAxis.renderer.inversed = true;

                var valueAxisGeo6 = chart.xAxes.push(new am4charts.ValueAxis());
                valueAxisGeo6.min = parseInt('{{ config("rewards.geo.min") }}');
                valueAxisGeo6.max = parseInt('{{ config("rewards.geo.max") }}');
                valueAxisGeo6.strictMinMax = true;
                valueAxisGeo6.renderer.minGridDistance = 50;

                // Create series
                var series = chart.series.push(new am4charts.ColumnSeries3D());
                series.dataFields.valueX = "income";
                series.dataFields.categoryY = "nameCol";
                series.name = "Income";
                series.columns.template.propertyFields.fill = "color";
                series.columns.template.tooltipText = "{valueX} Kw";
                series.columns.template.column3D.stroke = am4core.color("#fff");
                series.columns.template.column3D.strokeOpacity = 0.2;

            }); // end am4core.ready()
            am4core.ready(function () {
                // Themes begin
                am4core.useTheme(am4themes_animated);
                // Themes end

                // Create chart instance
                var chart = am4core.create("sixethDiv3", am4charts.XYChart3D);
                chart.logo.disabled = true;

                // Add data
                chart.data = [{
                    "nameCol": 'The Creator',
                    "income": $('#sixethDiv3').attr('data-value'),
                    "color": '#006cfa'
                }, ];

                // Create axes
                var categoryAxis = chart.yAxes.push(new am4charts.CategoryAxis());
                categoryAxis.dataFields.category = "nameCol";
                categoryAxis.numberFormatter.numberFormat = "#";
                categoryAxis.renderer.inversed = true;

                var valueAxisOigcc6 = chart.xAxes.push(new am4charts.ValueAxis());
                valueAxisOigcc6.min = parseInt('{{ config("rewards.oigcc.min") }}');
                valueAxisOigcc6.max = parseInt('{{ config("rewards.oigcc.max") }}');
                valueAxisOigcc6.strictMinMax = true;
                valueAxisOigcc6.renderer.minGridDistance = 50;

                // Create series
                var series = chart.series.push(new am4charts.ColumnSeries3D());
                series.dataFields.valueX = "income";
                series.dataFields.categoryY = "nameCol";
                series.name = "Income";
                series.columns.template.propertyFields.fill = "color";
                series.columns.template.tooltipText = "{valueX} #of Job Hours";
                series.columns.template.column3D.stroke = am4core.color("#fff");
                series.columns.template.column3D.strokeOpacity = 0.2;

            }); // end am4core.ready()
        }

    </script>
