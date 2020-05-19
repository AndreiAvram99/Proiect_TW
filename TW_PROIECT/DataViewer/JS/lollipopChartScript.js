function lollipopChartDraw(){

    const CONTAINER_HEIGHT = document.getElementsByClassName("chart").item(0).clientHeight;
    const CONTAINER_WIDTH = document.getElementsByClassName("chart").item(0).clientWidth;

    var margin = {top: 50, right: 0, bottom: 80, left: 60},
                width = CONTAINER_WIDTH - 80,
                height = CONTAINER_HEIGHT - 130;

    var svg = d3.select("#Lollipop_chart")
    .append("svg")
        .attr("width", width + margin.left + margin.right)
        .attr("height", height + margin.top + margin.bottom)
    .append("g")
        .attr("transform",
            "translate(" + margin.left + "," + margin.top + ")");

    d3.csv("../RESOURCES/CSV/chart_data.CSV", function(data) {

    data.forEach(function(d) {
        d.Value = +d.Value;
        });
    
    var max = d3.max(data, function(d) { return d.Value; });

    // X axis
    var x = d3.scaleBand()
    .range([ 0, width ])
    .domain(data.map(function(d) { return d.Name; }))
    .padding(1);
    svg.append("g")
    .attr("transform", "translate(0," + height + ")")
    .call(d3.axisBottom(x))
    .selectAll("text")
        .attr("transform", "translate(-12,10)rotate(-90)")
        .style("text-anchor", "end");

    // Add Y axis
    var y = d3.scaleLinear()
    .domain([0, max])
    .range([ height, 0]);
    svg.append("g")
    .call(d3.axisLeft(y));

    // Lines
    svg.selectAll("myline")
    .data(data)
    .enter()
    .append("line")
        .attr("x1", function(d) { return x(d.Name); })
        .attr("x2", function(d) { return x(d.Name); })
        .attr("y1", function(d) { return y(d.Value); })
        .attr("y2", y(0))
        .attr("stroke", "grey")

    // Circles
    svg.selectAll("mycircle")
    .data(data)
    .enter()
    .append("circle")
        .attr("cx", function(d) { return x(d.Name); })
        .attr("cy", function(d) { return y(d.Value); })
        .attr("r", "4")
        .style("fill", "#69b3a2")
        .attr("stroke", "black")
    });
    
    d3.select("#downloadSVG").on("click", function() {
        d3.select(this)
            .attr("href", 'data:application/octet-stream;base64,' + btoa(d3.select("#Lollipop_chart").html()))
    });
   
    d3.select("#downloadPNG").on('click', function(){
        // Get the d3js SVG element and save using saveSvgAsPng.js
        saveSvgAsPng(document.getElementsByTagName("svg")[0], "graph.png", {scale: 2, backgroundColor: "#FFFFFF"});
    })

}
