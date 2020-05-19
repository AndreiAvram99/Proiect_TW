function barPlotChartDraw() {

    const CONTAINER_HEIGHT = document.getElementsByClassName("chart").item(0).clientHeight;
    const CONTAINER_WIDTH = document.getElementsByClassName("chart").item(0).clientWidth;

    // Set the dimensions and margins of the graph
    let margin = {top: 10, right: 10, bottom: 45, left: 100},
        width = CONTAINER_WIDTH - 120,
        height = CONTAINER_HEIGHT - 60;

    // Append the svg object to the body of the page
    let svg = d3.select("#Bar_plot_chart")
        .append("svg")
        .attr("width", width + margin.left + margin.right)
        .attr("height", height + margin.top + margin.bottom)
        .attr("id", "chart")
        .append("g")
        .attr("transform",
            "translate(" + margin.left + "," + margin.top + ")");

    // Read the data
    // Insert CSV file!!
    // Parse the Data
    d3.csv("../RESOURCES/CSV/chart_data.CSV", function(data) {

        data.forEach(function(d) {
            d.Value = +d.Value;
        });

        var max = d3.max(data, function(d) { return d.Value; });

        // set the color scale
        let color = d3.scaleOrdinal()
            .domain(["slateblue", "lightgoldenrodyellow", "chartreuse", "lightskyblue", "lightsalmon", "lightslategray", "lightcoral", "lightgreen", "lightseagreen", "skyblue" ])
            .range([ "slateblue", "lightgoldenrodyellow", "chartreuse", "lightskyblue", "lightsalmon", "lightslategray", "lightcoral", "lightgreen", "lightseagreen", "skyblue"]);

        // Add X axis
        let x = d3.scaleLinear()
            .domain([0, max])
            .range([0, width]);
        svg.append("g")
            .attr("transform", "translate(0," + height + ")")
            .call(d3.axisBottom(x))
            .selectAll("text")
            .attr("transform", "translate(0,0) rotate(0)")
            .style("text-anchor", "end");

        // Y axis
        let y = d3.scaleBand()
            .range([ 0, height ])
            .domain(data.map(function(d) { return d.Name; }))
            .padding(.1);
        svg.append("g")
            .call(d3.axisLeft(y));

        //Bars
        svg.selectAll("myRect")
            .data(data)
            .enter()
            .append("rect")
            .attr("x", x(0) )
            .attr("y", function(d) { return y(d.Name); })
            .attr("width", function(d) { return x(d.Value); })
            .attr("height", y.bandwidth() )
            .attr("fill", function (d) { return color(d.Color) })
    });

    d3.select("#downloadSVG").on("click", function() {
        d3.select(this)
            .attr("href", 'data:application/octet-stream;base64,' + btoa(d3.select("#Bar_plot_chart").html()))
    });

    d3.select("#downloadPNG").on('click', function(){
        // Get the d3js SVG element and save using saveSvgAsPng.js
        saveSvgAsPng(document.getElementsByTagName("svg")[0], "graph.png", {scale: 2, backgroundColor: "#FFFFFF"});
    })

    function getSVG() {
        d3.select("#downloadSVG").d3.select(this)
            .attr("href", 'data:application/octet-stream;base64,' + btoa(d3.select("#Bar_plot_chart").html()))
    }

}
