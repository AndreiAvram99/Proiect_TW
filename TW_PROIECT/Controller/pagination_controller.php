<?php

class pageButtonController
{
    private $value;
    private $is_active;
    private $is_disabled;

    public function __construct($value, $is_active, $is_disabled){
        $this->is_disabled = $is_disabled;
        $this->value = $value;
        if ($is_active == "true")
            $this->is_active = true;
        else
            $this->is_active = false;
    }

    public function get_value(){
        return $this->value;
    }

    public function get_link(){
        if ($this->is_disabled)
            return "#";
        return "see_all_controller.php?".
            http_build_query(
                array_merge($_GET, array('page_number' => $this->get_value())),
                '',
                '&');
    }

    public function get_is_active(){
        if ($this->is_active)
            return "active";
        else
            return "inactive";
    }

    public function get_disabled(){
        if ($this->is_disabled)
            return "disabled";
        else
            return "enabled";
    }

    public function show(){
        include("../View/pagination_view.php");
    }
}