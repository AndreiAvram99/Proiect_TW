<?php

class ChartContainer{
    private $chart_type;
    private $chart_description;

    public function __construct($chart_type){
        $this->chart_type = $chart_type;
    }

    public function get_chart_type(){
        return $this->chart_type;
    }

    public function show(){
        include("./../View/chart_container_view.php");
    }
}