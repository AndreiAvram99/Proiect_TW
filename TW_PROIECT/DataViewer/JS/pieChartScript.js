function pieChartDraw() {

    // set the dimensions and margins of the graph
    let width = document.getElementsByClassName("chart").item(0).clientWidth ,
        height = document.getElementsByClassName("chart").item(0).clientHeight,
        margin = 10;

    let radius;
    // the radius of the piePlot is half the width or half the height (smallest one).
    if(width < 350)
        radius = Math.min(width, height) / 2 - margin - 25;
    else
        radius = Math.min(width, height) / 2 - margin;


    // append the svg object to the div called 'chart_01'
    let svg = d3.select("#Pie_chart")
        .append("svg")
        .attr("width", width)
        .attr("height", height)
        .append("g")
        .attr("transform", "translate(" + width / 2 + "," + height / 2 + ")");

    // Read the data
    // Insert csv file!!
    // Parse the Data
    d3.csv("../RESOURCES/CSV/chart_data.csv", function(data) {
        // set the color scale

        let color = d3.scaleOrdinal()
            .domain(["slateblue", "lightgoldenrodyellow", "chartreuse", "lightskyblue", "lightsalmon", "lightslategray", "lightcoral", "lightgreen", "lightseagreen", "skyblue" ])
            .range([ "slateblue", "lightgoldenrodyellow", "chartreuse", "lightskyblue", "lightsalmon", "lightslategray", "lightcoral", "lightgreen", "lightseagreen", "skyblue"]);

        // Compute the position of each group on the pie:
        let pie = d3.pie()
            .sort(null) // Do not sort group by size
            .value(function (d) {
                return d.Value;
            });

        // The arc generator
        let arc = d3.arc()
            .innerRadius(radius * 0.5)         // This is the size of the donut hole
            .outerRadius(radius * 0.8);

        // Another arc that won't be drawn. Just for labels positioning
        let outerArc = d3.arc()
            .innerRadius(radius * 0.9)
            .outerRadius(radius * 0.9);

        // Build the pie chart: Basically, each part of the pie is a path that we build using the arc function.
        svg.selectAll('allSlices')
            .data(pie(data))
            .enter()
            .append('path')
            .attr('d', arc)
            .attr('fill', function (d) { return color(d.data.Color); })
            .attr("stroke", "white")
            .style("stroke-width", "2px")
            .style("opacity", 0.7);

        // Add the polylines between chart and labels:
        svg.selectAll('allPolylines')
            .data(pie(data))
            .enter()
            .append('polyline')
            .attr("stroke", "black")
            .style("fill", "none")
            .attr("stroke-width", 1)
            .attr('points', function(d) {

                var posA = arc.centroid(d); // line insertion in the slice
                var posB = outerArc.centroid(d); // line break: we use the other arc generator that has been built only for that
                var posC = outerArc.centroid(d); // Label position = almost the same as posB
                var midangle = d.startAngle + (d.endAngle - d.startAngle) / 2; // we need the angle to see if the X position will be at the extreme right or extreme left
                posC[0] = radius * 0.95 * (midangle < Math.PI ? 1 : -1); // multiply by 1 or -1 to put it on the right or on the left
                return [posA, posB, posC];
            });

        // Add the polylines between chart and labels:
        svg.selectAll('allLabels')
            .data(pie(data))
            .enter()
            .append('text')
            .text( function(d) { console.log(d.data.Name) ; return d.data.Name} )
            .attr('transform', function(d) {
                let pos = outerArc.centroid(d);
                let midangle = d.startAngle + (d.endAngle - d.startAngle) / 2;
                pos[0] = radius * 0.99 * (midangle < Math.PI ? 1 : -1);
                return 'translate(' + pos + ')';
            })
            .style('text-anchor', function(d) {
                let midangle = d.startAngle + (d.endAngle - d.startAngle) / 2;
                return (midangle < Math.PI ? 'start' : 'end')
            });
    });

    d3.select("#downloadSVG").on("click", function() {
        d3.select(this)
            .attr("href", 'data:application/octet-stream;base64,' + btoa(d3.select("#Pie_chart").html()))
    });

    d3.select("#downloadPNG").on('click', function(){
        // Get the d3js SVG element and save using saveSvgAsPng.js
        saveSvgAsPng(document.getElementsByTagName("svg")[0], "graph.png", {scale: 2, backgroundColor: "#FFFFFF"});
    })

}
