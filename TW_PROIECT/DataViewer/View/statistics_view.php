<!DOCTYPE html>
<html lang="en">
<head>
    <title>AVI</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta charset="UTF-8">
    <base href="statistics.html">

    <link rel="stylesheet" type="text/css" href="../CSS/components_style/charts_style.css">
    <link rel="stylesheet" type="text/css" href="../CSS/components_style/body_style.css">
    <link rel="stylesheet" type="text/css" href="../CSS/components_style/stats_filter_menu_style.css">
    <link rel="stylesheet" type="text/css" href="../CSS/components_style/check_box_style.css">
    <link rel="stylesheet" type="text/css" href="../CSS/components_style/input_date_style.css">

    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

    <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.7/jquery.min.js"></script>
    <script type="text/javascript" src="https://kit.fontawesome.com/a076d05399.js"></script>
    <script type="text/javascript" src="https://canvasjs.com/assets/script/canvasjs.min.js"></script>
    <script type="text/javascript" src="https://d3js.org/d3.v4.js"></script>
    
    <script type="text/javascript" src = "../JS/chartsScript.js"></script>
    <script type="text/javascript" src = "../JS/validateChartsForm.js"></script>
    <script type="text/javascript" src = "../JS/addRemoveMenuScript.js"> </script>
    

</head>

<body onResize="refresh()">

<?php include("navBar.html") ?>

<main>

    <div class="title">
        <p>Data base filters</p>
        <div class="underline"></div>
    </div>
    
    <form name="all_filters_form" action="../Controller/statistics_controller.php" onsubmit="return validateForm()">
        
        <div class = "all-filters-container"  id = "first_filter menu" onchange="addRemoveMenu(5)">
           
           <div class = "all-filters-part" id = "0">
                <?php
                    load_true_false_container('Amenity');
                    load_true_false_container('Traffic_calming');
                    load_true_false_container('Bump');
                    load_true_false_container('Roundabout');
                    load_true_false_container('Station');
                    load_true_false_container('Crossing');
                    load_true_false_container('Give_way');
                    load_true_false_container('Junction');   
                ?>
            </div>

            <div class = "all-filters-part" id = "1">
                <?php
                    load_true_false_container('No_exit');
                    load_true_false_container('Traffic_signal');
                    load_true_false_container('Turn_loop');
                    load_true_false_container('Rail_way');
                    load_true_false_container('Stop');
                    load_between_container('Latitude');
                    load_between_container('Longitude');
                    load_between_container('Distance');
                ?>
            </div>

            <div class = "all-filters-part" id = "2">
                <?php
                    load_between_container('Street_nb');
                    load_between_container('Temperature(c)');
                    load_between_container('Wind_chill');
                    load_between_container('Humidity');
                    load_between_container('Pressure');
                    load_between_container('Visibility');
                    load_between_container('Wind_speed');
                    load_between_container('Precipitation');
                ?>
            </div>

            <div class = "all-filters-part" id ="3">
                <?php
                    load_container('events', 'source', 'sources_container', 'Choose accident report source:');
                    load_container('events', 'state', 'states_container', 'Choose state:');
                    load_container('events', 'county', 'counties_container', 'Choose county:');
                    load_container('events', 'city', 'cities_container', 'Choose city:');
                    load_container('events', 'street_name', 'streets_name_container', 'Choose street name:');
                    load_container('events', 'timezone', 'timezones_container', 'Choose timezone:');
                    load_container('events', 'airport_code', 'airports_code_container', 'Choose airport code:');
                    load_container('events', 'wind_direction', 'wind_directions_container', 'Choose wind direction:');
                ?>
            </div>

            <div class = "all-filters-part" id = "4">
                <?php
                    load_container('events', 'weather_condition', 'weather_condition_container', 'Choose weather conditon:');
                    load_container('events', 'sunrise_sunset', 'sunrise_sunset_container', 'Choose sunrise sunset:');
                    load_container('events', 'civil_twilight', 'civil_twilight_container', 'Choose civil twilight:');
                    load_container('events', 'nautical_twilight', 'nautical_twilight_container', 'Choose nautical twilight:');
                    load_container('events', 'astronomical_twilight', 'astronomical_twilight_container', 'Choose astronomical twilight:');
                    load_severities_container();
                    load_sides_container();                            
                    load_chart_types_container();
                ?>   
            </div>


            <div class="date-container">
                <div class="date-container-left">     
                    <label>Accidents from:</label>
                    <input type="date" 
                        id="start" 
                        class="date"
                        name="start_date"
                        value = "1970-01-01"
                        min="1970-01-01" 
                        max="<?php echo date('Y-m-d'); ?>">
                </div>

                <div class="date-container-right">
                    <label> Accidents until:</label>
                    <input type="date" 
                        id="end" 
                        class="date"
                        name="end_date"
                        value="<?php echo date('Y-m-d'); ?>"
                        min="2018-01-02" 
                        max="<?php echo date('Y-m-d'); ?>">
                </div>
            </div>

        </div>

        <div class = "second-filter-menu" id = "second_filter_menu">
            <div class="title"  id="chart_filters_title">
                <p>Choose chart axis</p>
                <div class="underline"></div>
            </div>
            
            <div class = "chart-filters-container" id="chart_filters_container">
                <?php
                        load_xaxis_container();
                        load_yaxis_container();
                ?>
            
                <div class="submit-button">
                    <input id="filter-menu-submit-button" type="submit" name="submit" value="Submit">
                </div>
            
            </div>

            
        </div>

    </form>

    <div class="title">
        <p>Charts</p>
        <div class="underline"></div>
    </div>

    <div class="charts-container">
        <?php 
            load_chart_container();
        ?>
    </div>


</main>

</body>

</html>