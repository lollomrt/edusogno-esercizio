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
    public function addEvent($attendees, $eventName, $eventDate)
    {

        try {
            // Verifica se i dati dell'evento sono validi prima di procedere
            if (empty($attendees) || empty($eventName) || empty($eventDate)) {
                throw new Exception("I dati dell'evento non sono validi.");
            }



            // Converte l'array $attendees in una stringa separata da virgole
            $attendeesString = implode(',', $attendees);

            // Chiama il metodo di Connector per inserire l'evento nel database
            $success = $this->conn->insertEvent($attendeesString, $eventName, $eventDate);

            if ($success) {
                // Se l'aggiunta è riuscita, ricarica la pagina
                header("Location: ?page=dashboard.php");
                exit();
            } else {
                throw new Exception("Errore nell'inserimento dell'evento nel database.");
            }
        } catch (Exception $e) {
            // Gestisci l'errore in modo appropriato
            $session = new Session();
            $session->setErrorMessage($e->getMessage());

            // Se l'aggiunta ha causato un errore, rimani sulla stessa pagina
            header("Location: dashboard.php");
            exit();
        }
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
