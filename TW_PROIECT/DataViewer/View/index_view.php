<!DOCTYPE html >
<html lang="en">
<head>
    <title>AVI</title>

    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta charset="UTF-8">
    <base href="index.html">

    <link rel="stylesheet" type="text/css" href="../CSS/pages_style/index_style.css">
    <link rel="stylesheet" type="text/css" href="../CSS/components_style/body_style.css">
    
    <!-- to do: mai trebuie scos ranking -->
    <link rel="stylesheet" type="text/css" href="../CSS/components_style/ranking_style.css">
    <script type="text/javascript" src = "../JS/rankingResponsiveScript.js"></script>
    

</head>
<body>

    <?php include("navBar.html") ?>

<main>

    <?php include("new_map.html") ?>


    <div class = "index-content-container">
      
        <div id = "events_container" class = "events-container" >
            <?php create_event()?>
        </div>

        <div id = "rankings_container" class = "rankings-container" >
            <?php get_ranking()?>
        </div>

        <div  id="side_panel" class="side-panel">

            <div class="ranking-title">
                <h3>Rankings</h3>
                <div class="underline"></div>
            </div>

            <canvas id="panel_close_btn" class="panel-close-btn" ontouchmove="closePanel(event)"></canvas>

            <div class="panel-content">
                <?php get_ranking()?>
            </div>

        </div>

        <canvas id="panel_open_btn" class="panel-open-btn" ontouchmove="openPanel(event)"></canvas>

    </div>

</main>

<footer></footer>

</body>
</html>