<!DOCTYPE html>
<html lang="en">
<head>
    <title>AVI</title>

    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta charset="UTF-8">
    <base href="index.html">

    <link rel="stylesheet" type="text/css" href="../CSS/pages_style/index_style.css">
    <link rel="stylesheet" type="text/css" href="../CSS/components_style/body_style.css">

</head>
<body>
    <?php include("navBar.html"); ?>
<main>

    <div class="title">
        <p>Number of accidents per state map</p>
        <div class="underline"></div>
    </div>

    <?php
        create_map_data(); 
        include("map.html"); 
    ?>

    <div class="title">
        <p>Main page</p>
        <div class="underline"></div>
    </div>

    <div class = "index-content-container">
        <?php include("mainPage.html"); ?>
    </div>

</main>

<footer>
    <p> <b>Project doc <a href="../View/project_doc.html">here</a></b></p>
    <p> <b>API doc <a href="../View/API_doc.html">here</a></b></p>
    <p> <b>Credentials: Leaflet released under BSD license. © 2010–2019 Vladimir Agafonkin. Maps © OpenStreetMap contributors.</b></p>
</footer>

</body>
</html>