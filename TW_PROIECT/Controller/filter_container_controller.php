<?php
include("filter_container_row_controller.php");

class FilterContainer{
    private $rows = array();
    private $id = "";
    
    public function __construct($id){
        $this->$id = $id;
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
 
} 

