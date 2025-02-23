<!DOCTYPE html>
<html lang="en">

<head>
    <title>AVI</title>

    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta charset="UTF-8">
    <base href="seeAll.html">

    <link rel="stylesheet" type="text/css" href="../CSS/pages_style/see_all_style.css">
    <link rel="stylesheet" type="text/css" href="../CSS/components_style/body_style.css">

    <link rel="stylesheet" type="text/css" href="../CSS/components_style/filter_menu_style.css">
    <link rel="stylesheet" type="text/css" href="../CSS/components_style/pagination_style.css">    

</head>


<body>

    <?php include("navBar.html") ?>

<main>

    <?php include("../Controller/filter_menu_controller.php") ?>

    <div class = "data-container">

        <div class="title">
            <p>Events</p>
            <div class="underline"></div>
        </div>

        <div class = "events-container" id = "seeAllEventsContainer">
            
<!--            here events will be inserted-->
            <?php load_events();?>
        </div>
        <div class="center">
            <div class = "pagination" id = "seeAllPagination">
                <form action = "see_all_controller.php" method="get">

<!--                here pages will be inserted-->
                    <?php load_pagination();?>
                </form>
            </div>
        </div>
    </div>
</main>

<footer>
    <p> <b>Project doc <a href="../View/project_doc.html">here</a></b></p>
    <p> <b>API doc <a href="../View/API_doc.html">here</a></b></p>
</footer>

</body>
</html>

