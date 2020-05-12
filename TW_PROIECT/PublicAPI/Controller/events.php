<?php
include("./../Model/event_model.php");

class Events
{
    /**
     * Return a chart specified in $parameters. Returned type will be the one
     * from $_REQUEST['type']
     * @param $parameters
     * @return false|mixed|string
     */
    static function get_chart($parameters){
        $accepted_charts = ["pie_chart" => "Events::get_pie_chart",
                            "bar_plot_chart" => "Events::get_bar_plot_chart",
                            "lollipop_chart" => "Events::get_lollipop_chart"];
        $chart = $parameters[0];
        if (!isset($accepted_charts[$chart])){
            $answer['error'] = "Chart not found!";
            return json_encode($answer);
        }

        return call_user_func($accepted_charts[$chart]);
    }

    static function get_pie_chart(){
        $answer['chart'] = "pie-chart";
        return json_encode($answer);
    }

    static function get_bar_plot_chart(){
        $answer['chart'] = "bar_plot_chart";
        return json_encode($answer);
    }

    static function get_lollipop_chart(){
        $answer['chart'] = "lollipop_chart";
        return json_encode($answer);
    }

    /**
     * Return filtered events according to certain parameters as JSON.
     */
    static function get_events(){
        $accepted_types = ["JSON"];
        if (isset($_REQUEST['type']) && in_array(strtoupper($_REQUEST['type']), $accepted_types))
            $type = strtoupper($_REQUEST['type']);
        else
            $type = "JSON";

        if ($type = "JSON"){
            return Events::get_events_as_JSON();
        }
    }

    static function get_events_as_JSON(){
        $event_model = new EventModel();
        $events['events'] = $event_model->get_events();
        return json_encode($events);
    }

    /**
     * Returns all distinct elements which are in table "events" on column $parameters[0]
     * Returned format is JSON.
     * If the column dosen't exist. Return a string "There is no column columnName";
     * @param $parameters
     * @return false|string
     */
    static function get_column($parameters){
        $event_model = new EventModel();
        $column = $parameters[0];
        $columns = $event_model->get_columns_list();

        if (!in_array($column, $columns)){
            $answer['error'] = "There is no column " . $column;
            return json_encode($answer);
        }

        $answer[$column] = $event_model->get_column_list($column);
        return json_encode($answer);
    }

    /**
     * Return the list of columns as JSON.
     * @return false|string
     */
    static function get_columns_list(){
        $event_model = new EventModel();
        return json_encode($event_model->get_columns_list());
    }
}