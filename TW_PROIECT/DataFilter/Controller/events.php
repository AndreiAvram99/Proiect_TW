<?php

include("./../Model/event_model.php");

class Events
{
    static function get_events(){
        $event_model = new EventModel();

        $event_model->instantiate_query_with_filters(["*"]);

        if (isset($_REQUEST['sources_container']) && !in_array('All', $_REQUEST['sources_container']))
            $event_model->add_in_filter("source", $_REQUEST['sources_container']);

        if (isset($_REQUEST['states_container']) && !in_array('All', $_REQUEST['states_container']))
            $event_model->add_in_filter("state", $_REQUEST['states_container']);

        if (isset($_REQUEST['counties_container']) && !in_array('All', $_REQUEST['counties_container']))
            $event_model->add_in_filter("county", $_REQUEST['counties_container']);

        if (isset($_REQUEST['cities_container']) && !in_array('All', $_REQUEST['cities_container']))
            $event_model->add_in_filter("city", $_REQUEST['cities_container']);

        if (isset($_REQUEST['streets_name_container']) && !in_array('All', $_REQUEST['streets_name_container']))
            $event_model->add_in_filter("street_name", $_REQUEST['streets_name_container']);

        if (isset($_REQUEST['timezones_container']) && !in_array('All', $_REQUEST['timezones_container']))
            $event_model->add_in_filter("timezone", $_REQUEST['timezones_container']);

        if (isset($_REQUEST['airports_code_container']) && !in_array('All', $_REQUEST['airports_code_container']))
            $event_model->add_in_filter("airport_code", $_REQUEST['airports_code_container']);

        if (isset($_REQUEST['wind_directions_container']) && !in_array('All', $_REQUEST['wind_directions_container']))
            $event_model->add_in_filter("wind_direction", $_REQUEST['wind_directions_container']);

        if (isset($_REQUEST['weather_condition_container']) && !in_array('All', $_REQUEST['weather_condition_container']))
            $event_model->add_in_filter("weather_condition", $_REQUEST['weather_condition_container']);

        if (isset($_REQUEST['sunrise_sunset_container']) && !in_array('All', $_REQUEST['sunrise_sunset_container']))
            $event_model->add_in_filter("sunrise_sunset", $_REQUEST['sunrise_sunset_container']);

        if (isset($_REQUEST['civil_twilight_container']) && !in_array('All', $_REQUEST['civil_twilight_container']))
            $event_model->add_in_filter("civil_twilight", $_REQUEST['civil_twilight_container']);

        if (isset($_REQUEST['nautical_twilight_container']) && !in_array('All', $_REQUEST['nautical_twilight_container']))
            $event_model->add_in_filter("nautical_twilight", $_REQUEST['nautical_twilight_container']);

        if (isset($_REQUEST['astronomical_twilight_container']) && !in_array('All', $_REQUEST['astronomical_twilight_container']))
            $event_model->add_in_filter("astronomical_twilight", $_REQUEST['astronomical_twilight_container']);

        if (isset($_REQUEST['sides_container']) && !in_array('All', $_REQUEST['sides_container']))
            $event_model->add_in_filter("side", $_REQUEST['sides_container']);

        if (isset($_REQUEST['severities_container']) && !in_array('All', $_REQUEST['severities_container']))
            $event_model->add_in_filter("severity", $_REQUEST['severities_container']);




        if (isset($_REQUEST['amenity_container']) && !in_array('All', $_REQUEST['amenity_container']))
            $event_model->add_in_filter("amenity", $_REQUEST['amenity_container']);

        if (isset($_REQUEST['traffic_calming_container']) && !in_array('All', $_REQUEST['traffic_calming_container']))
            $event_model->add_in_filter("traffic_calming", $_REQUEST['traffic_calming_container']);

        if (isset($_REQUEST['bump_container']) && !in_array('All', $_REQUEST['bump_container']))
            $event_model->add_in_filter("bump", $_REQUEST['bump_container']);

        if (isset($_REQUEST['roundabout_container']) && !in_array('All', $_REQUEST['roundabout_container']))
            $event_model->add_in_filter("roundabout", $_REQUEST['roundabout_container']);

        if (isset($_REQUEST['station_container']) && !in_array('All', $_REQUEST['station_container']))
            $event_model->add_in_filter("staion", $_REQUEST['station_container']);

        if (isset($_REQUEST['crossing_container']) && !in_array('All', $_REQUEST['crossing_container']))
            $event_model->add_in_filter("crossing", $_REQUEST['crossing_container']);

        if (isset($_REQUEST['give_way_container']) && !in_array('All', $_REQUEST['give_way_container']))
            $event_model->add_in_filter("give_way", $_REQUEST['give_way_container']);

        if (isset($_REQUEST['junction_container']) && !in_array('All', $_REQUEST['junction_container']))
            $event_model->add_in_filter("junction", $_REQUEST['junction_container']);

        if (isset($_REQUEST['no_exit_container']) && !in_array('All', $_REQUEST['no_exit_container']))
            $event_model->add_in_filter("no_exit", $_REQUEST['no_exit_container']);

        if (isset($_REQUEST['traffic_signal_container']) && !in_array('All', $_REQUEST['traffic_signal_container']))
            $event_model->add_in_filter("traffic_signal", $_REQUEST['traffic_signal_container']);

        if (isset($_REQUEST['turn_loop_container']) && !in_array('All', $_REQUEST['turn_loop_container']))
            $event_model->add_in_filter("turn_loop", $_REQUEST['turn_loop_container']);

        if (isset($_REQUEST['rail_way_container']) && !in_array('All', $_REQUEST['rail_way_container']))
            $event_model->add_in_filter("rail_way", $_REQUEST['rail_way_container']);

        if (isset($_REQUEST['stop_container']) && !in_array('All', $_REQUEST['stop_container']))
            $event_model->add_in_filter("stop", $_REQUEST['stop_container']);


        if (isset($_REQUEST['latitude_min']) && isset($_REQUEST['latitude_max']))
            $event_model->add_between_filter("start_lat",
                $_REQUEST['latitude_min'],
                $_REQUEST['latitude_max']);

        if (isset($_REQUEST['longitude_min']) && isset($_REQUEST['longitude_max']))
            $event_model->add_between_filter("start_lng",
                $_REQUEST['longitude_min'],
                $_REQUEST['longitude_max']);

        if (isset($_REQUEST['distance_min']) && isset($_REQUEST['end_date_max']))
            $event_model->add_between_filter("distance",
                $_REQUEST['distance_min'],
                $_REQUEST['end_date_max']);

        if (isset($_REQUEST['street_nb_min']) && isset($_REQUEST['street_nb_max']))
            $event_model->add_between_filter("street_nb",
                $_REQUEST['street_nb_min'],
                $_REQUEST['street_nb_max']);

        if (isset($_REQUEST['temperature(c)_min']) && isset($_REQUEST['temperature(c)_max']))
            $event_model->add_between_filter("temperature",
                $_REQUEST['temperature(c)_min'],
                $_REQUEST['temperature(c)_max']);

        if (isset($_REQUEST['wind_chill_min']) && isset($_REQUEST['wind_chill_max']))
            $event_model->add_between_filter("wind_chill",
                $_REQUEST['wind_chill_min'],
                $_REQUEST['wind_chill_max']);

        if (isset($_REQUEST['humidity_min']) && isset($_REQUEST['humidity_max']))
            $event_model->add_between_filter("humidity",
                $_REQUEST['humidity_min'],
                $_REQUEST['humidity_max']);


        if (isset($_REQUEST['pressure_min']) && isset($_REQUEST['pressure_max']))
            $event_model->add_between_filter("pressure",
                $_REQUEST['pressure_min'],
                $_REQUEST['pressure_max']);

        if (isset($_REQUEST['visibility_min']) && isset($_REQUEST['visibility_max']))
            $event_model->add_between_filter("visibility",
                $_REQUEST['visibility_min'],
                $_REQUEST['visibility_max']);

        if (isset($_REQUEST['wind_speed_min']) && isset($_REQUEST['wind_speed_max']))
            $event_model->add_between_filter("wind_speed",
                $_REQUEST['wind_speed_min'],
                $_REQUEST['wind_speed_max']);

        if (isset($_REQUEST['precipitation_min']) && isset($_REQUEST['precipitation_max']))
            $event_model->add_between_filter("precipitation",
                $_REQUEST['precipitation_min'],
                $_REQUEST['precipitation_max']);




        if (isset($_REQUEST['start_date']) && isset($_REQUEST['end_date']))
            $event_model->add_between_filter("start_time",
                $_REQUEST['start_date'],
                $_REQUEST['end_date']);

        if(isset($_REQUEST["sort_by_date"]) && $_REQUEST["sort_by_date"] != "none"){
            $type = $_REQUEST["sort_by_date"];
            $event_model->add_order_criteria(["start_time"], $type);
        }

        if(isset($_REQUEST["sort_by_state"]) && $_REQUEST["sort_by_state"] != "none"){
            $type = $_REQUEST["sort_by_state"];
            $event_model->add_order_criteria(["state"], $type);
        }

        $events = $event_model->execute_query_with_filters();

        return json_encode($events);
    }

    static function get_column_values(){
        $column = $_REQUEST["column"];

        $event_model = new EventModel();

        return json_encode($event_model->get_column_list($column, "events"));
    }
}