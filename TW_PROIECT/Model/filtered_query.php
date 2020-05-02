<?php

class FilteredQuery{
    private $query = "";
    private $where = " WHERE true";
    private $order = " ORDER BY NULL asc";


    public function __construct($columns, $table){
        $this->query = "SELECT " . $this->get_string_list($columns, false) . " FROM " . $table;
    }

    public function add_in_filter($column, $list){
        $this->where .= " AND " . $column . " IN " . "(" . $this->get_string_list($list, true) . ")";
    }

    public function add_between_filter($column, $first, $last){
        $this->where .= " AND " . $column . " BETWEEN " . $first . " AND " . $last;
    }

    // type = asc, desc
    // list = list of order criteria
    public function add_order_criteria($list, $type){
        $this->order .= ", " . $this->get_string_list($list, true) . " " . $type;
    }

    public function get_sql_query(){
        return $this->query . $this->where . $this->order;
    }

    private function get_string_list($list, $asChar){
        $string_list = "";
        $first = true;
        foreach ($list as $element){
            if ($asChar) {
                if ($first) {
                    $string_list = "'" . $element . "'";
                    $first = false;
                } else {
                    $string_list .= ", '" . $element . "'";
                }
            }
            else{
                if ($first) {
                    $string_list = $element;
                    $first = false;
                } else {
                    $string_list .= ", " . $element;
                }
            }
        }
        return $string_list;
    }
}