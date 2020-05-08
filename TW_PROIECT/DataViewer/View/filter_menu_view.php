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

        <div class="title">
            <p>Filters</p>
            <div class="underline"></div>
        </div>
    </div>

    <div class="left-filters">
        <div class="location-accident-filter">
            <h3>Place of accidents:</h3>

            <label for="State">State:</label>
            <select id="State" name = 'state'>
                <option value="all">All</option>
                <?php
                    init_states();

                    foreach ($GLOBALS["states"] as $state)
                        echo "<option value=$state> $state </option>";
                ?>
            </select>

            <label for="County">County:</label>
            <select id="County" name = 'county'>
                <option value="all">All</option>
                <?php
                    init_counties();

                    foreach ($GLOBALS["counties"] as $county)
                        echo "<option value=$county> $county </option>";
                ?>
            </select>

            <label for="City">City:</label>
            <select id="City" name = 'city'>
                <option value="all">All</option>
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
                <input type="radio" id="asc_by_date" name="sort_by_date" value="asc">
                <label for="asc_by_date"> Sort asc by date</label><br>
                <input type="radio" id="desc_by_date" name="sort_by_date" value="desc">
                <label for="desc_by_date"> Sort desc by date</label><br>
                <input type="radio" id="none" name="sort_by_date" value="none">
                <label for="none"> None </label><br>
            </div>

            <div class="sort-by-state">
                <input type="radio" id="asc_by_state" name="sort_by_state" value="asc">
                <label for="asc_by_state"> Sort asc by state</label><br>
                <input type="radio" id="desc_by_state" name="sort_by_state" value="desc">
                <label for="desc_by_state"> Sort desc by state</label><br>
                <input type="radio" id="none" name="sort_by_state" value="none">
                <label for="none"> None </label><br>
            </div>
        </div>
    </div>

    <div class = "right-filters">
        <div class="period-accident-filter">

            <h3>Period when the accidents happened:</h3>

            <div class="date-container">
                <div class="date-from">
                    <label>Accidents from:</label>
                    <input type="date"
                           id="start"
                           class="date"
                           name="start_date"
                           value="1970-01-01"
                           min="1970-01-01"
                           max="<?php echo date('Y-m-d'); ?>">
                </div>

                <div class="date-until">
                    <label> Accidents until:</label>
                    <input type="date"
                           id="end"
                           class="date"
                           name="end_date"
                           value="<?php echo date('Y-m-d'); ?>"
                           min="1970-01-01"
                           max="<?php echo date('Y-m-d'); ?>">
                </div>
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