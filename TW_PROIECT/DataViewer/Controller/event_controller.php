<?php

class eventController{
    private $title;
    private $author;
    private $description;
    private $id;

    public function __construct($title, $author, $description)
    {
        $this->title = $title;
        $this->author = $author;
        $this->description = $description;
    }

    public function get_title(){
        return $this->title;
    }

    public function get_author(){
        return $this->author;
    }

    public function get_description(){
        return $this->description;
    }

    public function get_id(){
        return $this->id;
    }

    public function get_event_page_link(){
        return "event_page_controller.php?" .
            http_build_query(
                array_merge($_GET, array('event_id' => $this->get_id())),
                '',
                '&');
    }

    public function set_id($id){
        $this->id = $id;
    }

    public function show(){
        include("./../View/event_view.php");
    }
}