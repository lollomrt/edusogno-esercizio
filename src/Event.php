<?php

class Event
{
    public $id;
    public $attendees;
    public $name;
    public $date;

    public function __construct($id, $attendees, $name, $date)
    {
        $this->id = $id;
        $this->attendees = $attendees;
        $this->name = $name;
        $this->date = $date;
    }
}
