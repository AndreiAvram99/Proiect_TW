<?php
include("database.php");

class PopulateEvents{
    private $dbi;

    public function __constructor(){
        $this->dbi = database::get_dbi();
    }

    public function populate(){
        $file = $this->getFile();
        fgetcsv($file);
        while ($data = fgetcsv($file)){
            $this->dbi->create_event(1, $data[3], $data[11], $data[4], $data[15], $data[15], $data[17]);
        }
    }

    private function getFile(){
        $path = "./../RESOURCES/CSV/databasePopulateTest.csv";
        return fopen($path, "r");
    }
}

$populate_events = new PopulateEvents();
$populate_events->__constructor();
$populate_events->populate();