<!DOCTYPE html>
<html lang="en">

<head>
    <title>AVI</title>

    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta charset="UTF-8">
    <base href="seeAll.html">

    <link rel="stylesheet" type="text/css" href="../CSS/filterMenuStyle.css">
    <link rel="stylesheet" type="text/css" href="../CSS/navBarStyle.css">
    <link rel="stylesheet" type="text/css" href="../CSS/eventStyle.css">
    <link rel="stylesheet" type="text/css" href="../CSS/paginationStyle.css">
    <link rel="stylesheet" type="text/css" href="../CSS/responsiveNavBarStyle.css">
    <link rel="stylesheet" type="text/css" href="../CSS/responsiveEventStyle.css">
    <link rel="stylesheet" type="text/css" href="../CSS/responsiveSeeAllStyle.css">
    <link rel="stylesheet" type="text/css" href="../CSS/bodyStyle.css">
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

    <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.7/jquery.min.js"></script>
    <script type="text/javascript" src = "../JS/getElements.js"></script>
    <script type="text/javascript" src = "../JS/seeAllPagination.js"></script>
    <script type="text/javascript" src = "../JS/navBarScript.js"></script>
    <script type="text/javascript" src = "../JS/seeAllController.js"></script>
    <script type="text/javascript" src = "https://kit.fontawesome.com/a076d05399.js"></script>


</head>


<body>

<nav id = "navBarContainer">
    <?php include("navBar.html")?>
</nav>

<main>
    <div class = "filterMenu">

        <div class="headerFilters">

            <div class="search-container">
                <form action="">
                    <button type="submit"><i class="fa fa-search"></i></button>
                    <label>
                        <input type="text" placeholder="Search.." name="search">
                    </label>
                </form>
            </div>

            <div class="filtersTitle">
                <p>Filters</p>
                <div class="underline"></div>
            </div>

        </div>

        <div class="leftFilters">
            <div class="locationAccidentFilter">

                <h3>Place of accidents:</h3>

                <label for="State">State:</label>
                <select id="State">
                    <option value="default" selected disabled hidden></option>
                    <option value="Ohio">Ohio</option>
                    <option value="Texas">Texas</option>
                    <option value="California">California</option>
                </select>

                <label for="County">Country:</label>
                <select id="County">
                    <option value="default" selected disabled hidden></option>
                    <option value="Los_Angeles">Los Angeles</option>
                    <option value="Harris">Harris</option>
                    <option value="Montgomery">Montgomery</option>
                    <option value="opel">Franklin</option>
                </select>

                <label for="city">City:</label>
                <select id="city">
                    <option value="default" selected disabled hidden></option>
                    <option value="Houston">Houston</option>
                    <option value="Charlotte">Charlotte</option>
                    <option value="Dayton">Dayton</option>
                    <option value="Columbus">Columbus</option>
                    <option value="Dublin">Dublin</option>
                </select>

            </div>
            <div class="sortFilter">

                <div class="sortHeader">
                    <h3>Sort:</h3>
                </div>

                <div class="sortByDate">
                    <input type="checkbox" id="ascByDate" name="descByDate" value="0">
                    <label for="ascByDate"> Sort asc by date</label><br>
                    <input type="checkbox" id="descByDate" name="descByDate" value="1">
                    <label for="descByDate"> Sort desc by date</label><br>
                </div>

                <div class="sortByState">
                    <input type="checkbox" id="ascByState" name="ascByState" value="0">
                    <label for="ascByState"> Sort asc by state</label><br>
                    <input type="checkbox" id="descByState" name="vehicle2" value="1">
                    <label for="descByState"> Sort desc by state</label><br>
                </div>

            </div>
        </div>

        <div class = "rightFilters">
            <div class="periodAccidentFilter">

                <h3>Period when the accidents happened:</h3>

                <div class="dateFrom">
                    <h4>From:</h4>

                    <label for="dayFrom">Day:</label>
                    <select id="dayFrom" autocomplete="on">

                        <option value="default" selected disabled hidden></option>
                        <option value="01">01</option>
                        <option value="02">02</option>
                        <option value="03">03</option>
                        <option value="04">04</option>

                    </select>

                    <label for="monthFrom">Month:</label>
                    <select id="monthFrom" autocomplete="on">
                        <option value="default" selected disabled hidden></option>
                        <option value="Jan.">Jan.</option>
                        <option value="Feb.">Feb.</option>
                        <option value="Mar.">Mar.</option>
                    </select>

                    <label for="yearFrom">Year:</label>
                    <select id="yearFrom">
                        <option value="default" selected disabled hidden></option>
                        <option value="2020">2020</option>
                        <option value="2019">2019</option>
                        <option value="2018">2018</option>
                    </select>
                </div>

                <div class="dateTo">
                    <h4>To:</h4>

                    <label for="dayTo">Day:</label>
                    <select id="dayTo" autocomplete="on" >
                        <option value="default" selected disabled hidden></option>
                        <option value="01">01</option>
                        <option value="02">02</option>
                        <option value="03">03</option>
                        <option value="04">04</option>
                    </select>

                    <label for="monthTo">Month:</label>
                    <select id="monthTo" autocomplete="on">
                        <option value="default" selected disabled hidden></option>
                        <option value="Jan.">Jan.</option>
                        <option value="Feb.">Feb.</option>
                        <option value="Mar.">Mar.</option>
                    </select>

                    <label for="yearTo">Year:</label>
                    <select id="yearTo">
                        <option value="default" selected disabled hidden></option>
                        <option value="2020">2020</option>
                        <option value="2019">2019</option>
                        <option value="2018">2018</option>
                    </select>
                </div>

            </div>
        </div>

        <div class="footerFilters">

            <div class="submitButton">
                <form>
                    <input type="submit" value="Submit">
                </form>
            </div>

        </div>

    </div>

    <div class = "dataContainer">

        <div class="eventsTitle">
            <p>Events</p>
            <div class="underline"></div>
        </div>

        <div class = "eventsContainer" id = "seeAllEventsContainer">
<!--            here events will be inserted-->
            <?php load_events();?>
        </div>
        <div class="center">
            <div class = "pagination" id = "seeAllPagination">
                <form action = "seeAll.php" method="get">
                    <?php load_pagination();?>
                </form>
<!--            here pages will be inserted-->
            </div>
        </div>
    </div>

</main>
</body>
</html>

