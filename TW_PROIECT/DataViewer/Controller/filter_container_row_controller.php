<?php

class FilterContainerRow{
    private $name;
    private $value;
    private $container_type;
    private $min;
    private $max;

    public function __construct($value, $name, $min, $max, $container_type){
        $this->value = $value;
        $this->name = $name;
        $this->min = $min;
        $this->max = $max;
        $this->container_type = $container_type;
    }

    public function get_value(){
        return str_replace(' ', '-', $this->value);
    }

    public function get_name(){
        return $this->name;
    }

    public function show(){
        if($this->container_type == 0)
            include("./../View/filter_container_row_checkbox_view.php");
        if($this->container_type == 1) 
            include("./../View/filter_container_row_radio_view.php");
        if($this->container_type == 2)
            include("./../View/filter_container_row_between_view.php");
    }

    public function get_min(){
        return $this->min;
    }

    public function get_max(){
        return $this->max;
    }
 
}