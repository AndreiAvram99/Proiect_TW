<form action = <?php echo get_self()?> method = "get" class = "filter-menu">
    <div class="header-filters">
<!--        <div class="search-container">-->
<!--            <form action="">-->
<!--                <button type="submit"><i class="fa fa-search"></i></button>-->
<!--                <label>-->
<!--                    <input type="text" placeholder="Search.." name="search">-->
<!--                </label>-->
<!--            </form>-->
<!--        </div>-->

        <div class="filters-title">
            <p>Filters</p>
            <div class="underline"></div>
        </div>
    </div>

    <div class="left-filters">
        <div class="location-accident-filter">
            <h3>Place of accidents:</h3>

            <label for="State">State:</label>
            <select id="State" name = 'state'>
                <option value="default" selected disabled hidden></option>
                <?php
                    init_states();

                    foreach ($GLOBALS["states"] as $state)
                        echo "<option value=$state> $state </option>";
                ?>
            </select>

            <label for="County">County:</label>
            <select id="County" name = 'county'>
                <option value="default" selected disabled hidden></option>
                <?php
                    init_counties();

                    foreach ($GLOBALS["counties"] as $county)
                        echo "<option value=$county> $county </option>";
                ?>
            </select>

            <label for="City">City:</label>
            <select id="City" name = 'city'>
                <option value="default" selected disabled hidden></option>
                <?php
                    init_cities();

                    foreach ($GLOBALS["cities"] as $city)
                        echo "<option value=$city> $city </option>";
                ?>
            </select>

        </div>
        <div class="sort-filter">
            <div class="sort-header">
                <h3>Sort:</h3>
            </div>

            <div class="sort-by-date">
                <input type="checkbox" id="ascByDate" name="descByDate" value="0">
                <label for="ascByDate"> Sort asc by date</label><br>
                <input type="checkbox" id="descByDate" name="descByDate" value="1">
                <label for="descByDate"> Sort desc by date</label><br>
            </div>

            <div class="sort-by-state">
                <input type="checkbox" id="ascByState" name="ascByState" value="0">
                <label for="ascByState"> Sort asc by state</label><br>
                <input type="checkbox" id="descByState" name="vehicle2" value="1">
                <label for="descByState"> Sort desc by state</label><br>
            </div>
        </div>
    </div>

    <div class = "right-filters">
        <div class="period-accident-filter">

            <h3>Period when the accidents happened:</h3>

            <div class="date-from">
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

            <div class="date-to">
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

    <div class="footer-filters">
        <div class="submit-button">
            <form>
                <input type="submit" value="Submit">
            </form>
        </div>
    </div>
</form>