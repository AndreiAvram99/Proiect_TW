<!DOCTYPE html >
<html lang="en">
<head>
    <title>AVI</title>

    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta charset="UTF-8">
    <base href="index.html">

    <link rel="stylesheet" type="text/css" href="../CSS/mapStyle.css">
    <link rel="stylesheet" type="text/css" href="../CSS/navBarStyle.css">
    <link rel="stylesheet" type="text/css" href="../CSS/eventStyle.css">
    <link rel="stylesheet" type="text/css" href="../CSS/firstPageRankingStyle.css">
    <link rel="stylesheet" type="text/css" href="../CSS/indexStyle.css">
    <link rel="stylesheet" type="text/css" href="../CSS/responsiveIndexStyle.css">
    <link rel="stylesheet" type="text/css" href="../CSS/responsiveNavBarStyle.css">
    <link rel="stylesheet" type="text/css" href="../CSS/responsiveEventStyle.css">
    <link rel="stylesheet" type="text/css" href="../CSS/bodyStyle.css">
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

    <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.7/jquery.min.js"></script>
    <script type="text/javascript" src = "../JS/getElements.js"></script>
    <script type="text/javascript" src = "../JS/mapScript.js"></script>
    <script type="text/javascript" src = "../JS/navBarScript.js"></script>
    <script type="text/javascript" src = "../JS/rankingResponsiveScript.js"></script>
    <script type="text/javascript" src = "../JS/indexController.js"></script>
    <script type="text/javascript" src = "https://kit.fontawesome.com/a076d05399.js"></script>

</head>
<body>

<nav id="navBarContainer">
    <?php include("navBar.html")?>
</nav>

<main>

    <div id = "mapDivContainer">
        <?php include("map.html") ?>
    </div>

    <div class = "indexContentContainer">
        <div class = "eventsContainer" id = "eventsContainer">
            <?php create_event()?>
            <?php create_event()?>
            <?php create_event()?>
        </div>

        <div id="rankingsContainer" class = "rankingsContainer" >
            <?php get_ranking()?>
        </div>

        <div  id="sidePanel" class="sidePanel">

            <div class="rankingTitle">
                <h3>Rankings</h3>
                <div class="underline"></div>
            </div>

            <canvas id="panelCloseBtn" class="panelCloseBtn" ontouchmove="closePanel(event)"></canvas>

            <div class="panelContent">
                <?php get_ranking()?>
            </div>

        </div>

        <canvas id="panelOpenBtn" class="panelOpenBtn" ontouchmove="openPanel(event)"></canvas>

    </div>

</main>

<footer></footer>

</body>
</html>