<?php

class Event
{
    public $attendees;
    public $name;
    public $date;

    public function __construct($attendees, $name, $date)
    {
        $this->attendees = $attendees;
        $this->name = $name;
        $this->date = $date;
    }
}
