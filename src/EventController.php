<?php

class EventController
{
    private $conn; // Variabile di classe per memorizzare l'istanza di Connector
    public $events = [];

    public function __construct($connector)
    {
        $this->conn = $connector; // Memorizza l'istanza di Connector
    }
    // Restituzione di tutti gli eventi
    public function list($email = false)
    {
        try {

            $events = [];

            $dbEvents = $this->conn->getEvents($email);
            foreach ($dbEvents as $dbEvent) {

                $attendees = explode(',', $dbEvent['attendees']);
                $events[] = new Event($attendees, $dbEvent['nome_evento'], $dbEvent['data_evento']);
            }

            return $events;
        } catch (Exception $e) {
            echo "Errore nel recupero degli eventi: " . $e->getMessage();
            return [];
        }
    }

    // Aggiunta evento
    public function addEvent($event)
    {
        $this->events[] = $event;
    }

    // Modifica evento
    public function editEvent($id, $event)
    {
        if (isset($this->events[$id])) {
            $this->events[$id] = $event;
        }
    }

    // Eliminazione evento
    public function deleteEvent($id)
    {
        if (isset($this->events[$id])) {
            unset($this->events[$id]);
        }
    }
}
