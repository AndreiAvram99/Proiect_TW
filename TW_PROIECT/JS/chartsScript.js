window.onload = function (){
    drawChart1();
    drawChart2();
    drawChart3();
}

function drawChart1() {
    var chart = new CanvasJS.Chart("chart_01", {

        theme: "light2",

        title: {
            text: "Accidents rate until today"
        },

        exportEnabled: true,

        data: [
            {
                type: "pie",
                startAngle: 25,
                toolTipContent: "<b>{label}</b>: {y}%",
                indexLabelFontSize: 16,
                indexLabel: "{label} - {y}%",
                dataPoints: [
                    {y: 51.08, label: "OH"},
                    {y: 27.34, label: "TX"},
                    {y: 10.62, label: "CA"},
                    {y: 5.02, label: "DC"},
                    {y: 4.07, label: "WA"},
                    {y: 1.22, label: "LA"},
                    {y: 0.44, label: "ME"}
                ]
            }
        ]
    });
    chart.render();

    var toolBar = document.getElementsByClassName("canvasjs-chart-toolbar")[0];
    if (chart.get("exportEnabled")) {
        var exportCSV = document.createElement('div');
        var text = document.createTextNode("Save as CSV");
        exportCSV.setAttribute("style", "padding: 12px 8px; background-color: white; color: black")
        exportCSV.appendChild(text);

        exportCSV.addEventListener("mouseover", function () {
            exportCSV.setAttribute("style", "padding: 12px 8px; background-color: #2196F3; color: white")
        });
        exportCSV.addEventListener("mouseout", function () {
            exportCSV.setAttribute("style", "padding: 12px 8px; background-color: white; color: black")
        });
        exportCSV.addEventListener("click", function () {
            downloadCSV({filename: "chart-data.csv", chart: chart})
        });
        toolBar.lastChild.appendChild(exportCSV);
    } else {
        var exportCSV = document.createElement('button');
        var text = document.createTextNode("Save as CSV");
        exportCSV.appendChild(text);
        exportCSV.addEventListener("click", function () {
            downloadCSV({filename: "chart-data.csv", chart: chart})
        });
        document.body.appendChild(exportCSV)

    }
}

function drawChart2() {
    var chart = new CanvasJS.Chart("chart_02",
        {
            theme: "light2",

            title: {
                text: "Most dangerous states"
            },

            exportEnabled: true,

            data: [
                {
                    type: "column",
                    dataPoints: [
                        {y: 51.08, label: "OH"},
                        {y: 27.34, label: "TX"},
                        {y: 10.62, label: "CA"},
                        {y: 5.02, label: "DC"},
                        {y: 4.07, label: "WA"},
                        {y: 1.22, label: "LA"},
                        {y: 40.44, label: "ME"}
                    ]
                }
            ]
        });

    chart.render();

    var toolBar = document.getElementsByClassName("canvasjs-chart-toolbar")[1];
    if(chart.get("exportEnabled")){
        var exportCSV = document.createElement('div');
        var text = document.createTextNode("Save as CSV");
        exportCSV.setAttribute("style", "padding: 12px 8px; background-color: white; color: black")
        exportCSV.appendChild(text);

        exportCSV.addEventListener("mouseover", function(){
            exportCSV.setAttribute("style", "padding: 12px 8px; background-color: #2196F3; color: white")
        });
        exportCSV.addEventListener("mouseout", function(){
            exportCSV.setAttribute("style", "padding: 12px 8px; background-color: white; color: black")
        });
        exportCSV.addEventListener("click", function(){
            downloadCSV({ filename: "chart-data.csv", chart: chart })
        });
        toolBar.lastChild.appendChild(exportCSV);
    } else {
        var exportCSV = document.createElement('button');
        var text = document.createTextNode("Save as CSV");
        exportCSV.appendChild(text);
        exportCSV.addEventListener("click", function () {
            downloadCSV({filename: "chart-data.csv", chart: chart})
        });
        document.body.appendChild(exportCSV)
    }
}

function drawChart3(){

    var  heightDim = document.getElementsByClassName("chart").item(0).clientHeight;
    var  widthDim = document.getElementsByClassName("chart").item(0).clientWidth;

    //document.getElementById("ceva").innerHTML = widthDim;
    //document.getElementById("ceva").innerHTML = heightDim;

    // set the dimensions and margins of the graph
    var margin = {top: 10, right: 10, bottom: 30, left: 60},
        width = widthDim - 100,
        height = heightDim - 30;

    // append the svg object to the body of the page
    var svg = d3.select("#chart_03")
        .append("svg")
        .attr("width", width + margin.left)
        .attr("height", height + margin.bottom)
        .append("g")
        .attr("id", "visualization")
        .attr("transform",
            "translate(" + margin.left + "," + margin.top + ")")


    //Read the data
    //Insert csv file!!
    d3.csv("https://raw.githubusercontent.com/holtzy/D3-graph-gallery/master/DATA/iris.csv", function(data){

        // Add X axis
        var x = d3.scaleLinear()
            .domain([4, 8])
            .range([ 0, width ]);
        svg.append("g")
            .attr("transform", "translate(0," + height + ")")
            .call(d3.axisBottom(x));

        // Add Y axis
        var y = d3.scaleLinear()
            .domain([0, 9])
            .range([ height, 0]);
        svg.append("g")
            .call(d3.axisLeft(y));

        // Color scale: give me a specie name, I return a color
        var color = d3.scaleOrdinal()
            .domain(["setosa", "versicolor", "virginica" ])
            .range([ "#440154ff", "#21908dff", "#fde725ff"])

        // Add dots
        svg.append('g')
            .selectAll("dot")
            .data(data)
            .enter()
            .append("circle")
            .attr("cx", function (d) { return x(d.Sepal_Length); } )
            .attr("cy", function (d) { return y(d.Petal_Length); } )
            .attr("r", 5)
            .style("fill", function (d) { return color(d.Species) } )

    })

    d3.select('#downloadPNG').on('click', function(){
        d3.select(this)
            .attr("href", 'data:application/octet-stream;base64')
    })

    d3.select("#downloadSVG").on("click", function() {
        d3.select(this)
            .attr("href", 'data:application/octet-stream;base64,' + btoa(d3.select("#chart_03").html()))
    })

}

function convertChartDataToCSV(args) {
    var result, ctr, keys, columnDelimiter, lineDelimiter, data;

    data = args.data || null;
    if (data == null || !data.length) {
        return null;
    }

    columnDelimiter = args.columnDelimiter || ',';
    lineDelimiter = args.lineDelimiter || '\n';

    keys = Object.keys(data[0]);

    result = '';
    result += keys.join(columnDelimiter);
    result += lineDelimiter;

    data.forEach(function(item) {
        ctr = 0;
        keys.forEach(function(key) {
            if (ctr > 0) result += columnDelimiter;
            result += item[key];
            ctr++;
        });
        result += lineDelimiter;
    });
    return result;
}

function downloadCSV(args) {
        var data, filename, link;
        var csv = "";
        for(var i = 0; i < args.chart.options.data.length; i++){
            csv += convertChartDataToCSV({
                data: args.chart.options.data[i].dataPoints
            });
        }
        if (csv == null) return;

        filename = args.filename || 'chart-data.csv';

        if (!csv.match(/^data:text\/csv/i)) {
            csv = 'data:text/csv;charset=utf-8,' + csv;
        }

        data = encodeURI(csv);
        link = document.createElement('a');
        link.setAttribute('href', data);
        link.setAttribute('download', filename);
        document.body.appendChild(link); // Required for FF
        link.click();
        document.body.removeChild(link);
    }

function refresh() { location.reload(); }
