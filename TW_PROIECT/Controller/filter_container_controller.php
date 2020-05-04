<?php
include("filter_container_row_controller.php");

class FilterContainer{
    private $rows = array();
    private $id = "";
    private $title;

    public function __construct($id, $title){
        
        if($id != "chart_types_container")
            $this->add_all_filter_button();
        
        $this->id = $id;
        $this->title = $title;
    }
    
    public function add_all_filter_button()
    {
        $row = new FilterContainerRow("All", $this->get_id()."[]");
        array_push($this->rows, $row);    
    }

    public function add_row($value){
        $row = new FilterContainerRow($value, $this->get_id()."[]");
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

