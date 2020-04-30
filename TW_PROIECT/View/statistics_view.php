<!DOCTYPE html>
<html lang="en">
<head>
    <title>AVI</title>

    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta charset="UTF-8">
    <base href="statistics.html">

    <link rel="stylesheet" type="text/css" href="../CSS/components_style/charts_style.css">
    <link rel="stylesheet" type="text/css" href="../CSS/components_style/body_style.css">
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
    
    <form action="../Controller/statistics_controller.php">
        <?php
            load_states_container();
            load_counties_container();
            load_cities_container();
        ?>        
        <input type="date" 
               id="start" 
               name="trip-start"
               value="2018-07-22"
               min="2018-01-01" 
               max="2018-12-31">
        
        <input type="date" 
               id="start" 
               name="trip-start"
               value="2018-07-22"
               min="2018-01-01" 
               max="2018-12-31">

        <?php
            load_sides_container();
            load_severities_container();
        ?>        
       
        <input type="submit" value="Submit">
    </form>

</main>

</body>

</html>