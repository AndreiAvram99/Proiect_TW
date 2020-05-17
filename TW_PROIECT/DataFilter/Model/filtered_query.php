<?php

class FilteredQuery{
    private $query = "";
    private $where = " WHERE true";
    private $order = " ORDER BY NULL asc";
    private $from = 0;
    private $count = 1000000;


    public function __construct($columns, $table){
        if (gettype($columns) != "array"){
            echo "First parameter of method __construct from class FilteredQuery has to be array!";
        }
        $this->query = "SELECT " . $this->get_string_list($columns, false) . " FROM " . $table;
    }

    public function add_in_filter($column, $list){
        if (gettype($list) != "array"){
            echo "Second parameter of method add_in_filter from class FilteredQuery has to be array!";
        }
        $this->where .= " AND( " . $column . " IN " . "(" . $this->get_string_list($list, true) . ") OR ". $column ." IS NULL)";
    }

    public function add_between_filter($column, $first, $last){
        $this->where .= " AND( " . $column . " BETWEEN " . "'" . $first . "'" . " AND " . "'" . $last . "' OR ".$column. " IS NULL) " ;
    }

    // type = asc, desc
    // list = list of order criteria
    public function add_order_criteria($list, $type){
        $this->order .= ", " . $this->get_string_list($list, false) . " " . $type;
    }

    public function add_limits($from, $count){
        $this->from = $from;
        $this->count = $count;
    }

    public function get_sql_query(){
        return $this->query . $this->where . $this->order .
            " LIMIT " . $this->count . " OFFSET " . $this->from;
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
                    if($element == 'Yes')
                        str_replace('Yes', '1');
                    if($element == 'No')
                        str_replace('No', '0');
                    
                    $string_list = str_replace('-', ' ', $element);

                    $first = false;
                } else {
                    $string_list .= ", " . $element;
                }
            }
        }
        return $string_list;
    }
}