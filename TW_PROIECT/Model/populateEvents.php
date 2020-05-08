<?php
include("event_model.php");

class PopulateEvents{
    private $event;

    public function __constructor(){
        $this->event = new EventModel();
    }

    public function populate(){
        $file = $this->getFile();
        fgetcsv($file);
        while ($data = fgetcsv($file)){
            $this->event->create_event(1, 
                                       $data[1], 
                                       $data[3], 
                                       $data[11], 
                                       $data[4], 
                                       $data[6], 
                                       $data[7], 
                                       $data[15], 
                                       $data[16], 
                                       $data[17], 
                                       $data[10], 
                                       $data[12], 
                                       $data[13], 
                                       $data[14],
                                       $data[20],
                                       $data[21],
                                       $data[23], 
                                       $data[24], 
                                       $data[25], 
                                       $data[26], 
                                       $data[27], 
                                       $data[28], 
                                       $data[29], 
                                       $data[30], 
                                       $data[31], 
                                       $data[32], 
                                       $data[33], 
                                       $data[34], 
                                       $data[35],
                                       $data[36],
                                       $data[37],
                                       $data[38], 
                                       $data[39], 
                                       $data[40], 
                                       $data[41], 
                                       $data[42], 
                                       $data[43], 
                                       $data[44], 
                                       $data[45], 
                                       $data[46], 
                                       $data[47], 
                                       $data[48]
                                    );
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