<?php

class FilterContainerRow{
    private $name;
    private $value;

    public function __construct($value, $name){
        $this->value = $value;
        $this->name = $name;
    }

    public function get_value(){
        return $this->value;
    }

    public function get_name(){
        return $this->name;
    }

    public function show(){
        if($this->name == "chart_types_container[]")
            include("./../View/filter_container_row_radio_view.php");
        else 
            include("./../View/filter_container_row_checkbox_view.php");
    }
}