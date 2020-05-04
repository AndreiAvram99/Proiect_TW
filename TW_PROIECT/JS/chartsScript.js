window.onload = function (){   
        
    var pie_chart_id = document.getElementById("Pie_chart");
        if(pie_chart_id != null)
            pieChartDraw();
    
    var barplot_chart_id = this.document.getElementById("Bar_plot_chart");
        if(barplot_chart_id != null)
            barPlotChartDraw();
    
    var lollipop_chart_id = this.document.getElementById("Lollipop_chart");
        if(lollipop_chart_id != null)
            lollipopChartDraw(); 
};

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

}



///////////////////////////////////////////////////////////////////////////////////////////////////////////

function barPlotChartDraw() {

    const CONTAINER_HEIGHT = document.getElementsByClassName("chart").item(0).clientHeight;
    const CONTAINER_WIDTH = document.getElementsByClassName("chart").item(0).clientWidth;

    // Set the dimensions and margins of the graph
    let margin = {top: 10, right: 10, bottom: 45, left: 60},
        width = CONTAINER_WIDTH - 80,
        height = CONTAINER_HEIGHT - 65;

    // Append the svg object to the body of the page
    let svg = d3.select("#Bar_plot_chart")
        .append("svg")
        .attr("width", width + margin.left + margin.right)
        .attr("height", height + margin.top + margin.bottom)
        .append("g")
        .attr("transform",
            "translate(" + margin.left + "," + margin.top + ")");

    // Read the data
    // Insert csv file!!
    // Parse the Data
    d3.csv("../RESOURCES/CSV/chart_data.csv", function(data) {

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
            .domain([0,max])
            .range([ 0, width]);
        svg.append("g")
            .attr("transform", "translate(0," + height + ")")
            .call(d3.axisBottom(x))
            .selectAll("text")
            .attr("transform", "translate(-10,0) rotate(-45)")
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

}

////////////////////////////////////////////////////////////////////////////////////////////////////////////////


function lollipopChartDraw(){

    const CONTAINER_HEIGHT = document.getElementsByClassName("chart").item(0).clientHeight;
    const CONTAINER_WIDTH = document.getElementsByClassName("chart").item(0).clientWidth;

    var margin = {top: 20, right: 0, bottom: 30, left: 60},
                width = CONTAINER_WIDTH - 80,
                height = CONTAINER_HEIGHT - 55;

    var svg = d3.select("#Lollipop_chart")
    .append("svg")
        .attr("width", width + margin.left + margin.right)
        .attr("height", height + margin.top + margin.bottom)
    .append("g")
        .attr("transform",
            "translate(" + margin.left + "," + margin.top + ")");

    d3.csv("../RESOURCES/CSV/chart_data.csv", function(data) {

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
        .attr("transform", "translate(-10,0)rotate(-45)")
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

}


function refresh() { location.reload();}
