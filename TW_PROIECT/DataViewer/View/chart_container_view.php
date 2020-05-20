<div class = "chart-container">
    <div class="chart">
        <div class="chart-img" id=<?php echo $this->get_chart_type();?>>
        </div>
    </div>

    <div class="download-chart-menu">
        <div class="download-chart-menu-header">
            <h2> Chart description: </h2>
            <p> 
                <?php echo $this->get_chart_type();?> 
            </p>
        </div>
        <div class="download-chart-menu-footer">
            <ul>
                <li><a id="downloadSVG" download="graph.svg"> Download SVG </a></li>
                <li><a href="../RESOURCES/CSV/chart_data.csv" download="graph.csv"> Download CSV </a></li>
                <li><a id="downloadPNG"> Download PNG </a></li>
            </ul>
        </div>
    </div>
</div>

