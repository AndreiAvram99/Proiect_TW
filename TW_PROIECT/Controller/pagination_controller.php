<?php

class pageButtonController
{
    private $value;
    private $is_active;

    public function __construct($value, $is_active){
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

    public function show(){
        include("../View/pagination_view.html");
    }
}