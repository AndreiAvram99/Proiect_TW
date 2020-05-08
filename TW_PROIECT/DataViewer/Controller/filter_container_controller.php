<?php
include("filter_container_row_controller.php");

class FilterContainer{
    private $rows = array();
    private $id = "";
    private $title;
    private $container_type;

    public function __construct($id, $title, $container_type){ 
        $this->id = $id;
        $this->title = $title;
        $this->container_type = $container_type;
        
        if($container_type == 0){
            $this->add_all_filter_button();
        }
    }
    
    public function add_all_filter_button()
    {
        $row = new FilterContainerRow("All", $this->get_id()."[]", 0);
        array_push($this->rows, $row);    
    }

    public function add_row($value){
        if($this->container_type == 0 || $this->container_type == 1)
            $row = new FilterContainerRow($value, $this->get_id()."[]", $this->container_type);
        else 
            $row = new FilterContainerRow($value, $this->get_id(), $this->container_type);
        array_push($this->rows, $row);
    }

    public function show(){
        include("./../View/filter_container_view.php");
    }

    public function get_id(){
        return $this->id;
    }

    public function get_title(){  
        return $this->title;
    }
 
} 

