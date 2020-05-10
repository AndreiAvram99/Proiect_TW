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


</head>

<body onResize="refresh()">

<?php include("navBar.html") ?>

<!-- onchange="addRemoveMenu()" -->
<!-- onsubmit="return validateForm()" -->

<main>
    
    <form name="all_filters_form" action="../Controller/statistics_controller.php" onsubmit="return validateForm()">
        
        <div class = "data-filters-menu"  id = "data_filter_menu">
           
            <div class = "sub-menu">
               
                <div class = "filter-title">
                    <p>Choose custom filters:</p>
                    <button type="button" 
                            class="show-menu" 
                            onclick="addRemoveMenu('custom_container')">
                            <p> Show menu </p>
                    </button>
                    
                    <div class="underline"></div>    
                </div>
                
                <div class = "data-filters-container" id = "custom_container">
                    <?php
                        load_custom_containers();
                    ?>
                </div>
            </div>

            <div class = "sub-menu">
                
                    <div class = "filter-title">
                        <p>Presence filters:</p>
                        <button type="button" 
                                class="show-menu" 
                                onclick="addRemoveMenu('tf_containers')">
                                <p> Show menu </p>
                        </button>
                        
                        <div class="underline"></div>    
                    </div>

                    <div class = "data-filters-container" id = "tf_containers">
                        <?php
                            load_true_false_containers();
                        ?>
                    </div>
            </div>

            <div class = "sub-menu">
                <div class = "filter-title">
                    <p>Data filters:</p>
                    <button type="button" 
                            class="show-menu" 
                            onclick="addRemoveMenu('data_containers')">
                            <p> Show menu </p>
                    </button>
                    
                    <div class="underline"></div>    
                </div>

                <div class = "data-filters-container" id = "data_containers">
                    <?php
                        load_db_containers();
                    ?>
                </div>
            </div>

            <div class = "sub-menu">
                <div class = "filter-title">
                    <p>Between filters:</p>
                    <button type="button" 
                            class="show-menu" 
                            onclick="addRemoveMenu('between_containers')">
                            <p> Show menu </p>
                    </button>
                    
                    <div class="underline"></div>    
                </div>
                <div class = "data-filters-container" id = "between_containers">
                    <?php
                        load_between_containers();
                    ?>
                </div>
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

        <div class = "chart-filter-menu" id = "chart_filter_menu">
    
            <div class = "sub-menu">

                <div class="title"  id="chart_filters_title">
                    <p>Choose chart axis</p>
                    <div class="underline"></div>
                </div>

                <div class = "chart-filters-container" id = "charts_submenu">
                    <?php
                        load_charts_containers();
                    ?>
                </div>

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

    
    <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.7/jquery.min.js"></script>
    <script type="text/javascript" src="https://kit.fontawesome.com/a076d05399.js"></script>
    <script type="text/javascript" src="https://canvasjs.com/assets/script/canvasjs.min.js"></script>
    <script type="text/javascript" src="https://d3js.org/d3.v4.js"></script>
    
    <script type="text/javascript" src = "../JS/chartsScript.js"></script>
    <script type="text/javascript" src = "../JS/validateChartsForm.js"></script>
    <script type="text/javascript" src = "../JS/addRemoveMenuScript.js"> </script>

</body>

</html>