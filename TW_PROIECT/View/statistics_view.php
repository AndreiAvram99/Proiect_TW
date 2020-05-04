<!DOCTYPE html>
<html lang="en">
<head>
    <title>AVI</title>

    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta charset="UTF-8">
    <base href="statistics.html">

    <link rel="stylesheet" type="text/css" href="../CSS/components_style/charts_style.css">
    <link rel="stylesheet" type="text/css" href="../CSS/components_style/body_style.css">
    <link rel="stylesheet" type="text/css" href="../CSS/components_style/stats_filter_menu_style.css">
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

    <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.7/jquery.min.js"></script>
    <script type="text/javascript" src="https://kit.fontawesome.com/a076d05399.js"></script>
    <script type="text/javascript" src="https://canvasjs.com/assets/script/canvasjs.min.js"></script>
    <script type="text/javascript" src="https://d3js.org/d3.v4.js"></script>
    
    <script type="text/javascript" src = "../JS/chartsScript.js"></script>
    

</head>

<body onResize="refresh()">

<?php include("navBar.html")?>

<main>

    <div class="title">
        <p>Data base filters</p>
        <div class="underline"></div>
    </div>
    
    <div class="container">
    <form action="../Controller/statistics_controller.php">
        <div class = "all-filters-container">
            <?php
                load_states_container();
                load_counties_container();
                load_cities_container();
            ?>   
            
            <div class="date-container">
                <div class="date-container-left">     
                    <label>Accidents from:</label>
                    <input type="date" 
                        id="start" 
                        class="date"
                        name="start_date"
                        value="1970-01-01"
                        min="1970-01-01" 
                        max="2020-12-31">
                </div>

                <div class="date-container-right">
                    <label> Accidents until:</label>
                    <input type="date" 
                        id="end" 
                        class="date"
                        name="end_date"
                        value="2018-07-22"
                        min="2018-01-02" 
                        max="2020-12-31">
                </div>
            </div>

            <?php
                load_sides_container();
                load_severities_container();
                load_chart_types_container();
            ?>        
            <div class="submit-button">
                <input id="filter-menu-submit-button" type="submit" name="submit" value="Submit">
            </div>
        </div>
    </form>
</div>
    <div class="title">
        <p>Charts</p>
        <div class="underline"></div>
    </div>

    <div class="charts-container">
        <?php load_chart_container();?>
    </div>


</main>

</body>

</html>