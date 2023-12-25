

var oilCanvas = document.getElementById("regional-sales");

var labels = regionalSalesData.map(region => region.region);
var data = regionalSalesData.map(region => region.sales_count);
var backgroundColors = data.map(function () {
    return getRandomColor();
});

var oilData = {
    labels: labels,
    datasets: [
        {
            data: data,
            backgroundColor: backgroundColors
        },
    ],
};

var pieChart = new Chart(oilCanvas, {
    type: "pie",
    data: oilData,
    options: {
        plugins: {
            legend: {
                display: true,
                position: "bottom",
            },
        },
    },
});
setInterval(function () {
    var themeLink = $("#theme-link").attr("href");
    if (themeLink.includes("dark")) {
        pieChart.options.plugins.legend.labels.color = "white";
    } else {
        pieChart.options.plugins.legend.labels.color = "black";
    }

    pieChart.update();
}, 100);
am5.ready(function () {
    // Create root element
    // https://www.amcharts.com/docs/v5/getting-started/#Root_element
    var root = am5.Root.new("customer_location");

    // Set themes
    // https://www.amcharts.com/docs/v5/concepts/themes/
    root.setThemes([am5themes_Animated.new(root)]);

    // Create the map chart
    // https://www.amcharts.com/docs/v5/charts/map-chart/
    var chart = root.container.children.push(
        am5map.MapChart.new(root, {
            projection: am5map.geoMercator(),
        })
    );

    // Create series for background fill
    // https://www.amcharts.com/docs/v5/charts/map-chart/map-polygon-series/#Background_polygon
    var backgroundSeries = chart.series.push(
        am5map.MapPolygonSeries.new(root, {})
    );
    backgroundSeries.mapPolygons.template.setAll({
        fill: root.interfaceColors.get("alternativeBackground"),
        fillOpacity: 0,
        strokeOpacity: 0,
    });
    // Add background polygo
    // https://www.amcharts.com/docs/v5/charts/map-chart/map-polygon-series/#Background_polygon
    backgroundSeries.data.push({
        geometry: am5map.getGeoRectangle(90, 180, -90, -180),
    });

    // Create main polygon series for countries
    // https://www.amcharts.com/docs/v5/charts/map-chart/map-polygon-series/
    var polygonSeries = chart.series.push(
        am5map.MapPolygonSeries.new(root, {
            geoJSON: am5geodata_worldLow,
        })
    );

    polygonSeries.mapPolygons.template.setAll({
        fill: root.interfaceColors.get("alternativeBackground"),
        fillOpacity: 0.15,
        strokeWidth: 0.5,
        stroke: root.interfaceColors.get("background"),
    });

    // Create polygon series for circles
    // https://www.amcharts.com/docs/v5/charts/map-chart/map-polygon-series/
    var circleTemplate = am5.Template.new({
        tooltipText: "{name}: {value}",
    });

    var bubbleSeries = chart.series.push(
        am5map.MapPointSeries.new(root, {
            calculateAggregates: true,
            valueField: "value",
            polygonIdField: "id",
        })
    );

    bubbleSeries.bullets.push(function () {
        return am5.Bullet.new(root, {
            sprite: am5.Circle.new(
                root,
                {
                    radius: 10,
                    templateField: "circleTemplate",
                },
                circleTemplate
            ),
        });
    });

    bubbleSeries.set("heatRules", [
        {
            target: circleTemplate,
            min: 3,
            max: 30,
            key: "radius",
            dataField: "value",
        },
    ]);

    var colors = am5.ColorSet.new(root, {});

    bubbleSeries.data.setAll(bubbleSeriesData);

    // Add globe/map switch
    // var cont = chart.children.push(am5.Container.new(root, {
    //   layout: root.horizontalLayout,
    //   x: 20,
    //   y: 40
    // }));

    // cont.children.push(am5.Label.new(root, {
    //   centerY: am5.p50,
    //   text: "Map"
    // }));

    // var switchButton = cont.children.push(
    //   am5.Button.new(root, {
    //     themeTags: ["switch"],
    //     centerY: am5.p50,
    //     icon: am5.Circle.new(root, {
    //       themeTags: ["icon"]
    //     })
    //   })
    // );

    // switchButton.on("active", function () {
    //   if (!switchButton.get("active")) {
    //     chart.set("projection", am5map.geoMercator());
    //     backgroundSeries.mapPolygons.template.set("fillOpacity", 0);
    //   } else {
    //     chart.set("projection", am5map.geoOrthographic());
    //     backgroundSeries.mapPolygons.template.set("fillOpacity", 0.1);
    //   }
    // });

    // cont.children.push(
    //   am5.Label.new(root, {
    //     centerY: am5.p50,
    //     text: "Globe"
    //   })
    // );

    // Make stuff animate on load
    chart.appear(1000, 100);
}); // end am5.ready()
