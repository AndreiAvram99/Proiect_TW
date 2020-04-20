<?php

class eventController{
    private $title;
    private $author;
    private $description;

    public function __construct($title, $author, $description )
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

    public function show(){
        include("./../View/event_view.php");
    }
}